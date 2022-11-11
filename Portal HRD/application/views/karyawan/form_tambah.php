<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->

  <!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/select2/select2.min.css">
<!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
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
     <form id="formTambahPersonalia" class="form-horizontal formahe" method="post" action="action/tambah" enctype="multipart/form-data" >
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
           


                       
                        
                        <div class="col-md-8 col-sm-12 col-xs-12">
                            <div class="row sub_judul">
                                <div class="col-xs-12">
                                    <h4 class="m-t-n">Informasi Pribadi</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"><span class="bintang text-danger">* </span>Nama Lengkap</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="nama" name="nama_lengkap" value="" required="">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="idPersonalia" class="col-md-4 control-label"><span class="bintang text-danger">* </span>ID Personalia</label>
                                <div class="col-md-8">
                                    <input type="text" name="nomor_induk" pattern="^[a-zA-Z0-9\' \-\.]*$" data-validation-pattern-message="<i></i> Maaf, karakter yang Anda masukkan tidak valid" maxlength="40" data-validation-ajax-ajax="/personalia/cek_id/" id="idPersonalia" class="form-control" value="" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dp2" class="col-md-4 control-label"><span class="bintang text-danger">* </span>Tanggal Mulai Bekerja</label>
                                <div class="col-md-8">
                                    <div class="input-group date">
                                      <input type="text" name="mulai_kerja" class="form-control datepicker" value="" readonly="" required="">
                                      <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kode_absensi" class="col-md-4 control-label">Kode Absensi</label>
                                <div class="col-md-8">
                                    <input type="text" name="kode_absensi" id="kode_absensi" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jenKel" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value=""></option>
                                        <option value="L">Pria</option>
                                        <option value="P">Wanita</option>
                                    </select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"><span class="bintang text-danger">* </span>No. KTP</label>
                                <div class="col-md-8" id="identityNumber">
                                    <input type="text" name="nomor_ktp" class="form-control" maxlength="16" value="" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group" id="akhirIdentitas">
                                <label for="dpT" class="col-md-4 control-label">Tanggal Akhir Berlaku KTP</label>
                                <div class="col-md-8">
                                    <div class="input-group date">
                                      <input type="text" name="tgl_berlaku" class="form-control datepicker" placeholder="" aria-describedby="basic-addon2" value="" readonly="">
                                      <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmptLahir" class="col-md-4 control-label"><span class="bintang text-danger">* </span>Tempat Lahir</label>
                                <div class="col-md-8">
                                    <input id="tmptLahir" name="tempat_lahir" type="text" class="form-control" value="" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dp3" class="col-md-4 control-label"><span class="bintang text-danger">* </span>Tanggal Lahir</label>
                                <div class="col-md-8">
                                    <div class="input-group date"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimal berusia 15 tahun">
                                      <input type="text" name="tgl_lahir" class="form-control datepicker" placeholder="" aria-describedby="basic-addon2" value="" readonly="" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas" >
                                      <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-md-4 control-label">Status Perkawinan</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="status" name="status_perkawinan">
                                        <option value=""></option>
                                        <option value="lajang">Lajang</option>
                                        <option value="menikah">Menikah</option>
                                        <option value="janda">Janda</option>
                                        <option value="duda">Duda</option>
                                    </select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="agama" class="col-md-4 control-label"><span class="bintang text-danger"><span class="bintang text-danger">* </span></span>Agama</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="agama" name="opt_agama" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas">
                                        <option value=""></option>
                                        <option value="islam">Islam</option>
                                        <option value="protestan">Protestan</option>
                                        <option value="katolik">Katolik</option>
                                        <option value="hindu">Hindu</option>
                                        <option value="budha">Budha</option>
                                        <option value="khonghucu">Khonghucu</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="golDarah" class="col-md-4 control-label">Golongan Darah</label>
                                <div class="col-md-8" id="golDarah">
                                    <select class="form-control" name="golongan_darah">
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="A-">A-</option>
                                        <option value="A+">A+</option>
                                        <option value="B">B</option>
                                        <option value="B-">B-</option>
                                        <option value="B+">B+</option>
                                        <option value="AB">AB</option>
                                        <option value="AB-">AB-</option>
                                        <option value="AB+">AB+</option>
                                        <option value="O">O</option>
                                        <option value="O-">O-</option>
                                        <option value="O+">O+</option>
                                    </select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikanTerakhir" class="col-md-4 control-label">Pendidikan Terakhir</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="pend_terakhir" id="pendidikan_terakhir">
                                        <option value=""></option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="institusiPendidikan" class="col-md-4 control-label">Nama Institusi Pendidikan</label>
                                <div class="col-md-8">
                                    <input type="text" name="institusi_pend" id="institusi_pendidikan" class="form-control" value="">
                                </div>
                            </div>
                            <div class="row sub_judul">
                                <div class="col-xs-12">
                                    <h4>Informasi Kontak</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noHP" class="col-md-4 control-label">No. HP</label>
                                <div class="col-md-8">
                                    <input type="text" name="hp_karyawan" id="noHP" class="form-control hanyaAngka" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label"><span class="bintang text-danger">* </span>E-mail</label>
                                <div class="col-md-8">
                                    <input type="email" name="email_karyawan" id="email" class="form-control" value="" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas" data-validation-email-message="<i></i> Alamat email tidak valid" data-validation-ajax-message="">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamatRumah" class="col-md-4 control-label">Alamat Rumah</label>
                                <div class="col-md-8">
                                    <textarea name="rumah_karyawan" id="alamat_rumah" cols="30" rows="5" class="form-control"></textarea>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="provinsi" class="col-md-4 control-label">
                                    Provinsi                                                    </label>
                                <div class="col-md-8">
                                <?=get_provinsi('','form','provinsi_karyawan');?>
                                <p class="help-block text-right"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kota_kabupaten" class="col-md-4 control-label">
                                    Kota / Kabupaten                                                    </label>
                                <div class="col-md-8">
                                   <select name="kota_karyawan" id="kota" class="form-control"></select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="kota_kabupaten" class="col-md-4 control-label">Kecamatan</label>
                                <div class="col-md-8">
                                    <select name="kecamatan_karyawan" id="kecamatan" class="form-control"></select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kontakDarurat" class="col-md-4 control-label">Kode Pos</label>
                                <div class="col-md-8 m-b-xs">
                                    <input type="text" name="kodepos_karyawan" id="kontakDarurat" class="form-control" value="">
                                    <p class="help-block text-right m-t-n"></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kontakDarurat" class="col-md-4 control-label">Nama Kontak Darurat</label>
                                <div class="col-md-8 m-b-xs">
                                    <input type="text" name="kontak_darurat" id="kontakDarurat" class="form-control" value="">
                                    <p class="help-block text-right m-t-n"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tlpDarurat" class="col-md-4 control-label">Telepon Darurat</label>
                                <div class="col-md-8">
                                    <input type="text" name="telp_darurat" id="tlpDarurat" class="form-control hanyaAngka" value="">
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="row sub_judul">
                                <div class="col-xs-12">
                                    <h4>Rekening Bank, NPWP &amp; BPJS</h4>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaBank" class="col-md-4 control-label">Nama Bank</label>
                                <div class="col-md-8">
                                    <select class="form-control select2" name="nama_bank" id="bank"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pemegangRekening" class="col-md-4 control-label">Nama Pemegang Rekening</label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                    <input name="nama_rekening" type="text" id="pemegangRekening" class="form-control">
                                    <span class="input-group-addon">
                                      <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="nama_sama" class="namaSama"> Sama dengan nama
                                            </label>
                                          </div>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="noRekening" class="col-md-4 control-label">No. Rekening</label>
                                <div class="col-md-8">
                                    <input type="text" name="nomor_rekening" id="noRekening" class="form-control hanyaAngka" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NPWP" class="col-md-4 control-label">NPWP</label>
                                <div class="col-md-8">
                                    <input type="text" name="nomor_npwp" id="NPWP" class="form-control" data-mask="99.999.999.9-999.999" value="000000000000000">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="swp" class="col-md-4 control-label"><span class="bintang text-danger">* </span>Status Wajib Pajak</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="status_wp" id="swp" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas">
                                        <option value=""></option>
                                        <option value="K0">K0</option>
                                        <option value="K1">K1</option>
                                        <option value="K2">K2</option>
                                        <option value="K3">K3</option>
                                        <option value="TK0">TK0</option>
                                        <option value="TK1">TK1</option>
                                        <option value="TK2">TK2</option>
                                        <option value="TK3">TK3</option>
                                        <option value="HB0">HB0</option>
                                        <option value="HB1">HB1</option>
                                        <option value="HB2">HB2</option>
                                        <option value="HB3">HB3</option>
                                    </select>
                                    <p class="help-block text-right"></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nppBPJSKetenagakerjaan" class="col-md-4 control-label">NPP BPJS Ketenagakerjaan</label>
                                <div class="col-md-8">
                                    <input type="text" name="bpjs_ketenagakerjaan" id="nppBPJSKetenagakerjaan" class="form-control" data-mask="99999999999" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nppBPJSKesehatan" class="col-md-4 control-label">NPP BPJS Kesehatan</label>
                                <div class="col-md-8">
                                    <input type="text" name="bpjs_kesehatan" id="nppBPJSKesehatan" class="form-control" data-mask="9999999999999" value="">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                     <input type="hidden" name="perusahaan_ID" value="<?=get_user_info('perusahaan_ID');?>">
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <span>Yang bertanda (<span class="bintang text-danger">*</span>) bintang harus diisi.</span>
                                </div>
                            </div>
                        </div>
                   
        </div><!-- /.box-body -->
        <div class="box-footer">
             <button class="btn btn-warning pull-right" type="submit">Simpan</button>
                                        <a href="/personalia">
                                            <button class="btn btn-danger " type="button">Batal</button>
                                        </a>
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
 </form>
