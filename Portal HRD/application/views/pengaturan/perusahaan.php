<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Perusahaan
        <small><?=$perusahaan->nama_perusahaan?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Perusahaan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header">
              <div class="box-tools">
                <a href="<?=site_url('pengaturan/perusahaan/form') ?>" type="button" class="btn btn-info btn-sm" ><i class="fa fa-pencil"></i>&nbsp;Ubah Data</a>
                <a type="button" class="btn btn-danger btn-sm" id="ubah-password"><i class="fa fa-pencil"></i>&nbsp;Ubah Password</a>
              </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                 <?php
                      if(!empty($error)){
                        echo'<br><br>';
                        echo $error;
                        echo'<br><br>';
                      }
                    ?>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12 photo">
                        <img src="<?=base_url($perusahaan->logo_perusahaan)?>" alt="" class="img-responsive">
                    </div>
                    <div class="col-md-6 col-xs-12">                     
                        <h4><?=$perusahaan->nama_perusahaan?></h4>
                        <p><?=$perusahaan->alamat_perusahaan?>. <?=ucwords(get_kecamatan($perusahaan->kecamatan_perusahaan))?> <br>
                         <?=ucwords(get_kota($perusahaan->kota_perusahaan))?>, <?=get_provinsi($perusahaan->provinsi_perusahaan);?> - <?=$perusahaan->kodepos_perusahaan?></p>
                         <span><i class="fa fa-phone fa-fw"></i><?=$perusahaan->telp_perusahaan?></span><br>
                         <span><i class="fa fa-fax fa-fw"></i> <?=$perusahaan->fax_perusahaan?></span><br>
                         <span><i class="fa fa-envelope-o fa-fw"></i> <?=$perusahaan->email_perusahaan?></span><br>
                         <span><i class="fa fa fa-globe fa-fw"></i><?=$perusahaan->web_perusahaan?></span><br>
                    </div>
                    <div class="col-md-3 col-xs-12">

                    </div>
                </div>
                
            </div>
            <!-- /.box-body -->

        </div>
          <!-- /.box -->
    </div>

     <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form class="form-horizontal" method="post" action="<?=site_url('auth/action/update')?>">
                           
                            <div class="modal-body">
                              <div class="form-group">
                                            <p class="col-md-12 text-center">
                                                Masukkan Password Baru Anda
                                            </p>
                               <div class="col-md-12">
                              <input type="password" name="password" id="password" class="form-control input-block-level" value="" />
                                                    </div>
                                                    </div>
                               
                                         <div class="form-group">
                                            <div class="col-md-12 text-center">
                              <input type="hidden" name="username" value="<?=get_user_info('username')?>" >
                              <input type="hidden" name="user_id" value="<?=get_user_info('user_id')?>" >
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Proses !</button>
                              </div>
                              </div>
                            </div>
                          
                           
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

</section><!-- /.content -->

<?php 

get_template('footer');
?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
    $("#ubah-password").click(function(){
    $("#myModal").modal("show");
  });

</script>

</body>
</html>