<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 13:01
 */

namespace Controllers;

use Core\Controller;
use Core\View;
use Helpers\Url;

class Authentication extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Define Index page title and load template files.
	 */
	public function index()
	{
		$data['title'] = 'Login';

		View::renderTemplate('header', $data);
		View::render('authentication/index', $data);
		View::renderTemplate('footer', $data);
	}

	public function login()
	{
		url::redirect('leave/index');
	}

}