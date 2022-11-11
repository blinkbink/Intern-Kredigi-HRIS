<?php


class tim_model extends CI_Model
{

    public function getTIM($tim)
    {
        $this->db->select('*');
        $this->db->from('tim a');
        $this->db->join('karyawan b', 'b.karyawan_ID = a.karyawan_ID', 'left');
        $this->db->where('a.nama_tim', $tim);
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


    public function getKodeTIM($id_karyawan)
    {
        $this->db->select('*');
        $this->db->from('tim a');
        $this->db->where('a.karyawan_ID', $id_karyawan);
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
?>

