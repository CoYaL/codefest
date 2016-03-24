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

class User extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Users();
    }

    public function index()
    {
        $data = [];

        $data['javascript'] = ['users/index'];

        View::renderTemplate('header', $data);
        View::render('users/index', $data);
        View::renderTemplate('footer', $data);
    }

    public function add()
    {
        $date = date_create_from_format('d-m-Y', $_POST['date_of_birth']);
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $dateOfBirth = $date->format("Y-m-d");
        $role = $_POST['role'];

        $user = [
            'username' => $username,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'email' => $email,
            'date_of_birth' => $dateOfBirth,
            'role_id' => $role,
        ];
        $_POST['user_id'] = $this->model->create($user);
        $_POST['date_of_birth'] = date("d-m-Y", $_POST['date_of_birth']);

        print json_encode($_POST);
    }

    public function edit()
    {
        $user_id = $_POST['user_id'];
        $date = date_create_from_format('d-m-Y', $_POST['date_of_birth']);
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $dateOfBirth = $date->format("Y-m-d");
        $role = $_POST['role'];

        $user = [
            'username' => $username,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'email' => $email,
            'date_of_birth' => $dateOfBirth,
            'role_id' => $role,
        ];

        $where = [
            'user_id' => $user_id,
        ];

        $this->model->update($user,$where);
        $_POST['date_of_birth'] = date("d-m-Y", $_POST['date_of_birth']);

        print json_encode($_POST);
    }

    public function delete()
    {
        $user = [
            'state' => 'inactief',
        ];

        $where = [
            'user_id' => $_POST['user_id'],
        ];

        $this->model->update($user,$where);
    }

    public function getUsers()
    {
        $data = $this->model->getUsers();

        print json_encode($data);
    }

    public function getRoles()
    {
        $data = $this->model->getRoles();

        print json_encode($data);
    }

}