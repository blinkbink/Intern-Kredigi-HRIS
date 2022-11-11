<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php
         $perusahaan=$this->Perusahaan_model->get(get_user_info('perusahaan_ID'));
              if(!empty($perusahaan->logo_perusahaan)){
                  echo '<img src="'.base_url($perusahaan->logo_perusahaan).'" alt="" id="gambar" >';
              }
              else{
                  echo '<img src="'.base_url('assets/AdminLTE-2.3.11/dist/img/avatar5.png').'" alt="" id="gambar">';
              }
          ?>
        </div>
        <div class="pull-left info">
          <p><?=$perusahaan->nama_perusahaan?></p>
          <button onclick="javascript:location.href='<?=site_url('logout')?>'" class="btn btn-sm btn-info">Logout</button>
          <button onclick="javascript:location.href='<?=site_url('pengaturan/perusahaan')?>'" class="btn btn-sm btn-success">Profile</button>
        </div>
      </div>
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?=aktif_page('home','1','active') ;?> treeview">
          <a href="<?=site_url()?>">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview <?=aktif_page('pengaturan','1','active'); ?>">
          <a href="#">
            <i class="fa fa-cogs"></i><span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li <?=aktif_page('perusahaan','2','class="active"'); ?>><a href="<?=site_url('pengaturan/perusahaan') ?>"><i class="fa fa-circle-o"></i> <span>Perusahaan</span></a></li>
            <li class="treeview <?=aktif_page('data','2','active'); ?>">
              <a href="#">
                <i class="fa fa-circle-o"></i><span>Divisi & Jabatan </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
          			<li <?=aktif_page('divisi','3','class="active"'); ?>>
                  <a href="<?=site_url('pengaturan/data/divisi') ?>"><i class="fa fa-circle"></i> <span>Divisi</span></a>
                </li>
          			<li <?=aktif_page('jabatan','3','class="active"'); ?>>
                  <a href="<?=site_url('pengaturan/data/jabatan') ?>"><i class="fa fa-circle"></i> <span>Jabatan</span></a>
                </li>
              </ul>
            </li>
      			<li class="treeview <?=aktif_page('komponen','2','active'); ?>">
              <a href="#">
                <i class="fa fa-circle-o"></i><span>Komponen Gaji</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li <?=aktif_page('pendapatan','3','class="active"'); ?>>
                  <a href="<?=site_url('pengaturan/komponen/pendapatan') ?>"><i class="fa fa-circle"></i> <span>Pendapatan</span></a>
                </li>
                <li <?=aktif_page('potongan','3','class="active"'); ?>>
                  <a href="<?=site_url('pengaturan/komponen/potongan') ?>"><i class="fa fa-circle"></i> <span>Potongan</span></a>
                </li>
              </ul>
            </li>
            <li <?=aktif_page('ketentuan','3','class="active"'); ?>>
              <a href="<?=site_url('pengaturan/gaji/ketentuan') ?>"><i class="fa fa-circle-o"></i> <span>Ketentuan Gaji</span></a>
            </li>
            <li <?=aktif_page('slip','3','class="active"'); ?>>
              <a href="<?=site_url('pengaturan/gaji/slip') ?>"><i class="fa fa-circle-o"></i> <span>Slip Gaji</span></a>
            </li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>Cuti</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>Izin</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>PPh 21</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>BPJS</span></a></li>
          </ul>
        </li>
        <li class="treeview <?=aktif_page('karyawan','1','active') ;?>">
          <a href="#">
            <i class="fa fa-smile-o"></i><span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li <?=aktif_page('data','2','class="active"'); ?>>
              <a href="<?=site_url('karyawan') ?>"><i class="fa fa-circle-o"></i> <span>Data Pribadi</span></a>
            </li>
      			<li <?=aktif_page('karir','2','class="active"'); ?>>
              <a href="<?=site_url('karyawan/karir') ?>"><i class="fa fa-circle-o"></i> <span>Karir & Remunerasi</span></a>
            </li>
          </ul>
        </li>
        <li class="treeview <?=aktif_page('absensi','1','active') ;?>">
          <a href="#">
            <i class="fa fa-book"></i><span>Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li <?=aktif_page('data','2','class="active"'); ?>>
              <a href="<?=site_url('absensi/data') ?>"><i class="fa fa-circle-o"></i> <span>Data Absensi</span></a>
            </li>
      			<li <?=aktif_page('rekap','2','class="active"'); ?>>
              <a href="<?=site_url('absensi/rekap') ?>"><i class="fa fa-circle-o"></i> <span>Rekap Absensi</span></a>
            </li>
          </ul>
        </li>
        <li>
          <a href="<?=site_url('gaji') ?>">
            <i class="fa fa-usd"></i> <span>Rekap Gaji</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">