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
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
        $this->load->model("karyawan_model");
        $this->load->model("sakit_model");
    }

    public function index()
    {
        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Pengajuan Sakit akan segera di proses.
                                                    </div>";
        }
        elseif($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Mengubah data pengajuan sakit.
                                                    </div>";
        }
        elseif($in==3)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Sukses</strong> Berhasil Membatalkan pengajuan sakit.
                                                    </div>";
        }
        $this->load->model('karyawan_model');
        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d);
        {
            $id_karyawan = $d['karyawan_ID'];
        }
        $status = $this->sakit_model->countStatusSakit($id_karyawan);
        $data = $this->sakit_model->getSakit($id_karyawan);

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('sakit/pengajuan_sakit',  array('data' => $data, 'status' => $status, 'profile' => $id, 'notifikasi' => $notifikasi, 'total' => $total, 'message' => $message));
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
            $this->session->set_flashdata('in',3);
            redirect(base_url().'index.php/sakit');
        }
    }

    public function detail_sakit($id)
    {
        $data = $this->sakit_model->getDetailSakit($id);
        $profile = $this->karyawan_model->getProfile();
        foreach ($profile as $p)
        {
            $id_karyawan = $p['karyawan_ID'];
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);


        $this->load->view("sakit/data_sakit", array('data' => $data, 'profile' => $data, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function edit_sakit($id)
    {
        $file_size = null;
        $file_name=null;
        $result = null;
        $report = null;
        $error = null;
        $this->load->model("karyawan_model");
        $data = $this->sakit_model->getDetailSakit($id);
        $profile = $this->karyawan_model->getProfile();

        foreach ($profile as $p)
        {
            $id_karyawan = $p['karyawan_ID'];
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000';
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

            $this->upload->do_upload('surat_dokter');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
            if(isset($upload_data['image_size'])) {
                $file_size = $upload_data['image_size'];
            }

            if (($upload_data['image_type'] == "JPEG" || $upload_data['image_type'] == "JPG" || $upload_data['image_type'] == "PNG" || $upload_data['image_type'] == "jpeg" || $upload_data['image_type'] == "jpg" || $upload_data['image_type'] == "png"|| $upload_data['image_type'] == "") && $file_size < 2000) {
                $where = array('id_sakit' => $id);
                $update_array = null;
                if($file_name != null) {
                    $update_array = array(
                        'tanggal_pengajuan' => $tanggal_pengajuan,
                        'tanggal_sakit' => $tanggal_sakit,
                        'jumlah_hari' => $jumlah_hari,
                        'keterangan' => $keterangan,
                        'file' => $file_name
                    );
                }
                else{
                    $update_array = array(
                        'tanggal_pengajuan' => $tanggal_pengajuan,
                        'tanggal_sakit' => $tanggal_sakit,
                        'jumlah_hari' => $jumlah_hari,
                        'keterangan' => $keterangan
                    );
                }

                $update_izin = $this->db->update('sakit', $update_array, $where);
                if ($update_izin != null) {
                    $this->session->set_flashdata('in',2);
                    redirect(base_url() . "index.php/sakit");
                }
            }
            else{
                $error = '<div class="alert alert-warning" role="alert">Format File yang di izin kan PNG, JPG dan ukuran maksimal adalah 2mb</div>';
            }
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);


        $this->load->view("sakit/ubah_sakit", array('data' => $data, 'result' => $result, 'notifikasi' => $notifikasi, 'total' => $total, 'report' => $report,'error' => $error));
    }

    public function form_sakit()
    {
        $result = null;
        $error = null;

        $id = $this->karyawan_model->getProfile();
        foreach ($id as $d)
        {
            $id_karyawan = $d['karyawan_ID'];
        }

        $status = $this->sakit_model->countStatusSakit($id_karyawan);
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000';
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


            $this->upload->do_upload('surat_dokter');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            if (($upload_data['image_type'] == "JPEG" || $upload_data['image_type'] == "JPG" || $upload_data['image_type'] == "PNG" || $upload_data['image_type'] == "jpeg" || $upload_data['image_type'] == "jpg" || $upload_data['image_type'] == "png" || $upload_data['image_type'] == "") && $upload_data['image_size'] < 2000) {
                $data = array(
                    'karyawan_ID' => $id_karyawan,
                    'tanggal_pengajuan' => $tanggal_pengajuan,
                    'tanggal_sakit' => $tanggal_izin_sakit,
                    'jumlah_hari' => $jumlah_hari_sakit,
                    'keterangan' => $keterangan,
                    'file' => $file_name,
                    'status' => "Menunggu"
                );

                $insert = $this->db->insert('sakit', $data);
                if ($insert != null)
                {
                    $this->session->set_flashdata('in',1);
                    redirect(base_url() . "index.php/sakit");
                }
            }
            else{
                $error = '<div class="alert alert-warning" role="alert">Format File yang di izin kan PNG, JPG dan ukuran maksimal adalah 2mb</div>';
            }
        }

        $notifikasi = $this->karyawan_model->getNotifikasi($id_karyawan);
        $total = $this->karyawan_model->getCountNotifikasi($id_karyawan);

        $this->load->view('sakit/input_sakit', array('result' => $result, 'status' => $status, 'data' => $id, 'notifikasi' => $notifikasi, 'total' => $total, 'error' => $error));
    }
}