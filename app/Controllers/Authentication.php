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
use Helpers\Password;
use Helpers\Url;
use Helpers\Session;

class Authentication extends Controller
{
    private $model;

	public function __construct()
	{
		parent::__construct();
		$this->model = new \Models\Authentication();
	}

	/**
	 * Define Index page title and load template files.
	 * @param mixed $error
	 */
	public function index($error = null)
	{
		if(Session::get('loggedin')){
			Url::redirect('leave');
		}
		$data['title'] = 'Login';

		View::renderTemplate('header', $data);
		View::render('authentication/index', $data, $error);
		View::renderTemplate('footer', $data);
	}

	public function login()
	{
        //redirect user if already loggedin
        if(Session::get('loggedin')){
            Url::redirect('leave');
        }
        //check if submit button contains POST data
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            //validation
            if(Password::verify($password, $this->model->getHash($username)) == false){
                $error[] = 'Gebruikersnaam of wachtwoord incorrect.';
            }
            //if validation has passed carry on
            if(!$error){
                Session::set('loggedin',true);
                Session::set('userID',$this->model->getUserID($username));

                url::redirect('leave');
            }
            else{
                $this->index($error);
            }
        }

	}


	public function logout()
	{
        Session::destroy();
		url::redirect('');
	}

}