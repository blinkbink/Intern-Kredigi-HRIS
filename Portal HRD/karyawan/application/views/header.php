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
                    <span class="badge bg-red">
                        <?php
                        foreach ($total as $tot)
                            echo $tot['total']
                        ?>
                    </span>
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
                                  Belum Ada Notifikasi   <hr>
                                </span>
                        </span>
                            </a>
                        </li>
                        <?php
                    }
                    foreach ($notifikasi as $no)
                    {
                        ?>
                        <li>
                            <a>
                        <span>
                                <span style="color: orange;font-size: 14px" class="message">
                                    <?php echo $no['judul']?>
                                </span>
                            <span class="time">
                                <?php
                                $date = new DateTime($no['tanggal_notifikasi']);
                                $result = $date->format('D M Y H:i:s');
                                echo $result;
                                ?>
                            </span>   <hr>
                        </span>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
</nav>