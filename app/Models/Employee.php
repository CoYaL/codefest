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

}