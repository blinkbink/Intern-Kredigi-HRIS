    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="http://dev.kredigi.co.id/~yusuf/uploads/1/logo-kredigi-fix_1672.png" alt="" id="gambar" ></div>
        <div class="pull-left info">
            <p>PT. Kreasi Digital Mandiri</p>
            <button onclick="javascript:location.href='<?php echo base_url()."index.php/karyawan/logout"?>'" class="btn btn-sm btn-info">Logout</button>
            <button onclick="javascript:location.href='<?php echo base_url()."index.php/karyawan/profile"?>'" class="btn btn-sm btn-success">Profile</button><br>
            <a href="<?php echo base_url()."karyawan/kata_sandi"?>">Ubah Kata Sandi</a>
        </div>
    </div>
    <!-- search form -->

<ul class="sidebar-menu">
    <li class="header">Menu Karyawan</li>
    <li class=" treeview">
        <a href="<?php echo base_url()."index.php/karyawan"?>">
            <i class="fa fa-home"></i> <span>Halaman Utama</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url()."index.php/karyawan/tim"?>">
            <i class="fa fa-group"></i> <span>TIM Saya</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url()."index.php/cuti"?>">
            <i class="fa fa-tag"></i> <span>Cuti Tahunan</span>
        </a>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="fa fa-tint"></i><span>Sakit dan Izin Lainnya</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li >
                <a href="<?php echo base_url()."index.php/sakit"?>"><i class="fa fa-circle-o"></i> <span>Pengajuan Sakit</span></a>
            </li>
            <li >
                <a href="<?php echo base_url()."index.php/izin"?>"><i class="fa fa-circle-o"></i> <span>Pengajuan Izin</span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo base_url()."index.php/kehadiran"?>">
            <i class="fa fa-file"></i> <span>Catatan Kehadiran</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url()."index.php/slipgaji"?>">
            <i class="fa fa-money"></i> <span>Slip Gaji</span>
        </a>
    </li>

    <li>
        <a href="<?php echo base_url()."index.php/pengumuman"?>">
            <i class="fa fa-bullhorn"></i> <span>Pengumuman</span>
        </a>
    </li>
<!--
    <li>
        <a href="<?php //echo base_url()."karyawan/kalender"?>">
            <i class="fa fa-calendar"></i> <span>Kalender</span>
        </a>
    </li>
    -->
</ul>