<?php
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<link href="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css"?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css"?>">
<link rel="stylesheet" href="<?php echo base_url(). "http://dev.kredigi.co.id/~yusuf/assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css"?>">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
//var_dump($_POST);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permohonan Cuti
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cuti</a></li>
        <li class="active">Pengajuan Cuti</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Form Pengajuan Cuti</h3>
            <a href="<?php echo base_url("index.php/cuti/pengajuan")?>">Kembali</a>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <form action="<?php echo base_url("index.php/cuti/add_cuti")?>" method="post" enctype="multipart/form-data">
                <div align="center" class="col-md-10">

                    <table class="table">
                        <tr>
                            <td>Tanggal Pengajuan</td>
                            <td><?php
                                $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

                                $convert = strtotime(date("j F o"));
                                echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);
                                ?> (Hari Ini)</td>
                            <td><input name="tanggal_pengajuan" value="<?php echo date("Y-m-d");?>" type="hidden" class="form-control" ></td>
                        </tr>

                        <tr>
                            <td>Nama Karyawan</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control" name="karyawan_id" required oninvalid="this.setCustomValidity('Karyawan Harus Dipilih')" oninput="setCustomValidity('')">
                                            <option value="">--Pilih Karyawan--</option>
                                            <?php
                                            foreach ($data as $data)
                                            {
                                                ?>
                                                <option value="<?php echo $data['karyawan_ID'] ?>"><?php echo $data['nama_lengkap'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="hidden" name="kode_absensi" value="<?=$data['kode_absensi']?>" > -->
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Tanggal Cuti</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="input-group date datepicker" >
                                            <input name="tanggal_cuti" id="datepicker" readonly required class="form-control" placeholder="" type="text">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </td></tr>

                        <tr>
                            <td>Lama Cuti</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input name="lama_cuti" type="number" max="7" min="1" class="form-control" required oninvalid="this.setCustomValidity('Jumlah hari tidak boleh kosong dan tidak lebih dari 7 hari')" oninput="setCustomValidity('')"><font color="red">*</font> Maksimal 7 hari
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <select class="form-control" name="status" required oninvalid="this.setCustomValidity('Status harus Di Pilih')" oninput="setCustomValidity('')">
                                            <option value="Disetujui">Setujui</option>
                                            <option value="Tidak Disetujui">Tidak Disetujui</option>
                                            <option value="Menunggu">Menunggu</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Keterangan</td>
                            <td><textarea class="form-control" name="keterangan" style="overflow:auto;resize:none" rows="6" cols="80" required oninvalid="this.setCustomValidity('Keterangan Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea></td>
                        </tr>

                        <tr>
                            <td>Catatan</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input name="catatan" type="text" class="form-control" required oninvalid="this.setCustomValidity('Catatan tidak boleh kosong')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <br>
                    <div align="right" class="col-md-7">
                        <input name="submit" type="submit" class="btn display-block font-normal btn-success" value="Simpan">
                    </div>

                    <div class="col-md-1">
                        <button class="btn display-block font-normal btn-default"
                                onclick="window.history.go(-1); return false;">Batal
                        </button>
                    </div>
                </div>
            </form>
            <!-- </form>-->
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(). "assets/js/jquery-ui.min.js"?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/fastclick/fastclick.js"?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/js/app.min.js"?>"></script>
</body>
</html>

<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"?>"></script>

<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            startDate: new Date(),
            todayHighlight: true,
            orientation: "top",
            autoclose:true,
            format: 'dd-mm-yyyy',
            onClose: function (selectedDate) {
                $("#txtStartDate").datepicker("option", "dateFormat", "dd-mm-yy", selectedDate);
            }
        }).datepicker("setDate", "0");
    });
</script>
<script>
    $(function () {
        $('#datatable').DataTable();

        $(".hapus-pengumuman").click(function(){
            var divID = $(this).attr('data-id');
            var divKarir = $(this).attr('data-karir');
            var divWaktu = $(this).attr('waktuj');
            var divJudul = $(this).attr('karyawan_ID');
            var divOleh = $(this).attr('olehj');
            $("#myModal").modal("show");

            if(divKarir == '0'){
                $('#myModal .modal-body #id_data').val(divID);
                $('#myModal .modal-body #jwaktu').val(divWaktu);
                $('#myModal .modal-body #jjudul').val(divJudul);
                $('#myModal .modal-body #joleh').val(divOleh);
                $('#myModal .modal-footer #myModalSubmit').show();
                $('#myModal #myModalForm').attr('action', '<?=site_url("/izin/ubah_sakit/")?>');
                $('#myModal .modal-header #myModalLabel').text('Persetujuan Izin Sakit');
                $('#myModal .modal-body').prepend('<p id="hapus-notif">Silahkan ubah status persetujuan</p>');
            } else {
                $('#myModal .modal-header #myModalLabel').text('Data Pengumuman gagal dihapus');
                $('#myModal').addClass('modal-danger');
                $('#myModal .modal-body').prepend('<p id="hapus-notif">Karyawan Sudah memiliki karir</p>');
                $('#myModal .modal-footer #myModalSubmit').hide();
            }
        });

        $('#myModal').on('hidden.bs.modal', function(){
            $('#myModal .modal-body #id_data').val('');
            $('#myModal .modal-body p').remove();
            $('#myModal').removeClass('modal-danger');
        });
    });
</script>
</body>
</html>