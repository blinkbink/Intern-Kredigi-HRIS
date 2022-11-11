<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:30
 */

class izin_model extends CI_Model
{
    public function getDetailIzin($id)
    {
            $this->db->select('*');
            $this->db->from('izin a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
            $this->db->where('a.id_izin', $id);

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

    public function getIzin($id_karyawan)
    {
            $this->db->select('*');
            $this->db->from('izin a');
            $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
            $this->db->where('a.karyawan_ID', $id_karyawan);
            $this->db->order_by("id_izin", "DESC");

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

    public function countStatusIzin($id_karyawan)
    {
            $this->db->select('count(status) as total');
            $this->db->from('izin a');
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