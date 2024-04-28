<?php
    include "header2.php";
?>

<!-- DataTales Example -->
<div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?= date('d-m-Y')?>] </h6>
            </div>
            <div class="card-body">
                <a href="rekapitulasi.php" class="btn btn-success mb-3"><i class="fa fa-table"> Rekapitulasi Pengunjung</i></a>
                <a href="logout.php" class="btn btn-danger mb-3"><i class="fa fa-sign-out-alt"> Logout</i></a>
                
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
                                    <td style="display: flex;">
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

<?php
    include "footer.php";
?>
