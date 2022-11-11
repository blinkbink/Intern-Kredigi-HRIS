<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:28
 */

class Sakit extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("sakit_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $this->load->model('karyawan_model');
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d);
        {
            $id_karyawan = $d['idkaryawan'];
        }
        $status = $this->sakit_model->countStatusSakit($id_karyawan);
        $data = $this->sakit_model->getSakit($id_karyawan);

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('sakit/pengajuan_sakit',  array('data' => $data, 'status' => $status, 'profile' => $id, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function batal_sakit($id)
    {
        $where = array('id_sakit' => $id);
        $update_array = array(
            'status' => "Batal"
        );
        $update_data = $this->db->update('sakit', $update_array, $where);
        if($update_data != null)
        {
            redirect(base_url().'sakit');
        }
    }

    public function detail_sakit($id)
    {
        $data = $this->sakit_model->getDetailSakit($id);
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['idkaryawan'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);


        $this->load->view("sakit/data_sakit", array('data' => $data, 'profile' => $data, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function edit_sakit($id)
    {
        $file_name=null;
        $result = null;
        $report = null;
        $this->load->model("karyawan_model");
        $data = $this->sakit_model->getDetailSakit($id);
        $profile = $this->karyawan_model->getProfile();

        foreach ($profile as $p)
        {
            $id_karyawan = $p['idkaryawan'];
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '10000';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if(isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_sakit = date('Y-m-d', strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');
            $surat_dokter = $this->input->post('surat_dokter');

            if($this->upload->do_upload('surat_dokter')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
            }

            $where = array('id_sakit' => $id);
            $update_array = array(
                'tanggal_pengajuan' => $tanggal_pengajuan,
                'tanggal_sakit' => $tanggal_sakit,
                'jumlah_hari' => $jumlah_hari,
                'keterangan' => $keterangan,
                'file' => $file_name
            );
            $update_izin = $this->db->update('sakit', $update_array, $where);
            if($update_izin != null)
            {
                $report = '<div class="alert alert-success" role="alert">Sukses Mengubah Pengajuan Sakit Anda</div>';
            }
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);


        $this->load->view("sakit/ubah_sakit", array('data' => $data, 'result' => $result, 'notifikasi' => $notifikasi, 'total' => $total, 'report' => $report));
    }

    public function form_sakit()
    {
        $result = null;

        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d)
        {
            $id_karyawan = $d['idkaryawan'];
        }

        $status = $this->sakit_model->countStatusSakit($id_karyawan);
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = '10000';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if(isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_izin_sakit = date("Y-m-d", strtotime($this->input->post('tanggal_izin')));
            $jumlah_hari_sakit = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');

            if($this->upload->do_upload('surat_dokter')) {
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
            }

            $data = array(
                'id_karyawan'=> $id_karyawan,
                'tanggal_pengajuan'=>$tanggal_pengajuan,
                'tanggal_sakit'=>$tanggal_izin_sakit,
                'jumlah_hari'=>$jumlah_hari_sakit,
                'keterangan'=> $keterangan,
                'file'=> $file_name,
                'status'=> "Pending"
            );

            $insert = $this->db->insert('sakit', $data);
            if($insert != null)
            {
                $result = '<div class="alert alert-success" role="alert">Sukses Mengajukan Sakit, Pengajuan anda akan di proses <a href="sakit">kembali</a> </div>';
                redirect(base_url()."sakit");
            }
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('sakit/input_sakit', array('result' => $result, 'status' => $status, 'data' => $id, 'notifikasi' => $notifikasi, 'total' => $total));
    }
}