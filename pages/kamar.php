
<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();

$pencarianSQL	= "";
# PENCARIAN DATA 
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Menyusun sub query pencarian
	$pencarianSQL	= "WHERE no_kamar LIKE '%$txtKataKunci%' ";
}

# Teks pada form
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';



				$baris	= 50;
				$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
				$sql2 = $conn->query("SELECT * FROM kamar $pencarianSQL ");
				$total = $sql2->rowCount();
				$maks	= ceil($total/$baris);
				$mulai	= $baris * ($hal-1); 
?>
<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> Data Kamar</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">

										<div class="text-left"><a href="?p=tambah_kamar" class="btn btn-primary">Tambah Kamar</a></div>


									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No Kamar</th>
												<th>Kelas</th>
												<th>Harga</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $sqlget=$conn->prepare("SELECT * FROM kamar  $pencarianSQL ORDER BY no_kamar DESC LIMIT $mulai,$baris");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$id=$data['no_kamar'];
					$no++;
	
				
				?>
										
											<tr>
												<td><a href="#"><?php echo $data['no_kamar'] ; ?></a></td>
												<td><?php echo $data['kelas'] ; ?></td>
												<td>Rp.<?php echo number_format($data['harga']) ; ?></td>
												<td><div class='btn-group'>
						  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-cog"></span> &nbsp;<span class="fa fa-caret-down"></span>
						  </button>
						  <ul class="dropdown-menu" role="menu" >
						    
						    <li><a href="?p=edit_kamar&&id=<?php echo $data['no_kamar'] ; ?>">Edit</a></li>
<li><a href="?p=hapus_kamar&&id=<?php echo $data['no_kamar'] ; ?>" onClick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></li>
						  </ul>
						</div></td>
											</tr>

											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-6">Total Data : <?php echo $total ; ?> | Pages ( <?php for($h=1;$h<=$maks;$h++){
	echo "<a href=?p=kamar&hal=$h>$h</a> ";
	
} ?> )
	        </div>
									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div>
					
				</div>
			</div>