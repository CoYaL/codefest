<?php
/**
 * User: Conner
 * Date: 23/03/2016
 * Time: 21:06
 */

namespace Models;


use Core\Model;

class Employee extends Model
{

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getDepartments()
    {
        $data = $this->db->getEnumValues('employees', 'department');
        return $data;
    }

    public function getStates()
    {
        $data = $this->db->getEnumValues('employees', 'state');
        return $data;
    }

    public function getEmployees()
    {
        $query = "
            SELECT e.*,
              u.user_id, u.firstname, u.middlename, u.lastname,
              (SELECT COUNT(*)) as maxRows
            FROM employees as e
            LEFT JOIN users as u
              ON e.user_id = u.user_id
            WHERE e.state != 'inactief'
            AND u.state!= 'inactief'
            ";
        $data = $this->db->select($query);

        return $data;
    }

    public function getUsers()
    {
        $query = "
            SELECT u.user_id, u.firstname, u.middlename, u.lastname
            FROM users AS u 
            WHERE state = 'actief'
        ";
        $data = $this->db->select($query);

        return $data;
    }

    public function create($data = [])
    {
        $userId = $this->db->insert('employees', $data);
        return $userId;
    }

    public function update($data, $where){
        $this->db->update("employees", $data, $where);
    }

    public function delete($employeeID){
        $this->db->delete('employees', array('employee_id'=>$employeeID));
    }

}