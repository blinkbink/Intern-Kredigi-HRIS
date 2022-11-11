<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:09
 */

class cuti_model extends CI_Model
{
    public function getCuti($id_karyawan)
    {
        $this->db->select('*, datediff(tanggal_cuti, CURDATE()) as batas');
        $this->db->from('cuti a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.karyawan_ID', $id_karyawan);
        $this->db->order_by('a.id_cuti', "DESC");
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

    public function getCountCuti($id_karyawan)
    {
        $this->db->select('COUNT(status) as total');
        $this->db->from('cuti a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.karyawan_ID', $id_karyawan);
        $this->db->where('status', "Menunggu");
        $this->db->order_by("id_cuti", "DESC");
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

    public function getStatusCuti($id_karyawan)
    {
        $this->db->select('status, tanggal_cuti');
        $this->db->from('cuti a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.karyawan_ID', $id_karyawan);
        $this->db->order_by("id_cuti", "DESC");
        $this->db->limit(1);
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

    public function getDetailCuti($id)
    {
        $this->db->select('*');
        $this->db->from('cuti a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('id_cuti', $id);
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

    public function getJatah($id_karyawan)
    {
        $this->db->select('SUM(lama_cuti) as total_pengajuan');
        $this->db->from('cuti a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.karyawan_ID', $id_karyawan);
        $this->db->where('a.status', "Disetujui");
        $this->db->limit(1);
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