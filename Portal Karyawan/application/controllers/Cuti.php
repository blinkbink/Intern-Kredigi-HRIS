<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 17:09
 */

class Cuti extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
        $this->load->model("karyawan_model");
        $this->load->model("cuti_model");
    }

    public function index()
    {
        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Pengajuan Cuti akan segera di proses.
                                                    </div>";
        }
        elseif($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Mengubah data pengajuan cuti.
                                                    </div>";
        }
        elseif($in==3)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Membatalkan pengajuan cuti.
                                                    </div>";
        }
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }
        $dataCuti = $this->cuti_model->getCuti($id);
        $hitungCuti = $this->cuti_model->getCountCuti($id);
        $status = $this->cuti_model->getStatusCuti($id);
        $jatah = $this->cuti_model->getJatah($id);

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view('cuti/cuti_tahunan', array('profile' => $profile, 'dataCuti' => $dataCuti, 'hitungCuti' => $hitungCuti, 'status' => $status, 'notifikasi' => $notifikasi, 'total' => $total, 'jatah' => $jatah, 'message' => $message));

    }

    public function add_cuti()
    {
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $id);

        $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
        $tanggal_cuti = date("Y-m-d", strtotime($this->input->post('tanggal_cuti')));
        $lama_cuti = $this->input->post('lama_cuti');
        $keterangan = $this->input->post('keterangan');

        $data = array(
            'karyawan_ID'=> $id['karyawan_ID'],
            'tanggal_pengajuan'=>$tanggal_pengajuan,
            'tanggal_cuti'=>$tanggal_cuti,
            'lama_cuti'=>$lama_cuti,
            'keterangan'=>$keterangan,
            'status'=> "Menunggu"
        );

        $this->db->insert('cuti', $data);
        $this->session->set_flashdata('in',1);
        redirect(base_url()."index.php/cuti");
    }

    public function detail_cuti($id)
    {
        $data = $this->cuti_model->getDetailCuti($id);

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $this->load->view("cuti/detail_cuti", array('data' => $data, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function batal_cuti($id)
    {
        $where = array('id_cuti' => $id);
        $update_array = array(
            'status' => "Batal"
        );
        $update_data = $this->db->update('cuti', $update_array, $where);
        if($update_data != null)
        {
            $this->session->set_flashdata('in',3);
            redirect(base_url().'index.php/cuti');
        }
    }

    public function edit_cuti($id)
    {
        $result = null;
        $data = $this->cuti_model->getDetailCuti($id);

        if(isset($_POST['submit']))
        {
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_cuti = date("Y-m-d", strtotime($this->input->post('tanggal_cuti')));
            $lama_cuti = $this->input->post('lama_cuti');
            $keterangan = $this->input->post('keterangan');

            $where = array('id_cuti' => $id);
            $update_array = array(
                'tanggal_pengajuan' => $tanggal_pengajuan,
                'tanggal_cuti' => $tanggal_cuti,
                'lama_cuti' => $lama_cuti,
                'keterangan' => $keterangan
            );
            $update_izin = $this->db->update('cuti', $update_array, $where);
            if($update_izin != null)
            {
                $this->session->set_flashdata('in',2);
                redirect(base_url() . "index.php/cuti");
            }
        }

        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);
        $jatah = $this->cuti_model->getJatah($id);

        $this->load->view("cuti/edit_cuti", array('data' => $data, 'result' => $result, 'notifikasi' => $notifikasi, 'total' => $total, 'jatah' => $jatah));
    }

    public function form_cuti()
    {
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);
        $jatah = $this->cuti_model->getJatah($id);

        $this->load->view("cuti/form_cuti", array('notifikasi' => $notifikasi, 'total' => $total, 'jatah' => $jatah));
    }
}