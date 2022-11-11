<!-- Logo -->
<a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Admin</b>LTE</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button	-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only visible-xs-12">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <?php
                    foreach ($total as $tot)
                    {
                        $total = $tot['total'];
                    }

                    ?>
                    <?php
                    if($total <= 0)
                    {

                    }
                    elseif($total > 0)
                    {
                        ?>
                        <span class="badge bg-red">
                            <?php
                                echo $total;
                            ?>
                        </span>
                    <?php
                    }
                    ?>

                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <?php
                    if($notifikasi == null)
                    {
                        ?>
                        <li>
                            <a>
                        <span>
                                <span class="message">
                                  Belum Ada Notifikasi Terbaru<hr>
                                </span>
                        </span>
                            </a>
                        </li>
                        <?php
                    }
                    else {
                        foreach ($notifikasi as $no) {
                            ?>
                            <li>
                                <a>
                        <span>
                                <span style="color: orange;font-size: 14px" class="message">
                                    <?php echo $no['judul'] ?>
                                </span>
                            <span class="time">

                            </span>   <hr>
                            <?php
                            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
                            $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            $date = strtotime($no['tanggal_notifikasi']);
                            echo $hari[date("w", $date)] . ", " . date("j", $date) . " " . $bulan[date("n", $date)] . " " . date("Y", $date) . " " . date(' H:i:s', $date);
                            ?>
                        </span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</nav>