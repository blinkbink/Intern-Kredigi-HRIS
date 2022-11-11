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
            $this->db->select('*');
            $this->db->from('cuti a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->order_by('a.tanggal_pengajuan', "DESC");
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
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->where('status', "Pending");
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
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
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
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
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
}