<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:29
 */

class Izin extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
        $this->load->model("karyawan_model");
        $this->load->model("izin_model");
    }

    public function index()
    {
        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Pengajuan Izin akan segera di proses.
                                                    </div>";
        }
        elseif($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Mengubah data pengajuan Izin.
                                                    </div>";
        }
        elseif($in==3)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Membatalkan pengajuan Izin.
                                                    </div>";
        }
        $this->load->model('karyawan_model');
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d);
        {
            $id_karyawan = $d['karyawan_ID'];
        }
        $status = $this->izin_model->countStatusIzin($id_karyawan);
        $data = $this->izin_model->getIzin($id_karyawan);

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('izin/pengajuan_izin', array('data' => $data, 'status' => $status, 'notifikasi' => $notifikasi, 'total' => $total, 'profile' => $id, 'message' => $message));
    }

    public function edit_izin($id)
    {
        $report = null;
        $this->load->model("karyawan_model");
        $data = $this->izin_model->getDetailIzin($id);

        if(isset($_POST['submit']))
        {
            $report = null;
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $jenis_izin = $this->input->post('jenis_izin');
            $tanggal_izin = date('Y-m-d', strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari_izin = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');

            $where = array('id_izin' => $id);
            $update_array = array(
                'tanggal_pengajuan' => $tanggal_pengajuan,
                'jenis' => $jenis_izin,
                'tanggal_izin' => $tanggal_izin,
                'jumlah_hari' => $jumlah_hari_izin,
                'keterangan' => $keterangan
            );
            $update_izin = $this->db->update('izin', $update_array, $where);
            if($update_izin != null)
            {
                $this->session->set_flashdata('in',2);
                redirect(base_url()."index.php/izin");
            }
        }

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view("izin/ubah_izin", array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total, 'report' => $report));
    }

    public function detail_izin($id)
    {
        $this->load->model("karyawan_model");
        $data = $this->izin_model->getDetailIzin($id);

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view("izin/data_izin", array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function form_izin()
    {
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d)
        {
            $id_karyawan = $d['karyawan_ID'];
        }

        if (isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $jenis_izin = $this->input->post('jenis_izin');
            $tanggal_izin = date("Y-m-d", strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari_izin = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');

            $data = array(
                'karyawan_ID'=> $id_karyawan,
                'tanggal_pengajuan'=>$tanggal_pengajuan,
                'tanggal_izin'=>$tanggal_izin,
                'jumlah_hari'=>$jumlah_hari_izin,
                'jenis'=>$jenis_izin,
                'keterangan'=> $keterangan,
                'status'=> "Menunggu"
            );

            $update = $this->db->insert('izin', $data);
            if($update != 0)
            {
                $this->session->set_flashdata('in',1);
                redirect(base_url()."index.php/izin");
            }

        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('izin/input_izin', array('data' => $id, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function batal_izin($id)
    {
        $where = array('id_izin' => $id);
        $update_array = array(
            'status' => "Batal"
        );
        $update_data = $this->db->update('izin', $update_array, $where);
        if($update_data != null)
        {
            $this->session->set_flashdata('in',3);
            redirect(base_url().'index.php/Izin');
        }
    }
}