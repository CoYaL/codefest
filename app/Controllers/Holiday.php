<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 05:21
 */

namespace Controllers;


use Core\Controller;
use Core\View;

class Holiday extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Holidays();
    }

    public function index()
    {
        $data['title'] = 'Holidays';

        View::renderTemplate('header', $data);
        View::render('holidays/index', $data);
        View::renderTemplate('footer', $data);
    }
}