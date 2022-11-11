<?php
/* REFERENSI ada di tabel absensi_status_kehadiran
 * Status Kehadiran:
 * 1: Belum Ada Status
 * 2: Hadir Hari Kerja
 * 3: Mangkir
 * 4: Bukan Hari Kerja
 * 5: Tugas Luar
 * 6: Hadir Bukan Hari Kerja
 * 7: Izin
 * 8: Sakit
 * 9: Cuti
*/
class Izin extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Izin_model");
    }

    public function sakit(){
        $sakit = $this->Izin_model->sakit();

        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Izin Sakit Karyawan
                                                    </div>";
        }

        if($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Izin Sakit Karyawan
                                                    </div>";
        }

        $this->load->view("izin/sakit", array('sakit' => $sakit, 'message' => $message));
    }
    
    public function tugas(){
        $tugas = $this->Izin_model->tugas();

        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Tugas Luar Kantor Karyawan
                                                    </div>";
        }

        if($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Tugas Luar Kantor Karyawan
                                                    </div>";
        }

        $this->load->view("izin/tugas", array('tugas' => $tugas, 'message' => $message));
    }

    public function lainnya(){
        $lainnya = $this->Izin_model->lainnya();

        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Izin Karyawan
                                                    </div>";
        }

        if($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Izin Karyawan
                                                    </div>";
        }

        if($in==3)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Menambahkan Pengajuan Izin Lainnya
                                                    </div>";
        }

        $this->load->view("izin/lainnya", array('lainnya' => $lainnya, 'message' => $message));
    }


    public function ubah_sakit()
    {
        $id = $this->input->post('karyawan_ID');
        $id_sakit = $this->input->post('id_sakit');
        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');
        $jumlah_hari = $this->input->post('jumlah_hari');
        $tanggal_sakit = $this->input->post('tanggal_sakit');
        $arr = $this->Izin_model->getKodeAbsensi($id);
        $kodeAbsensi = $arr['kode_absensi'];

        $where = array('id_sakit' => $id_sakit);
        $update_array = array(
            'status' => $status,
            'catatan' => $catatan
        );

        $notifikasi = array(
            'id_karyawan' => $id,
            'judul' => "Perubahan Status Pengajuan Sakit"
        );

        //insert/update tabel notifikasi dan sakit
        $insert = $this->db->insert('notifikasi', $notifikasi);
        $update_sakit = $this->db->update('sakit', $update_array, $where);
        
        //update/insert tabel absensi untuk field status_kehadiran
        if($status === "Disetujui"){
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_sakit,'8');
        } else {
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_sakit,'1');
        }

        if($update_sakit != null)
        {
            $this->session->set_flashdata('in',1);
            redirect(base_url()."index.php/izin/sakit");
        }
    }

    public function ubah_tugas()
    {
        $id = $this->input->post('karyawan_ID');
        $id_tugas = $this->input->post('id_tugas');
        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');
        $jumlah_hari = $this->input->post('jumlah_hari');
        $tanggal_tugas = $this->input->post('tanggal_tugas');
        $arr = $this->Izin_model->getKodeAbsensi($id);
        $kodeAbsensi = $arr['kode_absensi'];

        $where = array('id_tugas' => $id_tugas);
        $update_array = array(
            'status' => $status,
            'catatan' => $catatan
        );

        $notifikasi = array(
            'id_karyawan' => $id,
            'judul' => "Perubahan Status Pengajuan Tugas Luar"
        );

        //insert/update tabel notifikasi dan sakit
        $insert = $this->db->insert('notifikasi', $notifikasi);
        $update_tugas = $this->db->update('tugas', $update_array, $where);
        
        //update/insert tabel absensi untuk field status_kehadiran
        if($status === "Disetujui"){
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_tugas,'5');
        } else {
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_tugas,'1');
        }

        if($update_tugas != null)
        {
            $this->session->set_flashdata('in',1);
            redirect(base_url()."index.php/izin/tugas");
        }
    }
    
    public function ubah_lainnya()
    {
        $id = $this->input->post('karyawan_ID');
        $id_izin = $this->input->post('id_izin');
        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');
        $jumlah_hari = $this->input->post('jumlah_hari');
        $tanggal_izin = $this->input->post('tanggal_izin');
        $arr = $this->Izin_model->getKodeAbsensi($id);
        $kodeAbsensi = $arr['kode_absensi'];

        $where = array('id_izin' => $id_izin);
        $update_array = array(
            'status' => $status,
            'catatan' => $catatan
        );

        $notifikasi = array(
            'id_karyawan' => $id,
            'judul' => "Perubahan Status Pengajuan Izin"
        );

        //input/update tabel notifikasi dan izin
        $insert = $this->db->insert('notifikasi', $notifikasi);
        $update_sakit = $this->db->update('izin', $update_array, $where);
        
        //update/insert tabel absensi untuk field status_kehadiran
        if($status === "Disetujui"){
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_izin,'7');
        } else {
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_izin,'1');
        }
        

        if($update_sakit != null)
        {
            $this->session->set_flashdata('in',1);
            redirect(base_url()."index.php/izin/lainnya");
        }
    }

    public function detail_sakit($id)
    {
        $data = $this->Izin_model->detail_sakit($id);
        $this->load->view("izin/detail_sakit", array('data' => $data));
    }
    
    public function detail_tugas($id)
    {
        $data = $this->Izin_model->detail_tugas($id);
        $this->load->view("izin/detail_tugas", array('data' => $data));
    }

    public function detail_lainnya($id)
    {
        $data = $this->Izin_model->detail_lainnya($id);
        $this->load->view("izin/detail_lainnya", array('data' => $data));
    }

    public function add_sakit()
    {
        $error = null;
        $data = $this->Izin_model->karyawan();

        $config['upload_path'] = './k/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if(isset($_POST['submit']))
        {
            $karyawan_id = $this->input->post('karyawan_id');
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_sakit = date("Y-m-d", strtotime($this->input->post('tanggal_sakit')));
            $jumlah_hari = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            $catatan = $this->input->post('catatan');
            $arr = $this->Izin_model->getKodeAbsensi($karyawan_id);
            $kodeAbsensi = $arr['kode_absensi'];
            
            $this->upload->do_upload('surat_dokter');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            if (($upload_data['image_type'] == "JPEG" || $upload_data['image_type'] == "JPG" || $upload_data['image_type'] == "PNG" || $upload_data['image_type'] == "jpeg" || $upload_data['image_type'] == "jpg" || $upload_data['image_type'] == "png" || $upload_data['image_type'] == "")){ //&& $upload_data['image_size'] < 2000) {
                $data = array(
                    'karyawan_ID' => $karyawan_id,
                    'tanggal_pengajuan' => $tanggal_pengajuan,
                    'tanggal_sakit' => $tanggal_sakit,
                    'jumlah_hari' => $jumlah_hari,
                    'keterangan' => $keterangan,
                    'file' => $file_name,
                    'status' => $status,
                    'catatan' => $catatan
                );
                //input ke tabel sakit
                $insert = $this->db->insert('sakit', $data);
                
                //input/update tabel absensi status_kehadiran karyawan
                if($status === "Disetujui"){
                    $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_sakit,'8');
                }
                
                if ($insert != null)
                {
                    $this->session->set_flashdata('in',1);
                    redirect(base_url() . "index.php/izin/sakit");
                }
            }
            else{
                $error = '<div class="alert alert-warning" role="alert">Format File yang di izin kan PNG, JPG dan ukuran maksimal adalah 2mb</div>';
            }
        }

        $this->load->view("izin/tambah_sakit", array('data' => $data, 'error' => $error));
    }

    public function add_tugas()
    {
        $error = null;
        $data = $this->Izin_model->karyawan();

        $config['upload_path'] = './k/uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2000';
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if(isset($_POST['submit']))
        {
            $karyawan_id = $this->input->post('karyawan_id');
            $tanggal_penetapan = $this->input->post('tanggal_penetapan');
            $tanggal_tugas = date("Y-m-d", strtotime($this->input->post('tanggal_tugas')));
            $jumlah_hari = $this->input->post('jumlah_hari');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            $catatan = $this->input->post('catatan');
            $arr = $this->Izin_model->getKodeAbsensi($karyawan_id);
            $kodeAbsensi = $arr['kode_absensi'];

            $this->upload->do_upload('surat_tugas');
            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];

            if (($upload_data['image_type'] == "JPEG" || $upload_data['image_type'] == "JPG" || $upload_data['image_type'] == "PNG" || $upload_data['image_type'] == "jpeg" || $upload_data['image_type'] == "jpg" || $upload_data['image_type'] == "png" || $upload_data['image_type'] == "")) { //&& $upload_data['image_size'] < 2000) {
                $data = array(
                    'karyawan_ID' => $karyawan_id,
                    'tanggal_penetapan' => $tanggal_penetapan,
                    'tanggal_tugas' => $tanggal_tugas,
                    'jumlah_hari' => $jumlah_hari,
                    'keterangan' => $keterangan,
                    'file' => $file_name,
                    'status' => $status,
                    'catatan' => $catatan
                );
                //input ke tabel tugas
                $insert = $this->db->insert('tugas', $data);
                
                //update/input ke tabel absensi
                if($status === "Disetujui"){
                    $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_tugas,'5');
                }
                
                if ($insert != null)
                {
                    $this->session->set_flashdata('in',1);
                    redirect(base_url() . "index.php/izin/tugas");
                }
            }
            else{
                $error = '<div class="alert alert-warning" role="alert">Format File yang di izin kan PNG, JPG dan ukuran maksimal adalah 2mb</div>';
            }
        }

        $this->load->view("izin/tambah_tugas", array('data' => $data, 'error' => $error));
    }
    
    public function add_lainnya()
    {
        $data = $this->Izin_model->karyawan();

        if(isset($_POST['submit']))
        {
            $karyawan_id = $this->input->post('karyawan_id');
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_izin = date("Y-m-d", strtotime($this->input->post('tanggal_izin')));
            $jenis_izin = $this->input->post('jenis_izin');
            $jumlah_hari = $this->input->post('jumlah_hari');
            $status = $this->input->post('status');
            $keterangan = $this->input->post('keterangan');
            $catatan = $this->input->post('catatan');
            $arr = $this->Izin_model->getKodeAbsensi($karyawan_id);
            $kodeAbsensi = $arr['kode_absensi'];
        
            $insert = array(
                'karyawan_ID'=> $karyawan_id,
                'tanggal_pengajuan'=>$tanggal_pengajuan,
                'tanggal_izin'=>$tanggal_izin,
                'jumlah_hari'=>$jumlah_hari,
                'jenis'=>$jenis_izin,
                'keterangan'=> $keterangan,
                'status'=> $status,
                'catatan'=> $catatan
            );
            //input ke tabel izin
            $update = $this->db->insert('izin', $insert);
            
            //update/input ke tabel absensi
            if($status === "Disetujui"){
                $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_izin,'7');
            }
            
            if($update != 0)
            {
                $this->session->set_flashdata('in',3);
                redirect(base_url()."index.php/izin/lainnya");
            }
        }

        $this->load->view("izin/tambah_lainnya", array('data' => $data));
    }
    //*
    function changeStatusAbsensi($kodeAbsensi,$jumlah,$tgl,$status){
        //cek dulu apakah ada kode absensi
        if($kodeAbsensi > 0){// || !empty($kodeAbsensi) || $kodeAbsensi != null){
            //echo "masukkk";
            $start  = new DateTime($tgl);
            $end = new DateTime($tgl);
            $end->modify('+'.$jumlah.' day');
            $now = new DateTime();
            $i      = 0;
            //echo "end: ".$end->format('Y-m-d')." start: ".$start->format('Y-m-d');
            //Membaca hari satu per satu dari tanggal $start ke tanggal $end
            for($dt = $start; $dt < $end; $dt->modify('+1 day')){
                //echo " eh mulai iterasinya.";
                //cek dulu apakah sudah ada datanya di tabel absensi
                //echo " dt: ".$dt->format('Y-m-d');
                $ada = $this->Izin_model->cekAbsensi($kodeAbsensi, $dt->format('Y-m-d'));
                if($ada > 0){ //jika sudah ada di database, update saja 
                    //echo " ada loh di database.";
                    $where = array(
                        'kode_absensi' => $kodeAbsensi,
                        'date' => $dt->format('Y-m-d'),
                    );
                    
                    $data = array(
                        'status_kehadiran' => $status,
                        'tgl_input' => $now->format('Y-m-d h:i:s'),
                    );
                    
                    $this->Izin_model->updateAbsensi($where, $data);
                } else { //jika belum ada di database, insert data
                    //echo " ga ada di database.";
                    $data = array(
                        'kode_absensi' => $kodeAbsensi,
                        'date' => $dt->format('Y-m-d'),
                        'status_kehadiran' => $status,
                        'tgl_input' => $now->format('Y-m-d h:i:s'),
                    );
                    $this->Izin_model->insertAbsensi($data);
                }
            }
        } else {
            $error = '<div class="alert alert-warning" role="alert">Kode absensi karyawan kosong, harap diisi agar dapat update data absensi</div>';
            echo $error;
        }
    }
    //*/
}