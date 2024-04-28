<?php

session_start();

if (empty($_SESSION["mail_success"])) $_SESSION["mail_success"] = false;
if (empty($_SESSION["mail_error"])) $_SESSION["mail_error"] = false;

$success = $_SESSION["mail_success"];
$error = $_SESSION["mail_error"];

?>
<!DOCTYPE html>
<head>
<title>Buku Tamu</title>
<link rel="icon" href="assets/img/logo_kmt.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/webcam.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<style>
	body {
      /* background: rgb(5,117,230);
      background-image: linear-gradient(to top, #2b6b31, #418a34, #5dab33, #80cb2a, #a8eb12); */
	  background-color: #E7E8E6;
	  background-attachment: fixed;
	    color: #333333;
    font-family: ProximaNova, sans-serif;
    font-size: 0.800em;
    font-weight: 400;
    line-height: 1.625;  
     
    }
	.container {
      background: white;
	  
	  
    }
	#tampildata{
        overflow-y: scroll;
		overflow-x: hidden;
		
		background: white;
		
	}
	.col-lg-8{
        background: white;
		 margin: 0 0 0 0;
	}
    #c
    {
      margin-top: 0px;
      margin-bottom: 0px;
      margin-right: 0px;
      margin-left: -10px;
    }
   #avatar{
	display: block;
	margin-left: auto;
    margin-right: auto;
	margin-top: -10px;
	margin-bottom:6px;
    
   }
   #buka_kamera{
	  display: block;
	  margin: 0 auto;  
   }
   #time{
	   float:right;
   }
   
   .gambar_form{
		height:auto;
		background-color:white;
   }
   .gambar_form .close {
		position: absolute;
		top: 34px;
		right: 17px;
		z-index: 100;
   }
   @media (max-width: 767px) {
    /* Gaya CSS tambahan untuk tampilan mobile */
    .gambar_form {
        padding: 10px;
    }
    #avatar {
        width: 100%;
    }
    #c {
        width: 100%;
        height: auto;
    }
    .alert {
        font-size: 12px;
    }
}


    </style>
   
