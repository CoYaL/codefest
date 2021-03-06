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
				$userId = $this->model->getUserId($username)->user_id;
				$nameObj = $this->model->getFullName($username);
				$fullName = (!empty($nameObj->middlename))
					? $nameObj->firstname.' '.$nameObj->middlename.' '.$nameObj->lastname
					: $nameObj->firstname.' '.$nameObj->lastname;
				Session::set('fullName',$fullName);
                Session::set('userID',$userId);
                Session::set('role',$this->model->getUser($username)->role_id);
				var_dump(Session::get('role'));
				switch(Session::get('role')){
					case '1':
						url::redirect('users');
						break;
					case '2':
						url::redirect('404');

						break;
					case '3':
						url::redirect('leave');

						break;
					case '4':
						url::redirect('employees');

						break;
					case '5':
						url::redirect('management/leaveRequests');

						break;
					default:
						url::redirect('404');
						break;
				}
                Session::set('role',$this->model->getUser($username)->role_id);
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