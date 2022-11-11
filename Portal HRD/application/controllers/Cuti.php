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
class Cuti extends MY_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Cuti_model");
    }

    public function pengajuan(){
        $cuti = $this->Cuti_model->cuti();

        $message = null;
        $in = $this->session->flashdata('in');
        if($in==1)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Pengajuan Cuti Karyawan
                                                    </div>";
        }

        if($in==2)
        {
            $message = "<div class=\"alert alert-success alert-dismissable fade in\">
                                                        <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                                                        <strong>Berhasil</strong> Mengubah Pengajuan Cuti Karyawan
                                                    </div>";
        }

        $this->load->view("cuti/cuti", array('cuti' => $cuti, 'message' => $message));
    }

    public function ubah_cuti()
    {
        $id = $this->input->post('karyawan_ID');
        $id_sakit = $this->input->post('id_cuti');
        $status = $this->input->post('status');
        $catatan = $this->input->post('catatan');
        $jumlah_hari = $this->input->post('jumlah_hari');
        $tanggal_sakit = $this->input->post('tanggal_sakit');
        $arr = $this->Cuti_model->getKodeAbsensi($id);
        $kodeAbsensi = $arr['kode_absensi'];

        $where = array('id_cuti' => $id_sakit);
        $update_array = array(
            'status' => $status,
            'catatan' => $catatan
        );

        $notifikasi = array(
            'id_karyawan' => $id,
            'judul' => "Perubahan Status Pengajuan Cuti"
        );

        //insert/update tabel notifikasi dan sakit
        $insert = $this->db->insert('notifikasi', $notifikasi);
        $update_cuti = $this->db->update('cuti', $update_array, $where);

        //update/insert tabel absensi untuk field status_kehadiran
        if($status === "Disetujui"){
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_sakit,'8');
        } else {
            $this->changeStatusAbsensi($kodeAbsensi,$jumlah_hari,$tanggal_sakit,'1');
        }

        if($update_cuti != null)
        {
            $this->session->set_flashdata('in',1);
            redirect(base_url()."index.php/cuti/pengajuan");
        }
    }

    public function detail_cuti($id)
    {
        $data = $this->Cuti_model->detail_cuti($id);
        $this->load->view("cuti/detail_cuti", array('data' => $data));
    }

    public function add_cuti()
    {
        $error = null;
        $data = $this->Cuti_model->karyawan();

        if(isset($_POST['submit']))
        {
            $karyawan_id = $this->input->post('karyawan_id');
            $tanggal_pengajuan = $this->input->post('tanggal_pengajuan');
            $tanggal_cuti = date("Y-m-d", strtotime($this->input->post('tanggal_cuti')));
            $lama_cuti = $this->input->post('lama_cuti');
            $keterangan = $this->input->post('keterangan');
            $status = $this->input->post('status');
            $catatan = $this->input->post('catatan');
            $arr = $this->Cuti_model->getKodeAbsensi($karyawan_id);
            $kodeAbsensi = $arr['kode_absensi'];

            $data = array(
                    'karyawan_ID' => $karyawan_id,
                    'tanggal_pengajuan' => $tanggal_pengajuan,
                    'tanggal_cuti' => $tanggal_cuti,
                    'lama_cuti' => $lama_cuti,
                    'keterangan' => $keterangan,
                    'status' => $status,
                    'catatan' => $catatan
                );
                //input ke tabel sakit
                $insert = $this->db->insert('cuti', $data);

                //input/update tabel absensi status_kehadiran karyawan
                if($status === "Disetujui"){
                    $this->changeStatusAbsensi($kodeAbsensi,$lama_cuti,$tanggal_cuti,'8');
                }

                if ($insert != null)
                {
                    $this->session->set_flashdata('in',1);
                    redirect(base_url() . "index.php/cuti/pengajuan");
                }

        }

        $this->load->view("cuti/tambah_cuti", array('data' => $data, 'error' => $error));
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
                $ada = $this->Cuti_model->cekAbsensi($kodeAbsensi, $dt->format('Y-m-d'));
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

                    $this->Cuti_model->updateAbsensi($where, $data);
                } else { //jika belum ada di database, insert data
                    //echo " ga ada di database.";
                    $data = array(
                        'kode_absensi' => $kodeAbsensi,
                        'date' => $dt->format('Y-m-d'),
                        'status_kehadiran' => $status,
                        'tgl_input' => $now->format('Y-m-d h:i:s'),
                    );
                    $this->Cuti_model->insertAbsensi($data);
                }
            }
        } else {
            $error = '<div class="alert alert-warning" role="alert">Kode absensi karyawan kosong, harap diisi agar dapat update data absensi</div>';
            echo $error;
        }
    }
    //*/
}