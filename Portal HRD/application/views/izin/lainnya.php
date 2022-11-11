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
        Permohonan Izin Lainnya
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Izin</a></li>
        <li class="active">Lainnya</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Izin Lainnya</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="box-body">
            <button onclick="location.href='<?php echo base_url(). "index.php/izin/add_lainnya"?>'" class="btn display-block font-normal btn-success">+ Pengajuan Izin</button>
            <br><br>
            <?php if(isset($message))
            {
                echo $message;
            }
            ?>
            <table class="table table-hover table-striped" id="datatable">
                <thead>
                <tr class="success">
                    <th>Nama Karyawan</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Izin Lainnya</th>
                    <th>Status Persetujuan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                if($lainnya != null)
                {
                    foreach ($lainnya as $value)
                    { ?>
                        <tr>
                            <td><?php echo $value['nama_lengkap'] ?></td>
                            <td>
                                <?php
                                $convert = strtotime($value['tanggal_pengajuan']);
                                echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);
                                ?>
                            </td>
                            <td>
                                <?php
                                $convert = strtotime($value['tanggal_izin']);
                                echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);
                                ?>
                            </td>
                            <td><?php echo $value['status'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?=site_url('izin/detail_lainnya/'.$value['id_izin'])?>" type="button" class="btn btn-sm btn-info" >
                                        <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Detail"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-warning hapus-pengumuman" data-id="<?=$value['id_izin']?>" jumlah_hari="<?=$value['jumlah_hari']?>" tanggal_izin="<?=$value['tanggal_izin']?>" data-karir="0" karyawan_ID="<?=$value['karyawan_ID']?>">
                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Persetujuan"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php }}
                else{

                }?>
                </tbody>
            </table>
            <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form action="<?php echo base_url("index.php/izin/ubah_lainnya") ?>" role="form" class="form-horizontal" method="post">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Persetujuan Izin Lainnya</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table">
                                    <tr>
                                        <td>Ubah Persetujuan
                                            <input type="hidden" name="id_izin" id="id_data" value="">
                                            <input type="hidden" name="karyawan_ID" id="jjudul" value="">
                                            <input type="hidden" name="jumlah_hari" id="jml" value="">
                                            <input type="hidden" name="tanggal_izin" id="tgl" value="">
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
<script>
    $(function () {
        $('#datatable').DataTable();

        $(".hapus-pengumuman").click(function(){
            var divID = $(this).attr('data-id');
            var divKarir = $(this).attr('data-karir');
            var divWaktu = $(this).attr('waktuj');
            var divJudul = $(this).attr('karyawan_ID');
            var divJumlah = $(this).attr('jumlah_hari');
            var divTgl = $(this).attr('tanggal_izin');
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
                $('#myModal #myModalForm').attr('action', '<?=site_url("/izin/ubah_lainnya/")?>');
                $('#myModal .modal-header #myModalLabel').text('Persetujuan Izin Lainnya');
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
