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

class User extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [];

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

}