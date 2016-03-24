<?php
/**
 * User: Conner
 * Date: 23/03/2016
 * Time: 18:15
 */

namespace Models;

use Core\Model;

class Authentication extends Model
{
    /**
     * Authentication constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getHash($username){
        $data = $this->db->select("SELECT password FROM users WHERE username = :username",
            array(':username' => $username));
        return $data[0]->password;
    }

    public function getUserId($username)
    {
        $data = $this->db->select("
            SELECT user_id
            FROM users
            WHERE username=:username",
                array(':username'=>$username));
        return $data[0];
    }

    public function getFullName($username)
    {
        $data = $this->db->select("
            SELECT firstname, middlename, lastname
            FROM users
            WHERE username = :username",
                [':username' => $username]);

        return $data[0];
    }
}