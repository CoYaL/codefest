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
use Helpers\Session;
use Helpers\Url;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Leave extends Controller
{
    private $model;

    /**
     * Call the parent construct.
     */
    public function __construct()
    {
        parent::__construct();
        $this->model = new \Models\Leave();
    }

    public function index()
    {
        $data = [];
        $data['date_today'] = date("d-m-Y");
        $data['title'] = 'Verlof aanvragen';
        $data['javascript'] = ['leave/index'];

        $settings = $this->model->getThreshold();
        $data['threshold'] = date('d-m-Y', mktime(0, 0, 0, date('m'), date('d')+(int)$settings->vacation_threshold, date('Y')));
        Session::set('threshold', $data['threshold']);
        View::renderTemplate('header', $data);
        View::render('leave/index', $data);
        View::renderTemplate('footer', $data);
    }

    public function addLeave()
    {
        if(isset($_POST['leave_type']) && isset($_POST['start_date'])){
            $data = [];
            $startDate = date_create_from_format('d-m-Y', $_POST['start_date']);
            $data['reason'] = $_POST['leave_type'];
            $data['start_date'] = $startDate->format('Y-m-d H:i:s');
            if($_POST['end_date']){
                $endDate = date_create_from_format('d-m-Y', $_POST['end_date']);
                $data['end_date'] = $endDate->format('Y-m-d H:i:s');
            }
            var_dump($data);
            $result = $this->model->addRequest($data);

        }
        if($result){
            Url::redirect('leave');
        }else{
            Url::redirect('');
        }
    }
}
