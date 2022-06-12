<div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Stisla</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/Dashboard/Dashboard') ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                    
                        
                        <?php 
                            $session = session();
                            if($session->get('kelompok')=="admin" || $session->get('kelompok')=="manajer")
                            {
                        ?>

                        <li class="menu-header">Master Data</li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/Coa/view') ?>"><i class="fas fa-book"></i><span>COA</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/Pasien/View') ?>"><i class="fas fa-bed"></i><span>Pasien</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('Petugas/View') ?>"><i class="fas fa-user-nurse"></i><span>Petugas</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('Kamar/View') ?>"><i class="fas fa-door-closed"></i><span>Kamar</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('Jenis_kamar/View') ?>"><i class="fas fa-archway"></i><span>Jenis Kamar</span></a></li>
                     <?php } ?>


                     <?php 
                            $session = session();
                            if($session->get('kelompok')=="akuntan" || $session->get('kelompok')=="manajer")
                            {
                        ?>
                   
                        <li class="menu-header">Transaksi</li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/TransPemesanan/view') ?>"><i class="fas fa-newspaper"></i><span>Pemesanan</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/TransPembayaran/view') ?>"><i class="fas fa-wallet"></i><span>Pembayaran</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/TransGaji/view') ?>"><i class="fas fa-calendar-plus"></i><span>Penggajian</span></a></li>

<?php } ?>
                    
<?php 
                            $session = session();
                            if($session->get('kelompok')!='admin')
                            {
                        ?>

                        <li class="menu-header">Laporan</li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/JurnalUmum/jurnalumum') ?>"><i class="fas fa-bookmark"></i><span>Jurnal Umum</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/BukuBesar/bukubesar') ?>"><i class="fas fa-book-open"></i><span>Buku Besar</span></a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-scroll"></i><span>Kuitansi</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="auth-forgot-password.html">Kuitansi Pemesanan</a></li>
                                <li><a href="auth-login.html">Kuitansi Pembayaran</a></li>
                                <li><a href="auth-reset-password.html">Kuitansi Penggajian</a></li>
                            </ul>
                        </li>

<?php } ?>


<?php 
                            $session = session();
                            if($session->get('kelompok')=="analis" || $session->get('kelompok')=="manajer")
                            {
                        ?>

                        <li class="menu-header">Grafik</li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/Grafik/BarChart') ?>"><i class="fas fa-chart-bar"></i><span>Batang</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/Grafik/PieChart') ?>"><i class="fas fa-chart-pie"></i><span>Pie</span></a></li>
                        <li><a class="nav-link" href="<?= base_url('http://localhost:8080/index.php/Grafik/LineChart') ?>"><i class="fas fa-chart-line"></i><span>Garis</span></a></li>
                    </ul>

                    <?php } ?>
                  

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>