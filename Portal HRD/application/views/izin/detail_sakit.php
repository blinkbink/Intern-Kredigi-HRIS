<?php
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
//var_dump($_POST);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Detail Izin Sakit
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Izin</a></li>
        <li class="active">Detail Sakit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Izin Sakit</h3>
            <a href="<?php echo base_url("index.php/izin/sakit")?>">Kembali</a>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div align="center" class="col-md-12">
                                <?php
                                foreach($data as $d) {
                                    ?>
                                    <div class="table-responsive">
                                        <div align="center" class="col-md-3">
                                            <img src="<?php echo base_url() . "./k/image/karyawan/" . $d['profil_picture'] . ".jpg" ?>"
                                                 class="img-thumbnail"
                                                 width="150" height="216">
                                        </div>
                                        <div class="col-md-9 col-sm-6 col-xs-12">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th>Nama Karyawan</th>
                                                    <td><?php echo $d['nama_lengkap'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Pengajuan</th>
                                                    <td>
                                                        <?php
                                                        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                                        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

                                                        $convert = strtotime($d['tanggal_pengajuan']);
                                                        echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);

                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Izin</th>
                                                    <td>
                                                        <?php
                                                        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                                        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

                                                        $convert = strtotime($d['tanggal_sakit']);
                                                        echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);

                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Hari Izin</th>
                                                    <td><?php echo $d['jumlah_hari'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Keterangan</th>
                                                    <td><?php echo $d['keterangan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Surat Sakit</th>
                                                    <td>
                                                        <?php
                                                        if($d['file'] == null)
                                                        {
                                                            echo "-";
                                                        }
                                                        else
                                                        {
                                                            ?>
                                                            <a href="<?php echo base_url() . "./k/uploads/" . $d['file'] . "" ?>"><img
                                                                    src="<?php echo base_url() . "./k/assets/icon/jpg.png" ?>"
                                                                    width="20"> </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td><?php echo $d['status'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Catatan</th>
                                                    <td><?php echo $d['catatan'] ?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-warning hapus-pengumuman" data-id="<?=$d['id_sakit']?>" jumlah_hari="<?=$d['jumlah_hari']?>" tanggal_sakit="<?=$d['tanggal_sakit']?>" data-karir="0" id_sakit="<?=$d['id_sakit']?>" karyawan_ID="<?=$d['karyawan_ID']?>">
                                            Ubah Persetujuan</i>
                                        </button>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->

        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <form action="<?php echo base_url("index.php/izin/ubah_sakit") ?>" role="form" class="form-horizontal" method="post">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Persetujuan Izin Sakit</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <tr>
                                    <td>Ubah Persetujuan
                                        <input type="hidden" name="id_sakit" id="id_data" value="">
                                        <input type="hidden" name="karyawan_ID" id="jjudul" value="">
                                        <input type="hidden" name="jumlah_hari" id="jml" value="">
                                        <input type="hidden" name="tanggal_sakit" id="tgl" value="">
                                        <select name="status" class="form-control" required oninvalid="this.setCustomValidity('Persetujuan Tidak Boleh Kosong')"
                                                oninput="setCustomValidity('')">
                                            <option value=""></option>
                                            <option value="Disetujui">Setujui</option>
                                            <option value="Tidak Disetujui">Tidak Disetujui</option>
                                            <option value="Menunggu">Menunggu</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Catatan
                                        <input type="text" name="catatan" class="form-control" placeholder="Catatan (Optional)">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="myModalSubmit">Ya</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="box-footer">

        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
    $(function () {
        $('#datatable').DataTable();

        $(".hapus-pengumuman").click(function(){
            var divID = $(this).attr('data-id');
            var divKarir = $(this).attr('data-karir');
            var divWaktu = $(this).attr('id_sakit');
            var divJudul = $(this).attr('karyawan_ID');
            var divJumlah = $(this).attr('jumlah_hari');
            var divTgl = $(this).attr('tanggal_sakit');
            var divOleh = $(this).attr('olehj');
            $("#myModal").modal("show");

            if(divKarir == '0'){
                $('#myModal .modal-body #id_data').val(divID);
                $('#myModal .modal-body #jwaktu').val(divWaktu);
                $('#myModal .modal-body #jjudul').val(divJudul);
                $('#myModal .modal-body #jml').val(divJumlah);
                $('#myModal .modal-body #tgl').val(divTgl);
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