</section><!-- /.content -->

<?php 
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->

<!-- Select2 -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
$(function () {
     //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });

     $(".select2").select2();
});

function getJSON(url,data){
      return JSON.parse($.ajax({
        type: 'POST',
        url : url,
        data:data,
        dataType:'json',
        global: false,
        async: false,
        success:function(msg){

        }
      }).responseText);
    }
        
        var banknya = getJSON("<?=base_url('assets/json/bank.json')?>");


    $(document).ready(function(){ 
        $('#bank option').remove();
        $('#bank').append('<option value="">Pilih Bank</option>');
        for(var x = 0; x < banknya.length; x++){        
            $('#bank').append(
                '<option value="'+banknya[x].code+'">'+banknya[x].name+'</option>'
            );
        }
  

   

    
        
    });


$(document).on('change', '#provinsi', function(eve){
    eve.preventDefault();
     var idprovinsi = $('#provinsi').val();
      var kotanya = getJSON("<?=base_url('assets/json/kota.json')?>");

    $('#kota option').remove();
    $('#kota').append('<option value="" selected>Pilih Kota/Kabupatennya</option>');
    for(var i = 0; i < kotanya.length; i++){
      if(kotanya[i].province_id == idprovinsi){
        // alert(kotanya[i].name);        
        $('#kota').append(
            '<option value="'+kotanya[i].id+'">'+kotanya[i].name+'</option>'
          );
      }
    }    
  });

  $(document).on('change', '#kota', function(eve){
    eve.preventDefault();   
    var idkota = $('#kota').val();   

    var kecamatannya = getJSON("<?=base_url('assets/json/kecamatan.json')?>");
    $('#kecamatan option').remove();
    $('#kecamatan').append('<option value="" selected>Pilih Kecamatannya</option>');
    for(var i = 0; i < kecamatannya.length; i++){
      if(kecamatannya[i].regency_id == idkota){
        // alert(kotanya[i].name);        
        $('#kecamatan').append(
            '<option value="'+kecamatannya[i].id+'">'+kecamatannya[i].name+'</option>'
          );
      }
    }
  });


</script>
</body>
</html>