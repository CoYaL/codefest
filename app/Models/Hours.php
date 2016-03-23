<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 23:27
 */

namespace Models;


use Core\Model;

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


}