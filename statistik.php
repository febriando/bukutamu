<?php
    include "header.php";
?>
<?php
    include "koneksi.php";
?>

    <!-- Page Wrapper -->
    <div id="wrapper">
<?php
    include "sidebar.php";
?>
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="card shadow">
                    <div class="card-body">
                        <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Statistik Pengunjung</h1>
                                <?php 
                                // deklarasi tanggal

                                // menampilkan tanggal sekarang
                                $tanggal_sekarang = date('Y-m-d');

                                // menampilkan tanggal kemaren
                                $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                                // mendapatkan 6 hari sebelum tanggal sekarang
                                $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tanggal_sekarang)));

                                $sekarang =  date('Y-m-d h:i:s');

                                // query menampilkan data pengunjung

                                $tanggal_sekarang = mysqli_fetch_array(mysqli_query($koneksi, 
                                "SELECT count(*) FROM tamu where time like '%$tanggal_sekarang%'"
                            ));
                                
                                $kemarin = mysqli_fetch_array(mysqli_query($koneksi, 
                                "SELECT count(*) FROM tamu where time like '%$kemarin%'"
                            ));

                                $seminggu = mysqli_fetch_array(mysqli_query($koneksi, 
                                "SELECT count(*) FROM tamu where time BETWEEN '$seminggu' and '$sekarang'"
                            ));

                            $bulan_ini = date('m');

                                $sebulan = mysqli_fetch_array(mysqli_query($koneksi, 
                                "SELECT count(*) FROM tamu where month(time) = '$bulan_ini'"
                            ));

                            $keseluruhan = mysqli_fetch_array(mysqli_query($koneksi, 
                            "SELECT count(*) FROM tamu"
                        ));
                                ?>
                        </div>     
                        <table class="table">
                            <tr>
                                <td>Hari ini</td>
                                <td>: <?=$tanggal_sekarang[0] ?></td>
                            </tr>
                            <tr>
                                <td>Kemarin</td>
                                <td>: <?=$kemarin[0] ?></td>
                            </tr>
                            <tr>
                                <td>Minggu ini</td>
                                <td>: <?=$seminggu[0] ?></td>
                            </tr>
                            <tr>
                                <td>Bulan ini</td>
                                <td>: <?=$sebulan[0] ?></td>
                            </tr>
                            <tr>
                                <td>Total Keseluruhan</td>
                                <td>: <?=$keseluruhan[0] ?></td>
                            </tr>
                        </table>    
                    </div>
                </div>
				<!-- DataTales Example -->
				<!-- data today -->
                <!-- DataTales Example -->
    <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?= date('d-m-Y')?>] </h6>
            </div>
            <div class="card-body">
                <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"> Rekapitulasi Pengunjung</i></a>
                <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out"> Logout</i></a>
                
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama Pengunjung</th>
                                <th>NIK Pengunjung</th>
                                <th>Alamat</th>
                                <th>No. HP</th>
                                <th>Tujuan</th>
                                <th>Aksi</th>              
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $tgl = date('Y-m-d');
                                $ambildata = mysqli_query($koneksi, "SELECT * FROM tamu where time like '%$tgl%' order by id_tamu desc");
                                $no = 1;
                                while($data = mysqli_fetch_array($ambildata)){ ?>
                                    <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$data['time']?></td>
                                    <td><?=$data['nama']?></td>
                                    <td><?=$data['nik']?></td>
                                    <td><?=$data['alamat']?></td>
                                    <td><?=$data['hp']?></td>
                                    <td><?=$data['pesan']?></td>
                                    <td>
                                            <a href="edit.php?id=<?=$data['id_tamu']?>" class='btn btn-warning'><i class='fa fa-pen'></i> Edit</a> 
                                            <a href="delete.php?id=<?=$data['id_tamu']?>" class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</a>
                                    </td>
                                    </tr>
                               <?php  } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Your Website 2021</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Tambahkan script JavaScript jika diperlukan -->
    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    <!-- !-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>
  </body>
</html>
