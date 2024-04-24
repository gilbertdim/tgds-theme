<?php

namespace App\Traits;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\MessageBag;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

trait Validator {
	protected MessageBag $errorBags;

	abstract protected function rules(): array;

	abstract protected function message(): array;

	protected function validate($data = [])
	{
		$loader = new FileLoader( new Filesystem(), 'lang' );
		$translator = new Translator( $loader, 'en' );
		$validation = new Factory( $translator, new Container() );

		if (empty($data)) {
			$data = $this->data;
		}

		$validator = $validation->make($data, $this->rules(), $this->message());

		if ($validator->fails()) {
			return wp_send_json_error($validator->errors()->first(), 400);

			die();
		}

		return $validator->validated();
	}
}