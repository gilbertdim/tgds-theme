<?php

class Installation {

	public static function setup(): void
	{
		$aboutPage = get_page_by_path( 'about', OBJECT, [ 'page' ] );

		if (empty($aboutPage)) {
			// Insert About Page
			wp_insert_post([
				'post_type' => 'page',
				'post_title' => 'About',
				'comment_status' => 'closed',
				'post_status' => 'publish',
				'post_content' => '<p class="mb-2">Being a developer is a very challenging and fulfilling profession. I love helping people and businesses to accomplish their goals and overcome challenges.
              </p>
            <p>I started my career as a technical support and a desktop application developer, I wrote codes using Visual Basic 6. And after 4 years I transition to Visual Basic .Net. After 6 years, I decided to upgrade my skills by learning web-based application development using PHP.</p>'
			]);
		}

	}
}