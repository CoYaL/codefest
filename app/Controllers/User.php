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
        $username = null;
        $password = null;
        $firstname = null;
        $middlename = null;
        $lastname = null;
        $email = null;
        $dateOfBirth = null;

        $user = [
            'username'=>$username,
            'password'=>$password,
            'firstname'=>$firstname,
            'middlename'=>$middlename,
            'lastname'=>$lastname,
            'email'=>$email,
            'date_of_birth'=>$dateOfBirth,

        ];
        $this->model->create($user);
    }

    public function edit()
    {
    }

    public function delete()
    {
    }

    public function getUsers()
    {
        $data = [];
        $data[] = [
            'user_id' => '1',
            'name' => 'Jamey van Heel',
            'email' => 'test',
            'birthdate' => '01-01-1900',
            'role' => 'Admin',
            'factor' => '1.00',
            'department' => 'Administratie',
            'state' => 'Actief',
        ];

        print json_encode($data);
    }

}