</head>
<body>
<br />
   <div class="container rounded shadow p-4 mb-1 bg-white">
		<div class="row shadow-none p-3 mb-5 bg-light rounded" style="margin-top:-15px;height:auto;">
		<!-- AWAL KONTEN -->
			<div class="col-lg-12"> 
				<div class="col-lg-12 col-md-12 col-sm-12">
				<!-- Konten di sini -->
					<div class="shadow-sm rounded-top" style="background-image: linear-gradient(to right top, #4287f5, #4b8cf5, #5491f5, #5c96f4, #649bf4);padding:3px;margin-top:-5px;"><h3 align="center" style="color:#ffff;margin:auto;padding-bottom:2px;">Selamat Datang di PT NUSIRA</h3></div>
						<!-- AWAL FORM -->
						<!-- <div class="gambar_form shadow-sm p-3 mb-5 rounded-bottom">
							<i class="close" data-toggle="tooltip" title="Hapus gambar" id="hapus_gambar" style="color:grey;font-size:18px">&times;</i>
							<span id="gambar_form" ><img id="avatar" src="image/image_placeholder_2.png" style="width:20%" alt="..." class="rounded" data-toggle="tooltip" title="Klik Buka Kamera untuk berfoto !"></span>
							<canvas id="c" width="320" height="240"></canvas>
							<button type="button" class="btn btn-light btn-sm d-block mx-auto" data-toggle="modal" data-target="#myModal" id="buka_kamera"><i class="fa fa-camera"></i>&nbsp;Buka Kamera</button>		  
						<div class="alert alert-danger" id="tooltip1" style="font-size:10px;padding: 2px;margin:0 auto;width:200px;text-align:center;">
								Klik<strong> Buka Kamera</strong> untuk berfoto
						</div>
						</div> -->
						
						<form method="post" class="form-user" name="myForm" id="form-user-id" action="aksi.php" enctype="multipart/form-data">
							<div class="form-group">
						
								<label for="nama"><h3>Silahkan isi data Anda:</h3></label>
								<input type="text" class="form-control form-control-sm" name="nama" id="validationCustom01" placeholder="Nama" oninvalid="this.setCustomValidity('Please Enter Name')"
									oninput="setCustomValidity('')" required></input>
								
							</div>

							<div class="form-group">
								<input type="file" class="form-control form-control-sm" name="images[]" id="validationCustom00" placeholder="Photo" oninvalid="this.setCustomValidity('Please Input Your Photo')"
									oninput="setCustomValidity('')" multiple required></input>
								
							</div>

							<div class="form-group">
								<input type="text" class="form-control form-control-sm" name="nik" id="validationCustom02"  placeholder="Nik" oninvalid="this.setCustomValidity('Please Enter Address')"
									oninput="setCustomValidity('')"required>
								
							</div>
							<div class="form-group">
								<input type="text" class="form-control form-control-sm" name="alamat" id="validationCustom02"  placeholder="Alamat" oninvalid="this.setCustomValidity('Please Enter Address')"
									oninput="setCustomValidity('')"required>
								
							</div>
							<div class="form-group">
								<input type="text" class="form-control form-control-sm" name="hp" id="validationCustom03"  placeholder="No Hp" oninvalid="this.setCustomValidity('Please Enter Phone Number')"
									oninput="setCustomValidity('')"required>
					
							</div>
							<div class="form-group">
								<!--<label for="pesan">Komentar:</label>  -->
								<textarea class="form-control form-control-sm" name="pesan" id="validationCustom04"  rows="3" placeholder="Tujuan" oninvalid="this.setCustomValidity('Please Enter Comment')"
									oninput="setCustomValidity('')" required></textarea>
								
							</div>
							<div class="form-group">        
							<div class="col-sm-offset-2 col-sm-12">
								<button type="submit" class="btn btn-primary btn-sm" id="button_simpan" style="margin-left:-15px;margin-top:-2px;"><i class="fa fa-archive"></i>&nbsp;Simpan</button>
								<div class="alert alert-success" id="valid-feedback" style="font-size:11px;padding:8px;display:inline;margin-top:20px">
									<strong>Berhasil</strong> menyimpan data &nbsp;<i class="fa fa-check"></i>
									<?php include 'contact-messageEmail.php'; ?>
								</div>
							</div>
						</div>
						
								<!-- untuk validasi foto apakah sudah ada atau belum -->   
								<input type="hidden" id="foto_canvas" name="foto" value="tidak ada"></input>   
							</form>
							</div> 
						</div>
					
							<!-- Modal form kamera -->
							<div class="modal fade" id="myModal">
								<div class="modal-dialog">
								<div class="modal-content">
								<form class="temp_foto" action="">
									<!-- Modal Header -->
									<div class="modal-header">
									<h4 class="modal-title">Foto Selfie</h4>
									<button type="button" class="close" data-dismiss="modal" id="tutup_kamera">&times;</button>
									</div>
									
									<!-- Modal body -->
									
									<div class="modal-body" align="center">
									
									
										<div id="#my_camera" class="rounded"></div> 
									<br />
									<button type="button" class="btn btn-secondary btn-sm" id="ambil_foto">Capture</button>
									<button type="button" data-dismiss="modal" class="btn btn-success btn-sm" id="simpan_gambar">Simpan gambar</button>
									<button type="button" class="btn btn-secondary btn-sm" id="batal_simpan">Batal</button>
									
									</div>
									
									<!-- Modal footer -->
										<div class="modal-footer"></div>
									</form>
								</div>
							</div>
						</div>
					</div>
   				</div>
			</div>
		</div>
		<footer class="text-center"></footer>
	</div>
   
   <!-- AJAX INSERT DATA  -->
   <script type="text/javascript">
		$(document).ready(function(){		
		    
		//  var canvas = document.getElementById("c");
        //  var ctx = canvas.getContext("2d");
        //  $("#c").hide();
		//  $("#hapus_gambar").hide();
		 $("#valid-feedback").hide();
		//  $("#tooltip1").hide();
			
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
          
 
		    // if (nama == ""){  
			 //event.preventDefault();
			  //alert("nama tidak boleh kosong");
			// }else if (nik == ""){
			//event.preventDefault();
			// alert("nik tidak boleh kosong");	
			// }else if (alamat == ""){
			  //event.preventDefault();
			 // alert("alamat tidak boleh kosong");	
			// }else if (hp == ""){
			  //event.preventDefault();
			  //alert("hp tidak boleh kosong");
			// }else if (pesan == ""){
			  //event.preventDefault();
             //alert("pesan tidak boleh kosong");			  
			// }else {
					var data = $('.form-user').serialize();
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
					event.preventDefault();
					event.stopPropagation();	
			// }
		});
		
	// $("#buka_kamera").click(function() {
	// 		Webcam.set({
	// 		width: 320,
	// 		height: 240,
	// 		image_format: 'jpeg',
	// 		jpeg_quality: 90
	// 		});
	// 			Webcam.attach( '#my_camera' );
	// 			$("#simpan_gambar").hide();
    //     		$("#batal_simpan").hide();
    //        });
		   
	// $("#ambil_foto").click(function() {
	// 		// take snapshot and get image data
	// 		  $("#ambil_foto").hide();
	// 		  $("#simpan_gambar").show();
	// 		  $("#batal_simpan").show();
			  
	// 		  Webcam.freeze();
    //        });
		   
    // $("#simpan_gambar").click(function() {
	// 	    Webcam.snap( function(data_uri) {
				
	// 			// display results in page
	// 			var image = new Image();
    //            image.onload = function() {
    //               ctx.drawImage(image, 0, 0);
    //            };
    //             image.src = data_uri;
	// 			//document.getElementById('gambar_form').innerHTML = 
	// 				//'<img src="'+data_uri+'" style="width:70%"/>';
					
	// 		  } );
	// 		document.getElementById("foto_canvas").value = "ada";
	// 		$("#ambil_foto").show();
	// 		$("#c").show();
	// 		$("#gambar_form").hide();
	// 		$("#buka_kamera").hide();
	// 		$("#hapus_gambar").show();
	// 		Webcam.reset();
    // 	});
	//   $("#hapus_gambar").click(function() {
	// 		document.getElementById('c').innerHTML ="";
	// 		document.getElementById("foto_canvas").value ="tidak ada";
	// 		$("#c").hide();
	// 		$("#gambar_form").show();
	// 		$("#hapus_gambar").hide();
	// 		$("#buka_kamera").show();
    //        });
	//  $("#batal_simpan").click(function() {
	// 		Webcam.unfreeze();
	// 		$("#simpan_gambar").hide();
	// 		$("#batal_simpan").hide();
	// 		$("#ambil_foto").show();
    //        });
		   
    // //hide modal form ketika event klik di luar form modal
    //  	$("#myModal").on('hide.bs.modal', function(){
    //   		 Webcam.reset();
    //  	});		   
		   
	//  	$("#tutup_kamera").click(function() {
	// 			Webcam.reset();
	// 			$("#simpan_gambar").hide();
	// 			$("#ambil_foto").show();
    //       		 });
		   
		$("#myInput").on("keyup", function() {
    		var value = $(this).val().toLowerCase();
    			$("#myTable tr").filter(function() {
      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    		});
  		 });
		   
	});
	</script>  
</body>
</html>