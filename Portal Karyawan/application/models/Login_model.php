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
        $this->db->where('group', 'Karyawan');
        $this->db->where('active', '1');
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
    
    function cekUser($idKaryawan)
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->where('karyawan_ID', $idKaryawan);
        $this->db->where('perusahaan_ID', $perusahaanID);
        $this->db->where('group', 'Karyawan');
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