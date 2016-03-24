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
use Helpers\Session;
use Helpers\Url;

class Hours extends Controller
{
	private $model;
	public function __construct()
	{
		parent::__construct();
		$this->model = new \Models\Hours();
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
		//cast to userid to int
		$userID = intval(Session::get('userID'));
		$userProjects = $this->model->getUserProjects($userID);

		foreach ($userProjects as $project) {
			$data['projects'][] = ['id' => $project->project_id, 'name' => $project->name];
		}

		$data['title'] = 'Uren Registratie';
		$data['employeeName'] = 'Beau ter Ham';

		View::renderTemplate('header', $data);
		View::render('hours/registration', $data);
		View::renderTemplate('footer', $data);

	}

    public function submit()
    {
        $userID = Session::get('userID');
		$date = date_create_from_format('d-m-Y',$_POST['date']);
		$day = $date->format('Y-m-d');
        $projectID = $_POST['projectID'];
        $overtime = $_POST['overtime'];
        $worktime = $_POST['worktime'];
        $result = $this->model->registerHours($userID, $projectID, $day, $overtime, $worktime);
        if($result){
            Url::redirect('hours/registration');
        }
    }

	public function getHours()
	{
		$startdate = date_create_from_format('d-m-Y', $_POST['startdate']);
		$enddate = date_create_from_format('d-m-Y', $_POST['enddate']);
		
		$data = $this->model->getHours($startdate->format('Y-m-d'), $enddate->format('Y-m-d'));

		print json_encode($data);
	}
    /**
     * Define Overview page title and load template files.
     */
    public function overview()
    {
        $data['title'] = 'Uren Overzicht';
		$data['javascript'] = ['hours/overview'];
        View::renderTemplate('header', $data);
        View::render('hours/overview', $data);
        View::renderTemplate('footer', $data);
    }
}