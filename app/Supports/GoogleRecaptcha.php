<?php

namespace App\Supports;

use App\Requests\PostGoogleReCaptchaSiteVerifyRequest;

class GoogleRecaptcha {

	public function __construct(
		public string $token
	) {
	}

	public function validate(): bool
	{
		return $this->createAssessment();
	}

	protected function createAssessment(): bool
	{
		$request = PostGoogleReCaptchaSiteVerifyRequest::make($this->token);
		$response = $request->send()
			->collect();
		/*
		- google response score is between 0.0 to 1.0
		- if score is 0.5, it's a human
		- if score is 0.0, it's a bot
		- google recommend to use score 0.5 for verify human
		*/
		if ($response['success'] && $response['score'] >= 0.5) {
			return true;
		} else {

			/*
			 * if score is less than 0.5, you can do following things
			 * login => 	With low scores, require 2-factor-authentication or email verification to prevent credential stuffing attacks.
			 * social =>     With low scores, require additional verification steps, such as a CAPTCHA or email verification.
			 *              - Limit unanswered friend requests from abusive users and send risky comments to moderation.
			 * e-commerce => Put your real sales ahead of bots and identify risky transactions.
			 * */
			return false;
		}
	}
}