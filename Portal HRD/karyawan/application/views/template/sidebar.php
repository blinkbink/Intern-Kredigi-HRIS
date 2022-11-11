<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

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
        <li class="treeview">
          <a href="">
            <i class="fa fa-dashboard"></i> <span>Home</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i><span>Pengaturan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li><a href=""><i class="fa fa-circle-o"></i> <span>Perusahaan</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i><span>Divisi & Jabatan </span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
          			<li>
                  <a href=""><i class="fa fa-circle"></i> <span>Divisi</span></a>
                </li>
          			<li>
                  <a href=""><i class="fa fa-circle"></i> <span>Jabatan</span></a>
                </li>
              </ul>
            </li>
      			<li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i><span>Komponen Gaji</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href=""><i class="fa fa-circle"></i> <span>Pendapatan</span></a>
                </li>
                <li>
                  <a href=""><i class="fa fa-circle"></i> <span>Potongan</span></a>
                </li>
              </ul>
            </li>
            <li>
              <a href=""><i class="fa fa-circle-o"></i> <span>Ketentuan Gaji</span></a>
            </li>
            <li >
              <a href=""><i class="fa fa-circle-o"></i> <span>Slip Gaji</span></a>
            </li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>Cuti</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>Izin</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>PPh 21</span></a></li>
      			<li><a href="#"><i class="fa fa-circle-o"></i> <span>BPJS</span></a></li>
			<li><a href=""><i class="fa fa-circle-o"></i> <span>Pola & Jadwal Kerja</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-smile-o"></i><span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li>
              <a href=""><i class="fa fa-circle-o"></i> <span>Data Pribadi</span></a>
            </li>
      			<li>
              <a href=""><i class="fa fa-circle-o"></i> <span>Karir & Remunerasi</span></a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i><span>Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
      			<li>
              <a href=""><i class="fa fa-circle-o"></i> <span>Data Absensi</span></a>
            </li>
      			<li>
              <a href=""><i class="fa fa-circle-o"></i> <span>Rekap Absensi</span></a>
            </li>
          </ul>
        </li>
        <li>
          <a href="">
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
