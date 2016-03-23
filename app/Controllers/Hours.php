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
use Helpers\Url;

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

	/**
	 * Define Registration page title and load template files.
	 */
	public function registration()
	{
		$data['title'] = 'Uren Registratie';
		$data['employeeName'] = 'Beau ter Ham';
		$data['projects'] = [
			['id' => 1, 'description' => 'Je moeder is een kuthoer'],
			['id' => 2, 'description' => 'Je vader is een kuthoer'],
			['id' => 3, 'description' => 'Je oma is een slet'],
		];


		View::renderTemplate('header', $data);
		View::render('hours/registration', $data);
		View::renderTemplate('footer', $data);

	}

	/**
	 * Define Overview page title and load template files.
	 */
	public function overview()
	{
		$data['title'] = 'Uren Overzicht';

		View::renderTemplate('header', $data);
		View::render('hours/overview', $data);
		View::renderTemplate('footer', $data);
	}

	public function submit(){
		url::redirect('');
	}
}