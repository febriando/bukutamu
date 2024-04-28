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
          <div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi pengunjung </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="" class="text-center">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dari tanggal</label>
                                    <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Hingga tanggal</label>
                                    <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <button class="btn btn-primary form-control" name="btntampilkan"> <i class="fa fa-search"></i> Tampilkan</button>
                        </div>
                        <div class="col-md-2">
                            <a href="index.php" class="btn btn-danger form-control"> <i class="fa fa-backward"></i> Kembali</a>
                        </div>
                    </div>
                </form>

                <?php
                    if(isset($_POST['btntampilkan'])) :
                ?>

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
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $tgl1 = $_POST['tanggal1'];
                                $tgl2 = $_POST['tanggal2'];
                                // echo "Tanggal Awal: " . $tgl1 . "<br>";
                                // echo "Tanggal Akhir: " . $tgl2 . "<br>";

                                // // Eksekusi query SQL
                                $tampil_data = mysqli_query($koneksi, "SELECT * FROM tamu where time BETWEEN '$tgl1' and '$tgl2' order by id_tamu desc");
                                $no = 1;
                                while($data = mysqli_fetch_array($tampil_data)){
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['time']?></td>
                                        <td><?= $data['nama']?></td>
                                        <td><?= $data['nik']?></td>
                                        <td><?= $data['alamat']?></td>
                                        <td><?= $data['hp']?></td>
                                        <td><?= $data['pesan']?></td>
                                    </tr>
                                <?php } ?>
                        </tbody>
                    </table>
                    <center>
                        <form method="POST" action="exportexcel.php">
                            <div class="col-md-4">
                            <input type="hidden" name="tanggal__a" value="<?= @$_POST['tanggal1'] ?>">
                            <input type="hidden" name="tanggal_b" value="<?= @$_POST['tanggal2'] ?>">

                            <!-- <button class="btn btn-success form-control" name="btnexport"> <i class="fa fa-download"></i> Export Data</button> -->

                            </div>
                        </form>
                    </center>
                </div>

                    <?php endif; ?>

            </div>
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
<!-- jquery -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <!-- jquery datatable -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    
        <!-- script tambahan  -->
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js">
        </script>
<!-- fungsi datatable -->
<script>
            $(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        $('#dataTable').DataTable().destroy();
    }
    
    $('#dataTable').DataTable({
        // konfigurasi DataTables
         // script untuk membuat export data 
         dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
    });
});
    
        </script>
  </body>
</html>
