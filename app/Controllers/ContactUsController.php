<?php

namespace App\Controllers;

use App\Supports\GoogleRecaptcha;
use App\Traits\Validator;

class ContactUsController
{
	use Validator;

	public string $table;

	protected ?array $data;

	protected function rules(): array {
		return [
			'name' => 'required',
			'email' => 'required|email',
			'contact_number' => 'nullable',
			'message' => 'required|min:10',
		];
	}

	protected function message(): array {
		return [
			'name.required' => 'Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'message.required' => 'Message is required',
			'message.min' => 'Message must be at least 10 characters',
		];
	}

	public function __construct()
	{
		$this->initializeTable();

		$this->post();

		if (! empty($this->data) and $this->data['form'] == 'contact-us') {
			$this->save();
		}
	}

	protected function post(): void
	{
		$this->data = json_decode(file_get_contents("php://input"), true);
	}

	protected function initializeTable(): void
	{
		global $wpdb;

		$this->table = "{$wpdb->prefix}contact_us";

		$sql = "
			CREATE TABLE IF NOT EXISTS {$this->table} (
			    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(200) NOT NULL,
                `contact_number` VARCHAR(100) NOT NULL,
                `email` VARCHAR(200) NULL,
                `message` TEXT NOT NULL,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
			)
		";

		$wpdb->query($sql);
	}

	public function save()
	{
		global $wpdb;

		$validated = $this->validate($this->data);

		$recaptcha = new GoogleRecaptcha($this->data['g-recaptcha-response']);
		if ($recaptcha->validate()) {
			$created = $wpdb->insert($this->table, $validated);

			if ($created) {
				return wp_send_json_success('Thank you for reaching out to us. We appreciate your interest. <br>We will get back to you as soon as possible', 200);
			}

			if (! $created) {
				return wp_send_json_error('Something went wrong', 500);
			}

			die();
		}
	}
}