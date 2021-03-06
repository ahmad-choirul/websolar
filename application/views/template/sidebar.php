<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/adminlte/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Welcome</p>
                <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
            </div>
        </div>

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <li>
                <a href="<?php echo site_url('datarealtime') ?>">
                    <i class="fa fa-dashboard"></i> <span>Beranda</span></i>
                </a>
            </li>
            <?php if ($this->session->userdata('level')=='admin'): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>User</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url('Cuser') ?>"><i class="fa fa-circle-o"></i> Data User</a></li>
                        <li><a href="<?php echo site_url('Cuser/history_login') ?>"><i class="fa fa-circle-o"></i> History Login</a></li>
                    </ul>
                </li>
            <?php endif ?>
           <!--  <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>History</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> History Aktuator</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> History Sudut y</a></li>
                </ul>
            </li> -->
            <li>
                <a href="<?php echo site_url('Chistory/history_tracker') ?>">
                    <i class="fa fa-dashboard"></i> <span> History Tracker</span></i>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('Chistory/history_aktuator') ?>">
                    <i class="fa fa-dashboard"></i> <span> History Aktuator</span></i>
                </a>
            </li> 
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Grafik</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('Cchart/lihatsensor') ?>"><i class="fa fa-circle-o"></i> Grafik Sensor</a></li>
                    <li><a href="<?php echo site_url('Cchart/lihatsuduttracker') ?>"><i class="fa fa-circle-o"></i> Grafik Tracker</a></li>
                    <li><a href="<?php echo site_url('Cchart/lihatsudutaktuator') ?>"><i class="fa fa-circle-o"></i> Grafik Aktuator</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('api/lihatsetpoint') ?>">
                    <i class="fa fa-dashboard"></i> <span> Nilai Setpoint</span></i>
                </a>
            </li> 
<!--             <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Hitung Manual</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                    <li><a href="<?php echo site_url('Chitungfuzzy') ?>">  <i class="fa fa-envelope"></i> <span>Hitung Manual Fuzzy</span></i></a></li>
                    <li><a href="<?php echo site_url('Chitungpid') ?>">  <i class="fa fa-envelope"></i> <span>Hitung Manual PID</span></i></a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('Csimulasi') ?>">
                    <i class="fa fa-envelope"></i> <span>Simulasi</span></i>
                </a>
            </li> -->
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">