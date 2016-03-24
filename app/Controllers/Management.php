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

	private $model;

	public function __construct()
	{
		parent::__construct();

		$this->model = new \Models\Management();
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
		$data['requests'] = $this->model->getLeaveRequests();

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
			$id = (int)$_POST['id'];
			$state = $_POST['state'];
			$result = $this->model->updateLeaveState($state, $id);
		}
			echo json_encode($returnData);

	}
}