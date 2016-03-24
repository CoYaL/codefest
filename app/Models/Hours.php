<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 23:27
 */

namespace Models;


use Core\Model;
use Helpers\Debug;
use MongoDB\BSON\Timestamp;

class Hours extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getUserProjects($userID)
	{
		$data = $this->db->select("
									SELECT p.project_id, p.name
									FROM projects as p
										INNER JOIN employee_project as e_p
											ON p.project_id = e_p.project_id
											INNER JOIN employees as e
												ON e_p.employee_id = e.employee_id
									WHERE e.user_id = :userID", [':userID'=>$userID ]);
		return $data;
	}

	/**
	 * @param $userID
	 * @param $projectID
	 * @param  $date
	 * @param int $overtime
	 * @param int $worktime
	 * @return int
	 */
	public function registerHours($userID, $projectID, $date, $overtime = 0, $worktime = 0)
	{
		$employeeID = $this->db->select("
		SELECT e.employee_id
		FROM employees as e
		WHERE e.user_id = :userID",[':userID' => $userID])[0]->employee_id;
		//cast employeeID to int
		$employeeID = intval($employeeID);
		$result = $this->db->insert('workdays', ['overtime' => $overtime, 'worktime' => $worktime,
			'day' => $date,'employee_id' => $employeeID, 'project_id' => $projectID]);
		Debug::log($result);
		return $result;
	}


}