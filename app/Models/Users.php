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

        $query = sprintf("
            SELECT u.*,
              r.*,
              (SELECT COUNT(*)) as maxRows,
              DATE_FORMAT(u.date_of_birth, '%%d-%%m-%%Y') as date_of_birth
            FROM users as u
            JOIN roles as r
              ON u.role_id = r.role_id
            WHERE u.state = 'actief'
            %s", $limit);
        $data = $this->db->select($query);

        return $data;
    }

    public function getRoles()
    {
        $data = $this->db->select("
            SELECT *
            FROM roles");
        return $data;
    }

    public function create($data = [])
    {
        $userId = $this->db->insert('users', $data);
        return $userId;
    }

    public function getUserById($userId)
    {
        $data = $this->db->select("
            SELECT *
            FROM users as u
            JOIN roles as r
              ON u.role_id = r.role_id
            WHERE user_id=:userId",array(':userId'=>$userId));
        return $data[0];
    }

    public function update($data, $where)
    {
        $this->db->update("users",$data,$where);
    }

    public function delete($userID)
    {
        $this->db->delete('users',array('user_id'=>$userID));
    }
}