<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 24/03/2016
 * Time: 05:44
 */

namespace Models;


use Core\Model;
use Helpers\Session;

class Leave extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addRequest($data){
		$employeeID = $this->db->select("
		SELECT e.employee_id
		FROM employees as e
		WHERE e.user_id = :userID
		",[':userID' => Session::get('userID')])[0];

		//cast employeeID to int
		$employeeID = (int)$employeeID;
		$data['employee_id'] = $employeeID;
		$result = $this->db->insert('`leave`', $data);

		return $result;
	}

	public function getThreshold()
	{
		$data = $this->db->select("
			SELECT *
			FROM global_settings
			WHERE year=:year",[':year'=>date('Y')]);
		return $data[0];
	}
}