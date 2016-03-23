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
    }

    public function edit()
    {
    }

    public function delete()
    {
    }

    public function getUsers()
    {
        $data = $this->model->getUsers();

        print json_encode($data);
    }

}