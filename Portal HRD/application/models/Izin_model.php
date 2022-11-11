<?php
class Izin_model extends CI_Model
{
    function karyawan()
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->where('perusahaan_ID', $perusahaanID);

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

    function sakit()
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('sakit a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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

    function detail_sakit($id)
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('sakit a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.id_sakit', $id);
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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

    function lainnya()
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('izin a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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

    function detail_lainnya($id)
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('izin a');
        $this->db->join('karyawan b', 'a.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('a.id_izin', $id);
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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
    
    function tugas()
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('tugas t');
        $this->db->join('karyawan b', 't.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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

    function detail_tugas($id)
    {
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $this->db->select('*');
        $this->db->from('tugas t');
        $this->db->join('karyawan b', 't.karyawan_ID = b.karyawan_ID', 'left');
        $this->db->where('t.id_tugas', $id);
        $this->db->where('b.perusahaan_ID', $perusahaanID);

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
    
    function getKodeAbsensi($idKaryawan){
        $this->db->select("kode_absensi");
        $this->db->from("karyawan");
        $this->db->where("karyawan_ID", $idKaryawan);
        $query = $this->db->get();
        foreach ($query->result_array() as $key){
            $kode = array('kode_absensi' => $key['kode_absensi']);
        }
        return $kode;
    }
    
    function cekAbsensi($kode,$date){
        $this->db->from("absensi");
        $this->db->where("kode_absensi", $kode);
        $this->db->where("date", $date);
        $query = $this->db->get();
        $ada = $query->num_rows();
        return $ada;
    }
    
    function insertAbsensi($data){
        $this->db->insert('absensi', $data);
    }
    
    function updateAbsensi($where, $data){
        $this->db->where($where);
        $this->db->update('absensi', $data);
    }
}
?>
