<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 27/07/2017
 * Time: 11:11
 */

class login_model extends CI_Model
{
    function integrity_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query  = $this->db->get('user');

        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}