
<?php
error_reporting(0);
include "koneksi.php";
$page = '';
$output = '';
if(isset($_POST["p"]))
{
  $record_per_page = $_POST["p"];
}
else
{
  $record_per_page = 5;
}
if($record_per_page=="5"){
 $one='selected';
}elseif($record_per_page=="10"){
 $two='selected';
}elseif($record_per_page=="50"){
 $thre='selected';
}
elseif($record_per_page=="100"){
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
//$query = "SELECT * FROM tb_siswa order by id_siswa asc LIMIT $start_from, $record_per_page";
$result = mysqli_query($koneksi,"SELECT * FROM tamu order by id_tamu DESC LIMIT $start_from, $record_per_page");
$jumlah = mysqli_num_rows($result);
$output .="<div>
    <table class='table table-hover'>
	<tbody id='myTable'>";

        while($row = mysqli_fetch_assoc($result))
        {
        $output .= "
		
        <tr id='".$row['id_tamu']."' class='".$row['image']."'>
			<td style='width: 315px;'>
				<img src='upload/".$row['image']."' class='img-thumbnail' alt='Cinque Terre' width='304' height='236'>
			</td>
			<td>
				<span style='font-size:11px' id='time' class='text-black-50'>".$row['time']."&nbsp;<a class='remove'><i class='fa fa-close' data-toggle='tooltip' title='Hapus data tamu'></i></a></span>
				<h4 class='text-primary font-weight-bold'><i class='fa fa-user'></i> ".$row['nama']."</h4>
                <i class='fa fa-address-card'> &nbsp;</i>".$row['nik']."<br />
                <i class='fa fa-home'> &nbsp;</i>".$row['alamat']."<br />
                <i class='fa fa-phone'> &nbsp;</i>".$row['hp']."<br />
                <i class='fa fa-commenting'> &nbsp;</i>".$row['pesan']."	
			</td>
        </tr>
		
        ";
        }
        $output .= "
      </tbody>    
	</table>
</div>";
$output .= '<div class="row">
    <div class="col-lg-9">
        <ul class="pagination pagination-sm">
            ';
            //$page_query = "SELECT * FROM tb_siswa order by id_siswa asc";
            $page_result = mysqli_query($koneksi,"SELECT * FROM tamu ORDER BY id_tamu desc")or die(mysqli_error($koneksi));
            $total_records = mysqli_num_rows($page_result);
            $total_pages = ceil($total_records/$record_per_page);
			$second_last = $total_pages - 1;
            if ( $page > 1 ) {
			
            $link = $page-1;
            $prev = "
            <li class='page-item'><a href='javascript:void(0);' class='page-link' id='".$link.",".$record_per_page."'>&lsaquo;&lsaquo;</a></li>";
			$first="
			<li class='page-item'><a href='javascript:void(0);' class='page-link' id='1".",".$record_per_page."'>First</a></li>";
            } else {
            $prev = "
            <li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>&lsaquo;&lsaquo;</a></li>";
            }
			//Pagination**********************************
            $nmr='';
			if($total_pages<10){
               for($i=1; $i<=$total_pages; $i++)
               {
                 if ( $i == $page ) {
                 $nmr .= "
                       <li class='page-item active'><a href='javascript:void(0);' class='page-link' id='".$i.",".$record_per_page."'> $i</a></li>";
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
							
							else if($page > 4 && $page < $total_pages -4){
								$first1="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='1".",".$record_per_page."'>1</a></li>";
								$first2="
			                    <li class='page-item'><a href='javascript:void(0);' class='page-link' id='2".",".$record_per_page."'>2</a></li>";
								$titik2="
								<li class='page-item disabled'><a href='javascript:void(0);' class='page-link'>...</a></li>";
							for($i=$page - $adjacents; $i<=$page+ $adjacents; $i++)
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
            $output .=$first.$prev.$first1.$first2.$titik2.$titik3.$nmr.$titik.$sebelum_last.$last1.$next.$last;
            $output .= '
        </ul>
    </div>
    <div class="col-lg-3">
        <div class="form-group">    
            <select class="custom-select-sm" id="location">
                <option value="5" ' .$one. '>5</option>
                <option value="10" ' .$two. '>10</option>
                <option value="50" ' .$thre. '>50</option>
                <option value="100" ' .$four. '>100</option>
            </select>
			<small class="text-muted">Tampil ' .$jumlah. ' Dari ' .$total_records. '</small>
        </div>
    </div>
</div>';

echo $output;

?>
<script>
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
</script>
