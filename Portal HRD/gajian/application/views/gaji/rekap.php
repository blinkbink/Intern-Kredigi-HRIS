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
           <div class="panel-body rad-b-n single_panel">
                        <h4 class="m-b-sm m-t-n">Grup Gaji </h4>
                        <div class="row">
                            <div class="col-md-9">
                                <form class="form-inline" action="/komben/opsi/" method="GET" id="opsi_komben">
                                    <div class="form-group">
                                        <select name="jenis" class="form-control komben-opsi" onchange="this.form.submit()">
                                            <option value=""> = Semua = </option>
                                            <option value="7675">Gaji</option>                                     
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default form-control komben-opsi" onclick="document.location='/komben/opsi/?jenis=7543&amp;bulan=02&amp;tahun=2017'" title="Go To Feb 2017"><i class="fa fa-chevron-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                                                                <select name="bulan" class="form-control komben-opsi" onchange="this.form.submit()">
                                            <option value="1">Januari</option><option value="2">Februari</option><option value="3" selected="">Maret</option><option value="4">April</option><option value="5">Mei</option><option value="6">Juni</option><option value="7">Juli</option><option value="8">Agustus</option><option value="9">September</option><option value="10">Oktober</option><option value="11">November</option><option value="12">Desember</option>                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="tahun" class="form-control komben-opsi" onchange="this.form.submit()">
                                            <option value="2017" selected="">2017</option>                                      </select>
                                    </div>
                                    <div class="form-group">
                                                                                <button type="button" class="btn btn-default form-control komben-opsi" onclick="document.location='/komben/opsi/?jenis=7543&amp;bulan=04&amp;tahun=2017'" title="Go To Apr 2017"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-success pull-right m-b-sm" id="buatSlipGaji">Generate Slip Tidak Tetap </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-hover table-striped" >
                                    <thead>
                                    <tr class="success">
                                      <th class='text-center'>Group Gaji</th>
                                      <th class='text-center'>Periode</th>
                                      <th class='text-center'>Jumlah Personil</th>
                                      <th class='text-center'>Status Kelengkapan</th>   
                                      <th class='text-center'>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                      <td class='text-center'>Group Gaji</td>
                                      <td class='text-center'>Periode</td>
                                      <td class='text-center'></td>
                                      <td class='text-center'>Belum Lengkap</td>   
                                      <td class='text-center'>
                                        <div class="btn-group">
                                         
                                          <button type="button" class="btn btn-sm btn-info hapus-karyawan" >
                                            Lihat Daftar Slip
                                          </button>
                                        </div>
                                      </td>
                                    </tr>

                
                
                </tbody>
              </table>
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
</script>
</body>
</html>