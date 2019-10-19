<div class="navbar-inverse sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="/"><i class="fa fa-tachometer-alt fa-fw"></i> Dashboard</a>
                        </li>
                        @if(!Auth::check())
                        <li>
                            <a href="#"><i class="fa fa-file fa-fw"></i> Download Form<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/pdf/pengurusan_kk.pdf" target="_blank">Pengurusan KK</a>
                                </li>
                                <li>
                                    <a href="/pdf/kelahiran.pdf" target="_blank">Akta Kelahiran</a>
                                </li>
                                <li>
                                    <a href="/pdf/kematian.pdf" target="_blank">Akta Kematian</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @else
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Penduduk<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/penduduk">Data Penduduk</a>
                                </li>
                                <li>
                                    <a href="/penduduk/insert">Input Penduduk</a>
                                </li>
                                <li>
                                    <a href="/penduduk/stat">Statistik Penduduk</a>
                                </li>
                                <li>
                                    <a href="/kk/stat">Statistik Berdasarkan RT & RW</a>
                                </li>
                                <li>
                                    <a href="/import/insert">Input Data Excel</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Kartu Keluarga<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/kk">Data Kartu Keluarga</a>
                                </li>
                                <li>
                                    <a href="/kk/insert">Input Kartu Keluarga</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <!--<li>
                            <a href="#"><i class="fa fa-truck-moving fa-fw"></i> Kepindahan Penduduk<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/pindah">Data Kepindahan</a>
                                </li>
                                <li>
                                    <a href="/pindah/insert">Input Data Pindah</a>
                                </li>
                            </ul>-->
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building fa-fw"></i> Pejabat<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/penerbit">Data Pejabat</a>
                                </li>
                                <li>
                                    <a href="/penerbit/insert">Input Data Pejabat</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-warehouse fa-fw"></i> RW<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/rw">Data RW</a>
                                </li>
                                <li>
                                    <a href="/rw/insert">Input Data RW</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-home fa-fw"></i> RT<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/rt">Data RT</a>
                                </li>
                                <li>
                                    <a href="/rt/insert">Input Data RT</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-home fa-fw"></i> Pelaporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/penduduk/stat/download">Statistik Penduduk</a>
                                </li>
                                <li>
                                    <a href="/laporan_penduduk">Laporan Penduduk</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-folder-open fa-fw"></i> Administrasi Desa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!--<li>
                                    <a href="#">SKTM <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/sktm">Data SKTM</a>
                                        </li>
                                        <li>
                                            <a href="/sktm/insert">Input Data SKTM</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <li>
                                    <a href="#">Surat Keterangan Usaha <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/sku">Data SKU</a>
                                        </li>
                                        <li>
                                            <a href="/sku/insert">Input SKU</a>
                                        </li>
                                        <li>
                                            <a href="/sku/insert_bri">Input SKU BRI</a>
                                        </li>
                                        <li>
                                            <a href="/sku/insert_jatim_mandiri">Input SKU Jatim Mandiri</a>
                                        </li>
                                        <li>
                                            <a href="/sku/insert_domisili_usaha">Input Domisili Usaha</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Surat Ijin Keramaian <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/sik">Data Ijin Keramaian</a>
                                        </li>
                                        <li>
                                            <a href="/sik/insert">Input Surat Keramaian</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Surat Kehilangan <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skk">Data Surat Kehilangan</a>
                                        </li>
                                        <li>
                                            <a href="/skk/insert">Input Data Kehilangan</a>
                                        </li>
                                    </ul>
                                </li>
                                <!--<li>
                                    <a href="#">Surat Kenal Lahir <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skkl">Data Surat Kenal Lahir</a>
                                        </li>
                                        <li>
                                            <a href="/skkl/insert">Input Data Kenal Lahir</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <li>
                                    <a href="#">Surat Kelahiran <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skd">Data Kelahiran</a>
                                        </li>
                                        <li>
                                            <a href="/skd/insert">Input Data Kelahiran</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Surat Kematian <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/kematian">Data Kematian</a>
                                        </li>
                                        <li>
                                            <a href="/kematian/insert">Input Data Kematian</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#">Surat Pindah Masuk <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/pindah_masuk">Data Pindah Masuk</a>
                                        </li>
                                        <li>
                                            <a href="/pindah_masuk/insert">Input Data</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#">Surat Pindah Keluar <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/pindah_keluar">Data Pindah Keluar</a>
                                        </li>
                                        <li>
                                            <a href="/pindah_keluar/insert">Input Data</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                                </li>
                                <li>
                                    <a href="#">Surat Domisili <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skdom">Data Domisili</a>
                                        </li>
                                        <li>
                                            <a href="/skdom/insert">Input Data Domisili</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <!--<li>
                                    <a href="#">Surat Keterangan Wali Nikah <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skwn">Data Surat Wali Nikah</a>
                                        </li>
                                        <li>
                                            <a href="/skwn/insert">Input Data Wali Nikah</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Surat Pelunasan PBB <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/sklp">Data Surat Lunas PBB</a>
                                        </li>
                                        <li>
                                            <a href="/sklp/insert">Input Data Lunas PBB</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">SKKB <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/skkb">Data SKKB</a>
                                        </li>
                                        <li>
                                            <a href="/skkb/insert">Input Data SKKB</a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->