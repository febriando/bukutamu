        
        <div id="tabel_siswa">
            <div class="table-responsive ">
                <table class="table table-hover">
                    <tbody id="myTable">
                    <?php
                    //panggil fungsi konek.php
                    include "koneksi.php";
                    $page = '';
                    if(isset($_POST["p"])){
                    $record_per_page = $_POST["p"];
                    }else{
                    $record_per_page = 5;
                    }
                    if($record_per_page=="5"){
                    $one='selected';
                    }elseif($record_per_page=="10"){
                    $two='selected';
                    }elseif($record_per_page=="50"){
                    $thre='selected';
                    }elseif($record_per_page=="100"){
                    $four='selected';
                    }
                    if(isset($_POST["page"]))
                    {
                    $page = $_POST["page"];
                    }
                    else
                    {
                    $page = 1;
                    }
                    $start_from = ($page - 1)*$record_per_page;

					$adjacents = "2";
                    //ambil data dari tabel tamu dan lakukan perulangan dengan while
                    $ambildata=mysqli_query($conn,"SELECT * FROM tamu ORDER BY id_tamu DESC LIMIT $start_from, $record_per_page")or die(mysqli_error($conn));
                    $jumlah=mysqli_num_rows($ambildata);
					
                   while($a = mysqli_fetch_assoc($ambildata))
                    {
                    ?>

                    <tr id="<?php echo $a['id_tamu']; ?>" class="<?php echo $a['image']; ?>" >
                        <td style="width:315px" >
						<img src="<?php echo "upload/".$a['image'];?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
						</td>
						<td >
						<span style="font-size:11px" id="time" class="text-black-50" ><?php echo $a['time']; ?>&nbsp;<a class="remove"><i class="fa fa-close" data-toggle="tooltip" title="Hapus data tamu"></i></a></span>
						<h4 class="text-secondary font-weight-bold"><i class="fa fa-user"></i> <?php echo $a['nama']; ?></h4>
                        <i class="fa fa-address-card"> &nbsp;</i><?php echo $a['nik'];?><br />
                        <i class="fa fa-home"> &nbsp;</i><?php echo $a['alamat'];?><br />
                        <i class="fa fa-phone"> &nbsp;</i><?php echo $a['hp'];?><br />
                        <i class="fa fa-commenting">&nbsp;</i> <?php echo $a['pesan'];?>
						
						</td>
                    </tr>
					
                    <?php
                    }
                    ?>
					</tbody>
                </table>
            </div>
			
            <div class="row">
                <div class="col-lg-9 hidden -xs">
                    <ul class="pagination pagination-sm">
                        <?php
                        //$page_query = "SELECT * FROM tabel tamu order by id_tamu DESC";
                        $page_result = mysqli_query($conn,"SELECT * FROM tamu order by id_tamu DESC");
                        $total_records = mysqli_num_rows($page_result);
                        $total_pages = ceil($total_records/$record_per_page);
					    $second_last = $total_pages - 1;
                        if ( $page > 1 ) {
                        $link = $page-1;
                        $prev = "
                        <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$link.",".$record_per_page."'> &lsaquo;&lsaquo;</a></li>";
						
                        } else {
                        $prev = "
                        <li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>&lsaquo;&lsaquo;</a></li>";
						
                        }
						//**********************************
						//Pagination
                        $nmr=null;$first=null;$prev=null;$first1=null;$first2=null;$titik2=null;$titik=null;$sebelum_last=null;$last1=null;$next=null;$last=null;$titik3=null;
						if($total_pages<10){
                            for($i=1; $i<=$total_pages; $i++)
                            {
                              if ( $i == $page ) {
                                $nmr .= "
                                <li class=' page-item active'><a href='javascript:void(0);' class='page-link' id='".$i."'> $i</a></li>";
                              } else {
                                $nmr .="
                                <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$i.",".$record_per_page."'>".$i."</a></li>";
                              }
                            }
						}else if($total_pages>=10){
							if($page <= 4){
							     for($i=1; $i<=8; $i++)
                                {
                                   if ( $i == $page ) {
                                   $nmr .= "
                                   <li class=' page-item active'><a href='javascript:void(0);' class='page-link' id='".$i."'> $i</a></li>";
                                   } else {
                                   $nmr .="
                                   <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$i.",".$record_per_page."'>".$i."</a></li>";
                                   }
                                }
							$titik="
								<li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>...</a></li>";
							$sebelum_last="
								<li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$second_last.",".$record_per_page."'>".$second_last."</a></li>";
							$last1="
							    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$total_pages.",".$record_per_page."'>".$total_pages."</a></li>";
							}
							
							else if($page > 4 && $page < $total_pages - 4){
								$first1="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='1".",".$record_per_page."'>1</a></li>";
								$first2="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='2".",".$record_per_page."'>2</a></li>";
								$titik2="
								<li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>...</a></li>";
							for($i=$page-$adjacents; $i<=$page + $adjacents; $i++)
                                {
                                   if ( $i == $page ) {
                                   $nmr .= "
                                   <li class=' page-item active'><a href='javascript:void(0);' class='page-link' id='".$i."'> $i</a></li>";
                                   } else {
                                   $nmr .="
                                   <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$i.",".$record_per_page."'>".$i."</a></li>";
                                   }
                                }	
							$titik="
								<li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>...</a></li>";	
							$sebelum_last="
								<li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$second_last.",".$record_per_page."'>".$second_last."</a></li>";
							$last1="
							    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$total_pages.",".$record_per_page."'>".$total_pages."</a></li>";	
								
							}
							else{
								$first1="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='1".",".$record_per_page."'>1</a></li>";
								$first2="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='2".",".$record_per_page."'>2</a></li>";
								$titik3="
								<li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>...</a></li>";
							for($i=$total_pages - 6; $i<=$total_pages; $i++)
                                {
                                   if ( $i == $page ) {
                                   $nmr .= "
                                   <li class=' page-item active'><a href='javascript:void(0);' class='page-link' id='".$i."'> $i</a></li>";
                                   } else {
                                   $nmr .="
                                   <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$i.",".$record_per_page."'>".$i."</a></li>";
                                   }
                                }	
								
							}
						}
						//**********************************
                        if ( $page < $total_pages ) {
                        $link = $page + 1;
                        $next = "
                        <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$link.",".$record_per_page."'>&rsaquo;&rsaquo;</a></li>";
						$last = "
                        <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$total_pages.",".$record_per_page."'> Last</a></li>";
                        } else {
                        $next = "
                        <li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>&rsaquo;&rsaquo;</a></li>";
                        }
                        echo $first.$prev.$first1.$first2.$titik2.$titik3.$nmr.$titik.$sebelum_last.$last1.$next.$last;
                        ?>
                    </ul>
				
                </div>
				
                <div class="col-lg-3" style="margin-right:-20px">
                    <div class="form-group">
                        
                        <select class="custom-select-sm" id="location">
                            <?php
                            echo "
                            <option value='5' $one>5</option>
                            <option value='10' $two>10</option>
                            <option value='50' $thre>50</option>
                            <option value='100' $four>100</option>";?>
                        </select>
						<small class="text-muted-sm">Tampil <?php echo $jumlah;?> Dari <?php echo $total_records;?></small>
                    </div>
                </div>
            </div>
			
        </div>
<script>
$(document).ready(function () {
/*show record*/
$(document).on('change', '#location', function () {
        var p = this.value;
        $.ajax({
            url: "paging.php",
            method: "POST",
            data: { p: p },
            success: function (data) {
                $('#tabel_siswa').html(data);

            }
        })
    });

    /*Pagination*/

    $(document).on('click', '.page-link', function () {
        var mode = this.id.split(',');
        var page = mode[0];
        var p = mode[1];
        $.ajax({
            url: "paging.php",
            method: "POST",
            data: { page: page, p: p },
            success: function (data) {
                $('#tabel_siswa').html(data);

            }
        })
    });
	/*Hapus data tamu*/
	$(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");
		var image = $(this).parents("tr").attr("class");


        if(confirm('Yakin ingin menghapus data ini?'))
        {
            $.ajax({
               url: "delete.php",
               type: "POST",
               data: {id: id, image: image},
               error: function() {
                alert('something wrong !!');
			  },
               success: function(data) {
					$('#tampildata').load("tampil.php");
                    alert("Hapus data sukses !");  
               }
            });
        }
    });

	
});
</script>
