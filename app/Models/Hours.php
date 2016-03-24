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
									WHERE e.user_id = :userID", [':userID' => $userID]);
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

    public function getHours($startdate, $enddate, $user_id = null)
    {
        if(!isset($user_id)) {
            $user_id = (int)$_SESSION['smvc_userID'];
        }

        $query = sprintf("
            SELECT 
              SUM(w.worktime) as worked, SUM(w.overtime) as overtime
            FROM employees as e
            JOIN workdays as w
              ON e.employee_id = w.employee_id
            WHERE '%s' <= w.day AND '%s' >= w.day
            AND e.user_id = '%s'
        ",$startdate, $enddate, $user_id);
        $result['work'] = $this->db->select($query);

        $query = sprintf("
            SELECT SUM(DATEDIFF(l.start_date, COALESCE(l.end_date,NOW()))) as sick
            FROM employees as e 
            JOIN `leave`  as l 
              ON e.employee_id = l.employee_id
            WHERE '%s' <= w.day AND '%s' >= w.day
            AND e.user_id = '%s'
            AND reason = 'ziek'
        ", $startdate, $enddate, $user_id);
        $result['sick'] = $this->db->select($query);

        $query = sprintf("
            SELECT SUM(DATEDIFF(l.start_date, COALESCE(l.end_date,NOW()))) as holiday
            FROM employees as e 
            JOIN `leave` as l 
              ON e.employee_id = l.employee_id
            WHERE '%s' <= w.day AND '%s' >= w.day
            AND e.user_id = '%s'
            AND reason = 'vakantie'
        ", $startdate, $enddate, $user_id);
        $result['holiday'] = $this->db->select($query);

        return $result;
    }


}