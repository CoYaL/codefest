<?php
/**
 * Created by PhpStorm.
 * User: Rohkin
 * Date: 3/23/2016
 * Time: 16:44
 */

namespace Controllers;

use Core\Controller;
use Core\View;
use Helpers\Url;
use Helpers\Hooks;

class Employee extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Employee();
    }

    public function index()
    {
        $data = [];

        $data['javascript'] = ['employee/index'];

        View::renderTemplate('header', $data);
        View::render('employee/index', $data);
        View::renderTemplate('footer', $data);
    }

    public function add()
    {
        $user_id = $_POST['user_id'];
        $factor = $_POST['factor'];
        $department = $_POST['department'];
        $state = $_POST['state'];

        $user = [
            'user_id' => $user_id,
            'factor' => $factor,
            'department' => $department,
            'state' => $state,
        ];
        $_POST['employee_id'] = $this->model->create($user);

        print json_encode($_POST);
    }

    public function edit()
    {
        $employee_id = $_POST['employee_id'];
        $user_id = $_POST['user_id'];
        $factor = $_POST['factor'];
        $department = $_POST['department'];
        $state = $_POST['state'];

        $employee = [
            'user_id' => $user_id,
            'factor' => $factor,
            'department' => $department,
            'state' => $state,
        ];

        $where = [
            'employee_id' => $employee_id,
        ];

        $this->model->update($employee, $where);

        print json_encode($_POST);
    }

    public function delete()
    {
        $user = [
            'state' => 'inactief',
        ];

        $where = [
            'employee_id' => $_POST['employee_id'],
        ];

        $this->model->update($user, $where);
    }

    public function getEmployees()
    {
        $data = $this->model->getEmployees();
        print json_encode($data);
    }

    public function getUsers()
    {
        $data = $this->model->getUsers();
        print json_encode($data);
    }

    public function getStates()
    {
        $data = $this->model->getStates();
        print json_encode($data);
    }

    public function getDepartments()
    {
        $data = $this->model->getDepartments();
        print json_encode($data);
    }

}