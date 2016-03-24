<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 05:21
 */

namespace Controllers;


use Core\Controller;
use Core\View;
use Helpers\Date;
use Helpers\Debug;

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
        $data['javascript'] = ['holiday/index'];

        View::renderTemplate('header', $data);
        View::render('holidays/index', $data);
        View::renderTemplate('footer', $data);
    }

    public function getHolidays()
    {
        $data = $this->model->getHolidays();
        print json_encode($data);
    }

    public function add()
    {
        $startdate = date('Y-m-d', strtotime($_POST['start_date']));
        $enddate = date('Y-m-d', strtotime($_POST['end_date']));

        $description = $_POST['description'];
        $payment_multiplier = $_POST['payment_multiplier'];

        $holiday = [
            'start_date' => $startdate,
            'end_date' => $enddate,
            'description' => $description,
            'payment_multiplier' => $payment_multiplier,
        ];
        $_POST['holiday_id'] = $this->model->create($holiday);

        print json_encode($_POST);
    }

    public function update()
    {
        $holidayId = $_POST['holiday_id'];
        $startdate = date('Y-m-d', strtotime($_POST['start_date']));
        $enddate = date('Y-m-d', strtotime($_POST['end_date']));

        $description = $_POST['description'];
        $payment_multiplier = $_POST['payment_multiplier'];

        $holiday = [
            'start_date' => $startdate,
            'end_date' => $enddate,
            'description' => $description,
            'payment_multiplier' => $payment_multiplier,
        ];

        $where = [
            'holiday_id' => $holidayId,
        ];
        $this->model->update($holiday, $where);

        print json_encode($_POST);

    }

    public function delete()
    {
        $holidayId = $_POST['holiday_id'];
        $this->model->delete($holidayId);
    }
}