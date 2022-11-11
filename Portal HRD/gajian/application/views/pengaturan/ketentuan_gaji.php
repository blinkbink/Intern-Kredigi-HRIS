<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blank page
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12 modulContainer">
                    <div class="pertanyaanContainer">
                        <div class="row judulWizard">
                            <div class="col-md-10 padding-leftRight2">
                                <h4>5. Agar menerima Tunjangan Hari Raya (THR), berapa lama seorang personalia harus melalui masa kerja perusahaan Anda?<button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>/button></h4>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-info pull-right" data-toggle="modal" rel="tooltip" data-target="#myModal" data-placement="top" title="" data-original-title="Klik di sini untuk membaca petunjuk."><span class="infoBagian hide">Menurut Peraturan Menteri Ketenagakerjaan No. 6/2016 tentang Tunjangan Hari Raya (THR) Keagamaan, personalia dengan masa kerja minimal 1 bulan berhak mendapatkan THR.</span><i class="fa fa-question"></i></button>
                            </div>
                        </div>
                                                <div class="row pilihan inptKomponen">
                                                    <div class="col-xs-12 padding-leftRight">
                                                        <ul>
                                                            <li>
                                                                <div class="table_display">
                                                                    <div class="table_row">
                                                                        <div class="table_cell">
                                                                            <div class="row">
                                                                                <form action="" class="form-horizontal">
                                                                                    <div class="col-md-3">
                                                                                        <input type="text" id="lamaKerjaTHR" class="hanyaAngka form-control media-middle" value="1">
                                                                                    </div>
                                                                                    <label class="col-md-9 control-label">
                                                                                        <span class="pull-left">Bulan</span>
                                                                                    </label>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="backupLamaKerjaTHR" class="hide">1</div>
                                                <div class="row hasil btnMore">
                                                    <div class="col-xs-12 padding-leftRight">
                                                        <ul>
                                                            <li>
                                                                <div class="table_display">
                                                                    <div class="table_row">
                                                                        <div class="table_cell sign">
                                                                            <span id="hasilLamaKerjaTHR">1</span>
                                                                        </div>
                                                                        <div class="table_cell">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    Bulan
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row save_configuration inptKomponen">
                                                    <div class="col-xs-12 ">
                                                        <button class="btn btn-warning btn-gadjian btn-sm btnEdit simpan m-r-n-i" id="simpanLamaKerjaTHR">
                                                            Simpan
                                                        </button>
                                                        <button class="btn btn-danger btn-gadjian btn-sm btnEdit" id="batalLamaKerjaTHR">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
             <div class="row">
                                        <div class="col-xs-12 modulContainer">
                                            <div class="pertanyaanContainer">
                                                <div class="row judulWizard">
                                                    <div class="col-md-10 padding-leftRight2">
                                                        <h4>
                                                            5. Agar menerima Tunjangan Hari Raya (THR), berapa lama seorang personalia harus melalui masa kerja perusahaan Anda?                                                            <button class="btn btn-warning plaineditGadjian btn-sm ubahpengaturanModul btnMore">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                        </h4>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-sm btn-info btn-informasi pull-right" data-toggle="modal" rel="tooltip" data-target="#myModal" data-placement="top" title="" data-original-title="Klik di sini untuk membaca petunjuk."><span class="infoBagian hide">Menurut Peraturan Menteri Ketenagakerjaan No. 6/2016 tentang Tunjangan Hari Raya (THR) Keagamaan, personalia dengan masa kerja minimal 1 bulan berhak mendapatkan THR.</span><i class="fa fa-question"></i></button>
                                                    </div>
                                                </div>
                                                <div class="row pilihan inptKomponen">
                                                    <div class="col-xs-12 padding-leftRight">
                                                        <ul>
                                                            <li>
                                                                <div class="table_display">
                                                                    <div class="table_row">
                                                                        <div class="table_cell">
                                                                            <div class="row">
                                                                                <form action="" class="form-horizontal">
                                                                                    <div class="col-md-3">
                                                                                        <input type="text" id="lamaKerjaTHR" class="hanyaAngka form-control media-middle" value="1">
                                                                                    </div>
                                                                                    <label class="col-md-9 control-label">
                                                                                        <span class="pull-left">Bulan</span>
                                                                                    </label>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="backupLamaKerjaTHR" class="hide">1</div>
                                                <div class="row hasil btnMore">
                                                    <div class="col-xs-12 padding-leftRight">
                                                        <ul>
                                                            <li>
                                                                <div class="table_display">
                                                                    <div class="table_row">
                                                                        <div class="table_cell sign">
                                                                            <span id="hasilLamaKerjaTHR">1</span>
                                                                        </div>
                                                                        <div class="table_cell">
                                                                            <div class="row">
                                                                                <div class="col-xs-12">
                                                                                    Bulan
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="row save_configuration inptKomponen">
                                                    <div class="col-xs-12 ">
                                                        <button class="btn btn-warning btn-gadjian btn-sm btnEdit simpan m-r-n-i" id="simpanLamaKerjaTHR">
                                                            Simpan
                                                        </button>
                                                        <button class="btn btn-danger btn-gadjian btn-sm btnEdit" id="batalLamaKerjaTHR">
                                                            Batal
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

</body>
</html>