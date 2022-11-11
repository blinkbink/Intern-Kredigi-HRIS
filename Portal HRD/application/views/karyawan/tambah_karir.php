<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<style>
    .grupGajiPaper {
    background: #F0F0F0;
    padding-top: 10px;
    padding-bottom:  10px;
    margin-bottom:  15px;
}
.line-t-b {
    border-bottom: 1px solid #9E9E9E;
    padding-bottom: 3px;
}
.control-title {
    padding-top: 7px;
    margin-bottom: 0;
}
</style>
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Karyawan
        <small>Tambah Karir</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Tambah Karir</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
        <?php get_template('header_detail');?>
    <div class="row">
                                        <div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Karir & Remunerasi</h3>
        </div>
        <div class="box-body">
           <div class="row">
                            <div class="col-xs-12">
                                <form class="form-horizontal" method="post" action="<?=site_url('karyawan/karir/action/tambah')?>"> 
                                    <div id="grupGajiContainer">
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left"><span class="bintang text-danger">*</span> Status Karyawan</p>
                                            </label>
                                            <div class="col-md-8">
                                                <select id="statusKaryawan" name="status" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php 
                                                        $statusKaryawan = get_data_db_by('Master',array('kategori_master'=>'status karyawan'));
                                                        foreach ($statusKaryawan as $key => $status) {
                                                            echo '<option value="'.$status->master_ID.'">'. $status->nama_master.'</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                <p class="help-block text-right"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left"><span class="bintang text-danger">*</span> Tipe</p>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="tipe" id="tipePekerjaan" class="form-control" required >
                                                    <option value="">--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left"><span class="bintang text-danger">*</span> Pekerjaan / Jabatan</p>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="jobtitle" id="" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php
                                                        $pekerjaan=get_data_db_by('Data', array('kategori_data'=>'jabatan','perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                                        foreach ($pekerjaan as $key => $jabatan) {
                                                            echo '<option value="'.$jabatan->data_ID.'">'. $jabatan->nama_data.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left"><span class="bintang text-danger">*</span> Divisi / Bagian </p>
                                            </label>
                                            <div class="col-md-8">
                                                <select name="bagian" id="" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php
                                                        $divisi=get_data_db_by('Data', array('kategori_data'=>'divisi','perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                                        foreach ($divisi as $key => $value) {
                                                            echo '<option value="'.$value->data_ID.'">'. $value->nama_data.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left">Grade (Golongan)</p>
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="grade" pattern="^[a-zA-Z0-9]+$" data-validation-pattern-message="<i></i> Maaf, karakter yang Anda masukkan tidak valid ">
                                                <p class="help-block text-right"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-md-4 control-label">
                                                <p class="text-left"><span class="bintang text-danger">*</span> Tanggal Efektif</p>
                                            </label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" name="tgl_efektif" class="form-control datepicker" value="" readonly="" required >
                                                    <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-xs-12">
                                                        <h4><span class="bintang text-danger">*</span> Grup Gaji</h4>
                                                        <button class="btn btnSuccess btn-sm pull-right" id="tambahGrupGaji" type="button">
                                                            <i class="fa fa-plus"></i> Grup
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pilihanGrupGajiContainer">
                                            <div class="row pilihanGrupGaji">
                                                <div class="col-xs-12">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <div class="col-xs-12">
                                                                    <select name="gg[]" class="grupGaji form-control" required >
                                                                         <option value=""></option>
                                                                        <?php
                                                                            $gaji=$this->Slip_gaji_model->get_by(array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                                                            foreach ($gaji as $key => $value) {
                                                                                echo '<option value="'.$value->master_gaji_ID.'">'. $value->master_gaji_nama.'</option>';
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                    <span class="backupGrupGaji hide"></span>
                                                                    <p class="help-block text-right"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <button class="btn btn-sm btn-danger pull-right hapusPilihanGrupGaji m-t-sm hide" type="button"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 grupGajiPaper p-v-sm m-t-sm">
                                                            <div class="tempatItemGrup">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <div class="row mt2">
                                        <div class="col-xs-12">
                                             <input type="hidden" name="id_karyawan" value="<?=$karyawan->karyawan_ID?>" >
                                        </div>
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-warning btn-sm pull-right" id="simpanKarir">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <span>Yang bertanda (<span class="bintang text-danger">*</span>) bintang harus diisi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <select id="grupGajiStatic" class="hide">
                                            <option value=""></option>
                                                <?php
                                                                            $gaji=$this->Slip_gaji_model->get_by(array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                                                            foreach ($gaji as $key => $value) {
                                                                                echo '<option value="'.$value->master_gaji_ID.'">'. $value->master_gaji_nama.'</option>';
                                                                            }
                                                                        ?></select>

        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>

</div>
 </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->

<?php 
$this->load->view('template/footer');
?>

<!-- bootstrap datepicker -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
$(function () {
 $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    });
});
$(document).on('change', '#statusKaryawan', function(eve){
    eve.preventDefault();   
    var statusKaryawan = $('#statusKaryawan').val();  
    var tipePekerjaan =  <?php echo json_encode($this->Master_model->get_by(array('kategori_master'=>'tipe status'),'','','','master_ID,reff_ID,nama_master')); ?>;
     $('#tipePekerjaan option').remove();
    for(var i = 0; i < tipePekerjaan.length; i++){
      if(tipePekerjaan[i].reff_ID == statusKaryawan){
        $('#tipePekerjaan').append(
            '<option value="'+tipePekerjaan[i].master_ID+'">'+tipePekerjaan[i].nama_master+'</option>'
          );
      }
    }    
      
  });

function grupGaji(){
            $(".grupGaji").on("change",function(){

                var tempatIni = $(this);
                var grupGajiVal = $(this).val();
                //alert(grupGajiVal);

                
                
                /**
                 * Tiap kali option pada select diganti, maka backupannya pun berganti.
                 * Hal ini bertujuan agar pada saat user memilih suatu option kemudian memilih yang lain,
                 * maka option yang sebelumnya dipilih dapat dimunculkan kembali dengan cara mengenalinya pada backupan ini.
                 */
                $(this).closest(".pilihanGrupGaji").find(".backupGrupGaji").text(grupGajiVal);

                $.ajax({
                    url: '../ajax',
                    type: 'post',
                    dataType: 'json',
                    data: {grupGaji: grupGajiVal},
                    success: function(data){
                        //alert(data);
                        tempatIni.closest(".pilihanGrupGaji").find(".tempatItemGrup").html(data.item);

                        //$("input,select,textarea").not("[type=submit]").jqBootstrapValidation("destroy");

                        // jqBootstrapValidation
                        //$("input,select,textarea").not("[type=submit]").jqBootstrapValidation({preventSubmit: true});

                    },
                    error: function(data){
                        //alert(data);
                    }
                });
            });
        }

grupGaji();
$("#tambahGrupGaji").click(function(){
    //alert('yes');
            // Mengclone HTML dari grupGajiStatic
            var grup_gaji = $('#grupGajiStatic').clone();

            /**
             * Menghapus option2 yang memiliki class hide pada grupGajiStatic
             * Untuk kemudian diclonekan ke grupGaji
             */
            $('.terpilih', grup_gaji).remove();

            /**
             * Menambahkan sesuai dengan jumlah dari select di option .grupGaji
             * Tujuannya agar grup gaji yang ditambahkan tidak lebih dari grup gaji yang ada
             * Karena ketika semua grup gaji telah terpilih, maka yang muncul adalah pilihan kosong. Sehingga mubazir dan gak berguna.
             * TODO: Ketika load halaman, select option kan masih kosong, harusnya tombol tambah grup gaji terdisabled
             */
                if($("#pilihanGrupGajiContainer .pilihanGrupGaji").length < <?php echo count($gaji)?>){

                    var pilihanGrup = '\
                        <div class="row pilihanGrupGaji">\
                                                <div class="col-xs-12">\
                                                    <div class="row">\
                                                        <div class="col-md-4">\
                                                            <div class="form-group">\
                                                                <div class="col-xs-12">\
                                                                    <select name="gg[]" class="grupGaji form-control" required >\
                                                                         <option value=""></option>\
                                                                        '+grup_gaji.html()+'\
                                                                    </select>\
                                                                    <span class="backupGrupGaji hide"></span>\
                                                                    <p class="help-block text-right"></p>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                        <div class="col-md-8">\
                                                            <div class="row">\
                                                                <div class="col-xs-12">\
                                                                    <button class="btn btn-sm btn-danger pull-right hapusPilihanGrupGaji m-t-sm hide" type="button"><i class="fa fa-times"></i></button>\
                                                                </div>\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                    <div class="row">\
                                                        <div class="col-xs-12 grupGajiPaper p-v-sm m-t-sm">\
                                                            <div class="tempatItemGrup">\
                                                            </div>\
                                                        </div>\
                                                    </div>\
                                                </div>\
                                            </div>';
                    // Menambahkan grup gaji
                        $("#pilihanGrupGajiContainer").append(pilihanGrup);
                        // alert(grup_gaji.html());

                    // Menampilkan tombol hapus
                        $("#pilihanGrupGajiContainer .pilihanGrupGaji .hapusPilihanGrupGaji").removeClass("hide");

grupGaji();
                    $(".hapusPilihanGrupGaji").unbind().on("click",function(){

                        var ini = $(this).closest(".pilihanGrupGaji").find(".grupGaji");

                        var delVal = ini.val();

                        // Jika yang memiliki class hide ternyata punya class adaGapok juga
                        if(ini.find(".terpilih").hasClass("adaGapok")){
                            // Jika ada, maka pilihan yang memiliki class adaGapok pada #grupGajiStatic dihilangkan class .hide-nya
                            $("#grupGajiStatic option.adaGapok").removeClass("terpilih");
                            // alert("gapok sembunyi");

                            if(ini.find(".terpilih").hasClass("adaLembur")){
                                // Jika ada, maka pilihan yang memiliki class adaLembur pada #grupGajiStatic dihilangkan class .hide-nya
                                $("#grupGajiStatic option.adaLembur").removeClass("terpilih");
                                // alert("gapok sembunyi");
                            }

                        }
                        // Jika yang memiliki class hide ternyata punya class adaLembur juga
                        else if(ini.find(".terpilih").hasClass("adaLembur")){
                            // Jika ada, maka pilihan yang memiliki class adaLembur pada #grupGajiStatic dihilangkan class .hide-nya
                            $("#grupGajiStatic option.adaLembur").removeClass("terpilih");
                            // alert("gapok sembunyi");
                        }
                        else{
                            // Jika tidak, maka pilihan yang memiliki value sama dengan option berclass .hide tersebut saja pada #grupGajiStatic yang dihilangkan class .hide-nya
                            $("#grupGajiStatic option[value='"+delVal+"']").removeClass("terpilih");
                            // alert("gapok gak sembunyi");
                        }

                        // Jika pilihan status karyawannya adalah Karyawan Lepas
                        if($("#statusKaryawan").val() == 4){
                            $("#grupGajiStatic option.adaGapok,#grupGajiStatic option.adaTHR").addClass("terpilih");
                        }

                        // Melakukan aksi masal pada seluruh .grupGaji
                        $(".grupGaji").each(function(){

                            // Mengclone HTML dari grupGajiStatic
                            var grup_gaji = $('#grupGajiStatic').clone();

                            /**
                             * Menghapus option2 yang memiliki class hide pada grupGajiStatic
                             * Terkecuali option yang memiliki value sama dengan .backupGrupGaji-nya
                             */
                            $('.terpilih', grup_gaji).not("option[value='"+$(this).closest(".pilihanGrupGaji").find(".backupGrupGaji").text()+"']").remove();

                            // Memberikan HTML baru bagi grupGaji
                            $(this).html(grup_gaji.html());

                            /**
                             * Memberikan value dari select option yg sedang dipilih setelah HTMLnya terrubah dengan yang baru.
                             * Kalau tidak diberikan value, maka ketika dialert yang keluar kosong.
                             * Hal ini dikarenakan HTMLnya telah terganti.
                             * Padahal kalo HTMLnya gak terganti, valuenya langsung ada. Gak perlu dikasih value lagi.
                             */
                            $(this).val($(this).closest(".pilihanGrupGaji").find(".backupGrupGaji").text());

                            // Memilih pilihan yang terpilih tadi setelah HTMLnya terganti
                            $(this).find("option[value='"+$(this).closest(".pilihanGrupGaji").find(".backupGrupGaji").text()+"']").prop("selected",true);

                        });

                        // Menghapus pilihan yang dimana terdapat Tombol Hapus ini
                        $(this).closest(".pilihanGrupGaji").remove();

                      

                        // Pengondisian muncul sembunyinya tombol hapus saat melakukan penghapusan sallah satu grup gaji
                        if($("#pilihanGrupGajiContainer").find(".pilihanGrupGaji").length >= 2){
                            $("#pilihanGrupGajiContainer .pilihanGrupGaji .hapusPilihanGrupGaji").removeClass("hide");
                        }
                        else{
                            $("#pilihanGrupGajiContainer .pilihanGrupGaji .hapusPilihanGrupGaji").addClass("hide");
                        }


                    });

                }


            });


</script>
</body>
</html>