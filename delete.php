<?php
include('koneksi.php');


if(isset($_POST['id']))
{
     $sql = "DELETE FROM tamu WHERE id_tamu=".$_POST['id'];
     mysqli_query($koneksi, $sql);
	 echo 'Deleted successfully.';
	 
    $target="upload/".$_POST['image'];
	if(file_exists($target)){
			unlink($target);
	}
  
} else {
    echo "0 results";
}


?>