<?php
/**
 * User: Conner
 * Date: 24/03/2016
 * Time: 05:01
 */

namespace Models;


use Core\Model;

class Holidays extends Model
{
    /**
     * Holidays constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getHolidays($start = null, $end = null)
    {
        $start = (!empty($start)) ? $start : date('Y-m-d', mktime(0, 0, 0, 1, 1, date('Y')));
        $end = (!empty($end)) ? $end : date('Y-m-d', mktime(0, 0, 0, 31, 12, date('Y')));

        $data = $this->db->select("
            SELECT *,
            DATE_FORMAT(start_date, '%d-%m-%Y') as start_date,
            DATE_FORMAT(end_date, '%d-%m-%Y') as end_date
            FROM holidays
            WHERE start_date >= :start AND end_date <= :end",
            array(':start'=>$start, ':end'=>$end));

        return $data;
    }
    public function create($data = [])
    {
        $holidayId = $this->db->insert('holidays', $data);
        return $holidayId;
    }


    public function update($data, $where)
    {
        $this->db->update('holidays', $data, $where);
    }

    public function delete($holidayId)
    {
        $this->db->delete('holidays',array('holiday_id'=>$holidayId));
    }
}