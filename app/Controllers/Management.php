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
			['leaveID' => 0, 'name' => 'Harry Potter', 'department' => 'commercial', 'reason' => 'sick',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => '', 'status' => null],
			['leaveID' => 1, 'name' => 'Jamey van Heel', 'department' => 'helpdesk', 'reason' => 'vacation',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => 'Kerst inhalen', 'status' => 'denied'],
			['leaveID' => 2, 'name' => 'Conner Orth', 'department' => 'administration', 'reason' => 'vacation',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => 'Oud en Nieuw', 'status' => 'accepted'],
			['leaveID' => 3, 'name' => 'Albus Perkamentus', 'department' => 'management', 'reason' => 'sick',
				'startDate' => '23/03/2016', 'endDate' => '30/03/2016', 'description' => '', 'status' => null],
		];

		$data['javascript'] = ['management/leaveRequests'];

		View::renderTemplate('header', $data);
		View::render('management/leaveRequests', $data);
		View::renderTemplate('footer', $data);
	}

	public function updateLeave()
	{
		$returnData = [];
		if(isset($_POST['state']) && isset($_POST['id'])) {
			$returnData['id'] = $_POST['id'];
			$returnData['class'] = 'success';
			$returnData['status'] = 'Accepted';

			if($_POST['state'] === 'denied') {
				$returnData['class'] = 'danger';
				$returnData['status'] = 'Denied';
			}
		}

		echo json_encode($returnData);
	}
}