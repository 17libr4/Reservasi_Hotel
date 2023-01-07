
<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();

$pencarianSQL	= "";
# PENCARIAN DATA 
if(isset($_POST['btnCari'])) {
	$txtKataKunci	= trim($_POST['txtKataKunci']);

	// Menyusun sub query pencarian
	$pencarianSQL	= "WHERE no_reservasi='$txtKataKunci' OR reservasi.id_tamu='$txtKataKunci' OR nama_tamu LIKE '%$txtKataKunci' ";
}

# Teks pada form
$dataKataKunci = isset($_POST['txtKataKunci']) ? $_POST['txtKataKunci'] : '';



				$baris	= 50;
				$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
				$sql2 = $conn->query("SELECT * FROM reservasi LEFT JOIN tamu ON reservasi.id_tamu=tamu.id_tamu $pencarianSQL ");
				$total = $sql2->rowCount();
				$maks	= ceil($total/$baris);
				$mulai	= $baris * ($hal-1); 
?>

<style type="text/css">
				.disabled {
  pointer-events: none;
  cursor: default;
  opacity: 0.6;
}</style>
<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> Data Tamu</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">



									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No Reservasi</th>
												<th>Tanggal Reservasi</th>
												<th>Tanggal Checkin</th>
												<th>Tanggal Checkout</th>
												<th>Tamu</th>
												<th>Pembayaran</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php $sqlget=$conn->prepare("SELECT * FROM reservasi LEFT JOIN tamu ON reservasi.id_tamu=tamu.id_tamu  $pencarianSQL ORDER BY no_reservasi DESC LIMIT $mulai,$baris");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$id=$data['no_reservasi'];
					$no++;
					if($data['status']=="Booked"){
					$ci="";
					$co="disabled";}
					elseif ($data['status']=="Checkin") {

					$ci="disabled";
					$co="";
					}
					elseif ($data['status']=="Checkout") {

					$ci="disabled";
					$co="disabled";
					}
	
				
				?>
										
											<tr title="<?php echo $data['nama_tamu'] ; ?>">
												<td><a href="?p=detail_reservasi&&id=<?php echo $id ; ?>"><?php echo $id ; ?></a></td>
												<td><?php echo $data['tgl_reservasi'] ; ?></td><td><?php echo $data['tgl_checkin'] ; ?></td>
												<td><?php echo $data['tgl_checkout'] ; ?></td>
												<td><?php echo $data['id_tamu'] ; ?></td>
												<td>Rp.<?php echo number_format($data['jumlah_bayar']) ; ?></td>
												<td><?php echo $data['status'] ; ?></td>
												<td><div class='btn-group'>
						  <button type="button" class="btn btn-success btn-xs dropdown-toggle" data-toggle="dropdown">
						    <span class="fa fa-cog"></span> &nbsp;<span class="fa fa-caret-down"></span>
						  </button>
						  <ul class="dropdown-menu dropdown-menu-right" role="menu" >
						    
						    <li><a href="?p=confirmin&&id=<?php echo $data['no_reservasi'] ; ?>" onClick="return confirm('Anda yakin akan mengkonfirmasi checkin?')" class="<?php echo $ci ; ?>" >Konfirmasi Checkin</a></li>
						    <li><a href="?p=confirmout&&id=<?php echo $data['no_reservasi'] ; ?>" onClick="return confirm('Anda yakin akan mengkonfirmasi checkout?')" class="<?php echo $co ; ?>">Konfirmasi Checkout</a></li>
						    <li><a href="pages/cetak_kwitansi.php?id=<?php echo $data['no_reservasi'] ; ?>" target="_blank">Cetak Kwitansi</a></li>
<li><a href="?p=hapus_reservasi&&id=<?php echo $data['no_reservasi'] ; ?>" onClick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a></li>
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
	echo "<a href=?p=data_reservasi&hal=$h>$h</a> ";
	
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