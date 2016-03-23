<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 17:23
 */

namespace Controllers;


use Core\Controller;
use Core\View;

class Management extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Define Index page title and load template files.
	 */
	public function index()
	{
		$data['title'] = 'Management';

		View::renderTemplate('header', $data);
		View::render('management/index', $data);
		View::renderTemplate('footer', $data);
	}

	public function leaveRequests()
	{
		$data['title'] = 'Verlof verzoeken';
		$data['requests'] = [
			['name' => 'Harry Potter', 'department' => 'commercial', 'reason' => 'sick',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => '', 'status' => null],
			['name' => 'Jamey van Heel', 'department' => 'helpdesk', 'reason' => 'vacation',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => 'Kerst inhalen', 'status' => 'denied'],
			['name' => 'Conner Orth', 'department' => 'administration', 'reason' => 'vacation',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => 'Oud en Nieuw', 'status' => 'accepted'],
			['name' => 'Albus Perkamentus', 'department' => 'management', 'reason' => 'sick',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => '', 'status' => null],
		];

		View::renderTemplate('header', $data);
		View::render('management/leaveRequests', $data);
		View::renderTemplate('footer', $data);
	}
}