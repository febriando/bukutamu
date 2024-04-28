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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Data Pengunjung</h1>
            </div>
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

            <!-- Content Row -->
            <div class="row">
              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$tanggal_sekarang[0] ?></div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kemarin</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$kemarin[0] ?></div>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Minggu Ini</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$seminggu[0] ?></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$sebulan[0] ?></div>
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                    <canvas id="c" width="320" height="240"></canvas>
            <div class="col-lg-16 shadow-sm p-3 mb-2 bg-white rounded">
            <div class="row shadow-sm mb-2 bg-white rounded-top" style="background-image: linear-gradient(to right top, #198754, #198754, #198754, #198754, #198754);padding:5px;margin-top:-20px;">
                <div class="col-sm-8" style="text-align:center;"><h3 style="color:#ffff;margin:auto;margin-top:2px;">Data Tamu </h3></div> 
                <div class="col"><input class="form-control form-control-sm" id="myInput" type="text" placeholder="Search.."></div>
            </div>	
            <div id="tampildata" class="">
                <?php include 'tampil.php';?>
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


     <!-- AJAX INSERT DATA  -->
   <script type="text/javascript">
		$(document).ready(function(){		
		    
		 var canvas = document.getElementById("c");
         var ctx = canvas.getContext("2d");
         $("#c").hide();
		 $("#hapus_gambar").hide();
		 $("#valid-feedback").hide();
		 $("#tooltip1").hide();
			
		$("#button_simpan").click(function(){
	        var nama = document.forms["myForm"]["nama"].value;
	        var nik = document.forms["myForm"]["nik"].value;
			var alamat = document.forms["myForm"]["alamat"].value;
			var hp = document.forms["myForm"]["hp"].value;
			var pesan = document.forms["myForm"]["pesan"].value;
			var canvas_foto = document.forms["myForm"]["foto"].value;
			
			var dataURL = canvas.toDataURL();
			

          // Fetch all the forms we want to apply custom Bootstrap validation styles to

          // Loop over them and prevent submission
          
 
		    if (nama == ""){  
			 //event.preventDefault();
			  //alert("nama tidak boleh kosong");
			}else if (nik == ""){
			//event.preventDefault();
			// alert("nik tidak boleh kosong");	
			}else if (alamat == ""){
			  //event.preventDefault();
			 // alert("alamat tidak boleh kosong");	
			}else if (hp == ""){
			  //event.preventDefault();
			  //alert("hp tidak boleh kosong");
			}else if (pesan == ""){
			  //event.preventDefault();
             //alert("pesan tidak boleh kosong");			  
			}else {
				if(canvas_foto == "ada"){
					var data = $('.form-user').serialize() + '&img=' + dataURL;
					$.ajax({
						type: 'POST',
						url: "aksi.php",
						data: data,
						success: function() {
							$('#tampildata').load("tampil.php");
						}
					});
				
					$("#valid-feedback").fadeIn(1500).delay(3500).fadeOut(1500);
					document.getElementById("form-user-id").reset();
					document.getElementById('c').innerHTML ="";
					document.getElementById("foto_canvas").value ="tidak ada";
					$("#buka_kamera").css("border","none");
					$("#c").hide();
					$("#gambar_form").show();
					$("#hapus_gambar").hide();
					$("#buka_kamera").show();				
					event.preventDefault();
					event.stopPropagation();
				}
                else{
					$("#tooltip1").fadeIn(100).delay(3500).fadeOut(1000);
					$("#buka_kamera").css("border","1px solid #b7effb");
					event.preventDefault();
			        event.stopPropagation();
					
				}			
							
			}
			
		});
		
	$("#buka_kamera").click(function() {
			Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
			});
				Webcam.attach( '#my_camera' );
				$("#simpan_gambar").hide();
        		$("#batal_simpan").hide();
           });
		   
	$("#ambil_foto").click(function() {
			// take snapshot and get image data
			  $("#ambil_foto").hide();
			  $("#simpan_gambar").show();
			  $("#batal_simpan").show();
			  
			  Webcam.freeze();
           });
		   
    $("#simpan_gambar").click(function() {
		    Webcam.snap( function(data_uri) {
				
				// display results in page
				var image = new Image();
               image.onload = function() {
                  ctx.drawImage(image, 0, 0);
               };
                image.src = data_uri;
				//document.getElementById('gambar_form').innerHTML = 
					//'<img src="'+data_uri+'" style="width:70%"/>';
					
			  } );
			document.getElementById("foto_canvas").value = "ada";
			$("#ambil_foto").show();
			$("#c").show();
			$("#gambar_form").hide();
			$("#buka_kamera").hide();
			$("#hapus_gambar").show();
			Webcam.reset();
    	});
	  $("#hapus_gambar").click(function() {
			document.getElementById('c').innerHTML ="";
			document.getElementById("foto_canvas").value ="tidak ada";
			$("#c").hide();
			$("#gambar_form").show();
			$("#hapus_gambar").hide();
			$("#buka_kamera").show();
           });
	 $("#batal_simpan").click(function() {
			Webcam.unfreeze();
			$("#simpan_gambar").hide();
			$("#batal_simpan").hide();
			$("#ambil_foto").show();
           });
		   
    //hide modal form ketika event klik di luar form modal
     	$("#myModal").on('hide.bs.modal', function(){
      		 Webcam.reset();
     	});		   
		   
	 	$("#tutup_kamera").click(function() {
				Webcam.reset();
				$("#simpan_gambar").hide();
				$("#ambil_foto").show();
          		 });
		   
		$("#myInput").on("keyup", function() {
    		var value = $(this).val().toLowerCase();
    			$("#myTable tr").filter(function() {
      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    		});
  		 });
		   
	});
	</script> 
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
  </body>
</html>
