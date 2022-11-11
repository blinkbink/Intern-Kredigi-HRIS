<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<style>
    .fileUploadWrapper {
    position: relative;
    background: 0 0!important;
    width: 100%
}

.fileUploadWrapper:hover:before {
    background: #23C7C6!important;
    color: #F3F0E7!important
}

.fileUploadWrapper:after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    right: 0;
    border: 1px solid #DEDEDE;
    padding: 0 12px;
    display: block;
    width: 100%;
    pointer-events: none;
    z-index: 20;
    height: 34px;
    line-height: 34px;
    font-size: 13px;
    color: #555;
}

.fileUploadWrapper:before {
    content: 'Upload';
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    height: 34px;
    background: #EBE4D4;
    color: #484848;
    font-weight: 500;
    z-index: 25;
    line-height: 34px;
    padding: 0 15px;
    pointer-events: none
}

.fileUploadWrapper input {
    opacity: 0;
    position: relative;
    z-index: 99;
    height: 34px;
    margin: 0;
    padding: 0;
    display: block;
    cursor: pointer;
    width: 100%
}
</style>
<?php
get_template('topbar');
get_template('sidebar');

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Perusahaan
        <small>PT Alia Indah Wisata</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Ubah Data Perusahaan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header">
             <br>
        </div>
        <div class="box-body">
            <div class="row">
                                        <div class="col-xs-12">
                                            <form class="form-horizontal" method="post" action="<?=site_url('pengaturan/perusahaan/update');?>" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="fotoAdmin" class="col-md-2 control-label">Logo Perusahaan</label>
                                                    <div class="col-md-8">
                                                        <div class="fileUploadWrapper" data-text="Pilih berkas...">
                                                              <input name="logo_perusahaan" type="file" class="fileUploadField" value="" id="fotoAdmin" data-toggle="tooltip" data-placement="top" title="" data-original-title="Disarankan logo berukuran 2x1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label for="nama_perusahaan" class="col-md-2 control-label">Nama Perusahaan</label>
                                                        <div class="col-md-8">
                                                            <input type="text" name="nama_perusahaan" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas" class="form-control" id="nama_perusahaan" value="<?=$perusahaan->nama_perusahaan;?>">
                                                            <p class="help-block text-right"></p>
                                                        </div>
                                                    </div>
                                                <div class="form-group">
                                                    <label for="alamat_perusahaan" class="col-md-2 control-label">Alamat</label>
                                                    <div class="col-md-8">
                                                        <textarea name="alamat_perusahaan" id="alamat" cols="30" rows="5" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas" class="form-control"><?=$perusahaan->alamat_perusahaan;?> </textarea>
                                                        <p class="help-block text-right"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group success">
                                                    <label for="provinsi" class="col-md-2 control-label">
                                                        Provinsi                                                    </label>
                                                    <div class="col-md-8">
                                                    <?=get_provinsi($perusahaan->provinsi_perusahaan,'form','provinsi_perusahaan');?>
                                                    <p class="help-block text-right"></p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kota_kabupaten" class="col-md-2 control-label">
                                                        Kota / Kabupaten                                                    </label>
                                                    <div class="col-md-8">
                                                       <select name="kota_perusahaan" id="kota" class="form-control"></select>
                                                        <p class="help-block text-right"></p>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label for="kota_kabupaten" class="col-md-2 control-label">Kecamatan</label>
                                                    <div class="col-md-8">
                                                        <select name="kecamatan_perusahaan" id="kecamatan" class="form-control"></select>
                                                        <p class="help-block text-right"></p>
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group">
                                                    <label for="kodepos" class="col-md-2 control-label">
                                                        Kode Pos                                                    </label>
                                                    <div class="col-md-8">
                                                        <input name="kodepos_perusahaan" type="text" class="form-control" id="kodepos" value="<?=$perusahaan->kodepos_perusahaan;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_telp" class="col-md-2 control-label">
                                                        No. Telp                                                    </label>
                                                    <div class="col-md-8">
                                                        <input name="telp_perusahaan" type="text" required="" data-validation-required-message="<i></i> Tolong isi kotak di atas" class="form-control" id="no_telp" value="<?=$perusahaan->telp_perusahaan;?>">
                                                        <p class="help-block text-right"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_fax" class="col-md-2 control-label">
                                                        No. Fax                                                 </label>
                                                    <div class="col-md-8">
                                                        <input name="fax_perusahaan" type="text" class="form-control" id="no_fax" value="<?=$perusahaan->fax_perusahaan;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="col-md-2 control-label">Email Perusahaan</label>
                                                    <div class="col-md-8">
                                                        <input name="email_perusahaan" type="email" class="form-control" id="email" value="<?=$perusahaan->email_perusahaan;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bisa sama atau berbeda dengan email yang digunakan untuk login">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Website" class="col-md-2 control-label">Website</label>
                                                    <div class="col-md-8">
                                                        <input name="web_perusahaan" type="text" class="form-control" id="Website" value="<?=$perusahaan->web_perusahaan;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-10">
                                                        <div class="pull-right">
                                                            <button type="submit" class="btn btn-warning btn-sm">
                                                                Simpan                                                          </button>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="history.go(-1);" >
                                                                Batal                                                           </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
            <!-- /.box-body -->
        </div>
          <!-- /.box -->
    </div>

</section><!-- /.content -->

<?php 

get_template('footer');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
    function getJSON(url,data){
      return JSON.parse($.ajax({
        type: 'POST',
        url : url,
        data:data,
        dataType:'json',
        global: false,
        async: false,
        done:function(msg){

        }
      }).responseText);
    }
    
    var kotanya = getJSON("<?=base_url('assets/json/kota.json')?>");
    var kecamatannya = getJSON("<?=base_url('assets/json/kecamatan.json')?>");


    $(document).ready(function(){ 
        $('#kota option').remove();
        $('#kota').append('<option value="">Pilih Kota/Kabupatennya</option>');
        for(var x = 0; x < kotanya.length; x++){
          if(kotanya[x].province_id == <?php echo $perusahaan->provinsi_perusahaan;?>){                
            $('#kota').append(
                '<option value="'+kotanya[x].id+'">'+kotanya[x].name+'</option>'
              );
          }
        }     
        $('#kecamatan option').remove();
        $('#kecamatan').append('<option value="">Pilih Kecamatannya</option>');
        for(var y = 0; y < kecamatannya.length; y++){
          if(kecamatannya[y].regency_id == <?php echo $perusahaan->kota_perusahaan;?>){                
            $('#kecamatan').append(
                '<option value="'+kecamatannya[y].id+'">'+kecamatannya[y].name+'</option>'
              );
          }
        }
        $('#kota option[value ="<?php echo $perusahaan->kota_perusahaan;?>"]').prop('selected', true);
        $('#kecamatan option[value ="<?php echo $perusahaan->kecamatan_perusahaan;?>"]').prop('selected', true);
    });

$(document).on('change', '#provinsi', function(eve){
    eve.preventDefault();
     var idprovinsi = $('#provinsi').val();
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