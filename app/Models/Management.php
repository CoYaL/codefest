<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 24/03/2016
 * Time: 06:42
 */

namespace Models;


use Core\Model;

class Management extends Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function getLeaveRequests()
	{
		$result = $this->db->select("
		SELECT
			e.department as department,
			u.firstname as firstname, u.middlename as middlename, u.lastname as lastname,
			l.leave_id as leave_id, l.start_date as start_date, l.end_date as end_date, l.reason as reason, l.state as state
		FROM `leave` as l, employees as e, users as u
		WHERE l.employee_id = e.employee_id
			AND e.user_id = u.user_id
		");

		return $result;
	}

	public function updateLeaveState($state, $id)
	{

		$result = $this->db->update('`leave`', ['state' => $state], ['leave_id' => $id]);

		return $result;
	}
}