<?php
    include "header.php";
?>
<!DOCTYPE html>
<head>
<title>Buku Tamu</title>
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

    </style>
   
</head>
<body>
<br />
   <div class="container rounded shadow p-4 mb-1 bg-white">
    <!-- KONTEN TABEL KANAN -->
	<canvas id="c" width="320" height="240"></canvas>
    <div class="col-lg-16 shadow-sm p-3 mb-2 bg-white rounded">
	<div class="row shadow-sm mb-2 bg-white rounded-top" style="background-image: linear-gradient(to right top, #4287f5, #4b8cf5, #5491f5, #5c96f4, #649bf4);padding:5px;margin-top:-20px;">
		<div class="col-sm-8" style="text-align:center;"><h3 style="color:#ffff;margin:auto;margin-top:2px;">Data Tamu </h3></div> 
		<div class="col"><input class="form-control form-control-sm" id="myInput" type="text" placeholder="Search.."></div>
    </div>	
	  <div id="tampildata" class="">
	    <?php include 'tampil.php';?>
	  </div>		  
  <!-- card 2 -->
  <div class="card shadow mb-3 mt-5">
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
				<div id="data_today" class="">
					<?php include 'data_today.php';?>
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
</body>
</html>