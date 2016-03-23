<?php
/**
 * User: Conner
 * Date: 23/03/2016
 * Time: 19:50
 */

namespace Models;

use Core\Model;

class Users extends Model
{
    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getUsers($limit = null, $offset = null)
    {
        if($limit != null && $offset != null){
            $limit = sprintf("LIMIT %s,%s",$limit,$offset);
        }
        $data = $this->db->select("
            SELECT u.*,
              r.*,
              e.*,
              (SELECT COUNT(*)) as maxRows
            FROM users as u
            JOIN roles as r
              ON users.role_id = r.role_id
            JOIN employees as e
              ON users.user_id = e.user_id
            '.$limit.'
              ");
        return $data;
    }
}