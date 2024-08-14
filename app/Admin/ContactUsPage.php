<?php

namespace App\Admin;

use BoxyBird\Inertia\Inertia;

class ContactUsPage {
	public function __construct()
	{
		add_action( 'admin_menu', array($this, 'menu') );
	}

	public function menu()
	{
		add_menu_page('Contact Us', 'Contact Us', 'publish_posts', 'contact-us', [$this, 'page'], 'dashicons-email', 4);
	}

	protected function data($search = '', $sort = '', $dir = 'ASC', $length = 50, $page = 1): array
	{
		global $wpdb;

		$table = "{$wpdb->prefix}contact_us";

		$page = (int)$page  - 1;
		$offset = (int)$length * $page;

		$select = "`id`, `name`, `contact_number`, `email`, `message`, `created_at`";

		$filter = '';

		$filter = "`name` LIKE %s OR
            `contact_number` LIKE %s OR
            `email` LIKE %s OR
            `message` LIKE %s OR
        ";

		$prepare[] = '%' . $wpdb->esc_like( $search ) . '%';
		$prepare[] = '%' . $wpdb->esc_like( $search ) . '%';
		$prepare[] = '%' . $wpdb->esc_like( $search ) . '%';
		$prepare[] = '%' . $wpdb->esc_like( $search ) . '%';

		$result = $wpdb->get_results(
			$wpdb->prepare("SELECT COUNT(1) as totalItems FROM `$table` WHERE $filter GROUP BY page", $prepare)
		);
		$totalItems = $result[0]->totalItems ?? 0;

		$result = $wpdb->get_results(
			$wpdb->prepare("SELECT $select FROM `$table` WHERE $filter ORDER BY $sort $dir LIMIT $length OFFSET $offset", $prepare)
		);

		foreach($result as $key => $row)
		{
			$result[$key]->truncatedMessage = '';
			if( strlen($result[$key]->message) > 45 ) $result[$key]->truncatedMessage = substr($result[$key]->message, 0, 45) . '...';
			$result[$key]->created_at = date_create($result[$key]->created_at)->format('m/d/Y h:i A');
		}

		$page = $page + 1;
		$totalFull = $totalItems / $length;
		$totalRow = floor($totalFull);
		$totalDecimal = $totalFull - $totalRow;
		if( $totalDecimal > 0.0  ) $totalRow += 1;

		$result_json = json_encode($result, JSON_INVALID_UTF8_SUBSTITUTE);
		return [
			'data' => $result,
			'json' => $result_json,
			'json_error' => json_last_error_msg(),
			'rowCount' => $totalItems,
			'page' => empty($page) ? 1 : $page,
			'pagination' => paginate_links( array(
				'base'         => '#',
				'total'        => $totalRow,
				'current'      => max( 1, $page ),
				'format'       => '',
				'show_all'     => false,
				'type'         => 'plain',
				'end_size'     => 2,
				'mid_size'     => 1,
				'prev_next'    => true,
				'prev_text'    => '<',
				'next_text'    => '>',
				'add_args'     => false,
				'add_fragment' => '',
			) )
		];
	}
	public function page()
	{
		Inertia::render('Admin/ContactUs/ContactUs');
	}
}