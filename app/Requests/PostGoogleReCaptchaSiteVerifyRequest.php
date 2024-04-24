<?php

namespace App\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Traits\Body\HasFormBody;

class PostGoogleReCaptchaSiteVerifyRequest extends SoloRequest implements HasBody
{
	use HasFormBody;

	protected Method $method = Method::POST;

	public function __construct(
		private string $token,
	) {
	}

	public function resolveEndpoint(): string
	{
		return 'https://www.google.com/recaptcha/api/siteverify';
	}

	public function defaultHeaders(): array
	{
		return [
			'Content-Type' => 'application/x-www-form-urlencoded',
		];
	}

	public function defaultBody(): array
	{
		return [
			'secret' => $_ENV['RECAPTCHA_SECRET_KEY'],
	        'response' => $this->token,
		];
	}
}