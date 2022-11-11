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
           <div class="panel-body single_panel p-t-3">
                        <div class="row m-b-1">
                          <div class="col-xs-12">
                            <div class="pull-right">
                              <button onclick="document.location='/rekapkehadiran/ekspor-excel'" class="btn btn-warning"><i class="fa fa-download"></i> Download Excel</button>
                              <!-- <button class="btn btn-warning"><i class="fa fa-print"></i></button> -->
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 advanceSearch p-t-1 m-b-1">
                            <form action="/Rekapkehadiran" method="post" class="form-horizontal">
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                        <label for="" class="control-label col-md-4">Search</label>
                                        <div class="col-md-8">
                                          <input type="text" name="keyword" class="form-control" placeholder="Cari Personalia" value="">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                         <label class="control-label col-md-4">Dari </label>
                                        <div class="col-md-8">
                                          <div class="input-group date datepicker" data-date="15-03-2017" data-date-format="dd-mm-yyyy">
                                            <input type="text" name="start_date" class="form-control" placeholder="" aria-describedby="basic-addon2" value="15-03-2017" readonly="">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group m-b-1">
                                        <label class="control-label col-md-4">Sampai </label>
                                        <div class="col-md-8">
                                          <div class="input-group date datepicker" data-date="22-03-2017" data-date-format="dd-mm-yyyy">
                                            <input type="text" name="end_date" class="form-control" placeholder="" aria-describedby="basic-addon2" value="22-03-2017" readonly="">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                        <div class="col-md-7">
                                          <button type="submit" class="btn btn-sm btn-warning">Tampilkan</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                
        <form method="post" action="/pp" class="form-horizontal">
            <div class="row paginationInfo m-b-sm">
                <label class="col-md-4 col-xs-12 control-label text-left-i">
                    Menampilkan 1 - 2 dari total 2              </label>
                <div class="col-md-4 text-center p-t-xs">
                                    </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-7  col-xs-6 control-label">Data Per Halaman</label>
                        <div class="col-md-5 col-xs-6 ">
                            <select name="per_page" id="per_page" class="form-control" onchange="this.form.submit()">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div style="height: 5px;"></div>
    
                                    <!-- <div class="table-responsive"> -->
                                    <table class="table tabel-sortir footableTable footable footable-1 breakpoint-lg" style="display: table;">
                                        <thead>
                                            <tr class="footable-header">
                                                
                                                
                                                
                                                
                                                
                                                
                                               
                                               
                                               
                                               
                                               
                                               
                                               
                                               
                                           <th data-type="html" width="200" style="display: table-cell;">
                                                    Nama Personalia 
                                                </th><th data-breakpoints="xs sm" style="display: table-cell;">
                                                    Status Data 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Total Jumlah Hari 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Hadir Hari Kerja                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Tugas Luar 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                   Sakit 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                 Izin 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                   Cuti 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                  Mangkir 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                  Terlambat 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jumlah Jam Kerja 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jam Aktual Lembur 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jam Lembur Konversi 
                                               </th><th data-type="html" style="display: table-cell;">
                                                 Aksi 
                                               </th></tr>
                                </thead>
                                <tbody>
                                                                                        
                                                                                                    
                                                                               <tr>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <!-- <td class="text-center"></td> -->
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    <td style="display: table-cell;"><span class="footable-toggle fooicon fooicon-plus"></span>
                                                            <div class="media">
                                                                <div class="media-left">
                                                                  
                                                                    <img src="/static/images/t_personnel_boy.png" alt="" class="fotoAbsensi img-rounded">
                                                                </div>
                                                                <div class="media-body media-middle">
                                                                    Wawan Irawan                                                                </div>
                                                            </div>
                                                        </td><td style="display: table-cell;">
                                                            Belum Lengkap                                                        </td><td class="text-center" style="display: table-cell;">8</td><td class="text-center" style="display: table-cell;">4</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td style="display: none;">12</td><td style="display: none;">7</td><td style="display: none;">10.5</td><td class="tableAction" style="display: table-cell;">
                                                            <div class="link-group">
                                                                <a href="/absensi/personal/2674/2017-03-15/2017-03-22">
                                                                    <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Lihat "></i>
                                                                </a>
                                                                 <a href="/absensi/unduhPDF/2674/2017-03-15/2017-03-22">
                                                                  <i class="fa fa-file-pdf-o m-r-xs" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Unduh"></i>
                                                              </a>
                                                            </div>
                                                        </td></tr><tr>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <!-- <td class="text-center"></td> -->
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    <td style="display: table-cell;"><span class="footable-toggle fooicon fooicon-plus"></span>
                                                            <div class="media">
                                                                <div class="media-left">
                                                                  
                                                                    <img src="/static/images/t_personnel_boy.png" alt="" class="fotoAbsensi img-rounded">
                                                                </div>
                                                                <div class="media-body media-middle">
                                                                    Denny Hermawan                                                                </div>
                                                            </div>
                                                        </td><td style="display: table-cell;">
                                                            Belum Lengkap                                                        </td><td class="text-center" style="display: table-cell;">8</td><td class="text-center" style="display: table-cell;">2</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td class="text-center" style="display: table-cell;">0</td><td style="display: none;">2</td><td style="display: none;">0</td><td style="display: none;">0</td><td class="tableAction" style="display: table-cell;">
                                                            <div class="link-group">
                                                                <a href="/absensi/personal/2831/2017-03-15/2017-03-22">
                                                                    <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Lihat "></i>
                                                                </a>
                                                                 <a href="/absensi/unduhPDF/2831/2017-03-15/2017-03-22">
                                                                  <i class="fa fa-file-pdf-o m-r-xs" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Unduh"></i>
                                                              </a>
                                                            </div>
                                                        </td></tr></tbody>
                           </table>
                            <!-- </div> -->
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