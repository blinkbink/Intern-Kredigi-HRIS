<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:29
 */

class sakit_model extends CI_Model
{
    public function getSakit($id_karyawan)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->order_by("status", "DESC");

            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
    }

    public function getDetailSakit($id)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_sakit', $id);

            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
    }

    public function countStatusSakit($id_karyawan)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('count(status) as total');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->where('status', "Pending");

            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
    }
}