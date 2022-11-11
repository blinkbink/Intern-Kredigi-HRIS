<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 27/07/2017
 * Time: 11:12
 */

class karyawan_model extends CI_Model
{
    //var $conf;
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
    }

    public function getProfile()
    {
        $this->db->select('*, datediff(CURDATE(), mulai_kerja) as total_kerja');
        $this->db->from('karyawan a');
        $this->db->join('user b', 'b.karyawan_ID = a.karyawan_ID', 'left');
        $this->db->where('b.username', $_SESSION['username']);
        $query = $this->db->get();
        if ($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getPerubahan()
    {
        $this->db->select('*');
        $this->db->from('user a');
        $this->db->join('perubahan b', 'b.karyawan_ID = a.karyawan_ID', 'left');
        $this->db->where('a.username', $_SESSION['username']);
        $this->db->order_by("idperubahan", "DESC");
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

    public function getNotifikasi($id_karyawan)
    {
        $this->db->select('judul, tanggal_notifikasi');
        $this->db->from('notifikasi a');
        $this->db->join('karyawan b', 'a.id_karyawan = b.karyawan_ID', 'left');
        $this->db->where('a.id_karyawan', $id_karyawan);
        $this->db->where('timestampdiff(day,tanggal_notifikasi, now()) <= 2');
        $this->db->order_by('a.tanggal_notifikasi', "DESC");
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

    public function getCountNotifikasi($id_karyawan)
    {
        $this->db->select('COUNT(tanggal_notifikasi) as total');
        $this->db->from('notifikasi a');
        $this->db->join('karyawan b', 'a.id_karyawan = b.karyawan_ID', 'left');
        $this->db->where('timestampdiff(day,tanggal_notifikasi, now()) <= 2');
        $this->db->where('a.id_karyawan', $id_karyawan);
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
    
    public function get_karir($id_karyawan)
    {
        $this->db->from('karyawan a');
        $this->db->join('perusahaan b', 'a.perusahaan_ID = b.perusahaan_ID', 'left');
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