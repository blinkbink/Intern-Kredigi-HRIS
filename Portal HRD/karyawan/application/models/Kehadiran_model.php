<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:42
 */

class kehadiran_model extends CI_Model
{
    public function getKehadiran($id_karyawan, $dari, $sampai)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->where('tanggal >=', $dari);
            $this->db->where('tanggal <=', $sampai);
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

    public function getGroupKehadiran($id_karyawan, $dari, $sampai)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('COUNT(status_kehadiran) as hitung_status, status_kehadiran as nama_status, COUNT(status_kehadiran) as persentase');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->where('tanggal >=', $dari);
            $this->db->where('tanggal <=', $sampai);
            $this->db->group_by('a.status_kehadiran');

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

    public function getCountKehadiran($id_karyawan, $dari, $sampai)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('COUNT(status_kehadiran) as total_kehadiran');
            $this->db->from('absensi a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.idkaryawan', 'left');
            $this->db->where('tanggal >=', $dari);
            $this->db->where('tanggal <=', $sampai);
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
    }
}