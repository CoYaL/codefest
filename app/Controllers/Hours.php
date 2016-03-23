<?php
/**
 * Created by PhpStorm.
 * User: Connor
 * Date: 23/03/2016
 * Time: 14:12
 */

namespace Controllers;


use Core\Controller;
use Core\View;

class Hours extends Controller
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
		$data['title'] = 'Uren';

		View::renderTemplate('header', $data);
		View::render('hours/index', $data);
		View::renderTemplate('footer', $data);
	}

	public function registration()
	{
		$data['title'] = 'Uren Registratie';

		View::renderTemplate('header', $data);
		View::render('hours/registration', $data);
		View::renderTemplate('footer', $data);

	}

	public function overview()
	{
		$data['title'] = 'Uren Overzicht';

		View::renderTemplate('header', $data);
		View::render('hours/overview', $data);
		View::renderTemplate('footer', $data);
	}
}