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
            $this->db->select('*');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
            $this->db->where('a.karyawan_ID', $id_karyawan);
            $this->db->order_by("id_sakit", "DESC");

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

    public function getDetailSakit($id)
    {
            $this->db->select('*');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
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

    public function countStatusSakit($id_karyawan)
    {
            $this->db->select('count(status) as total');
            $this->db->from('sakit a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
            $this->db->where('a.karyawan_ID', $id_karyawan);
            $this->db->where('status', "Menunggu");

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