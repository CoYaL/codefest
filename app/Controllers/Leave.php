<?php
/**
 * Welcome controller.
 *
 * @author David Carr - dave@daveismyname.com
 *
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */
namespace Controllers;

use Core\Controller;
use Core\View;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Leave extends Controller
{
    /**
     * Call the parent construct.
     */
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Welcome');
    }

    public function index()
    {
        $data['title'] = $this->language->get('welcome_text');
        $data['welcome_message'] = $this->language->get('welcome_message');

        View::renderTemplate('header', $data);
        View::render('welcome/welcome', $data);
        View::renderTemplate('footer', $data);
    }

    public function sick()
    {
        $data = [];

        View::renderTemplate('header', $data);
        View::render('leave/sick', $data);
        View::renderTemplate('footer', $data);
    }

    public function holiday()
    {
        $data = [];

        View::renderTemplate('header', $data);
        View::render('leave/holiday', $data);
        View::renderTemplate('footer', $data);
    }
}
