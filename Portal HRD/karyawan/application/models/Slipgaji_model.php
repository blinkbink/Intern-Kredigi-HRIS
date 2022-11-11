<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:38
 */

class slipgaji_model extends CI_Model
{
    public function getSlipGaji($id_karyawan)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('karyawan a');
            $this->db->join('slipgaji b', 'b.id_karyawan = a.idkaryawan', 'left');
            $this->db->where('a.idkaryawan', $id_karyawan);
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

    public function reportSlipGaji($id_slip)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('slipgaji a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('idslipgaji', $id_slip);
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