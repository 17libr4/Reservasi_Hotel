<?php
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();


$sql1=$conn->query("SELECT COUNT(*) FROM reservasi");
$reservasi=$sql1->fetchColumn();
$sql2=$conn->query("SELECT COUNT(*) FROM tamu");
$tamu=$sql2->fetchColumn();
$sql3=$conn->query("SELECT COUNT(*) FROM kamar");
$kamar=$sql3->fetchColumn();
$sql4=$conn->query("SELECT SUM(jumlah_bayar) FROM reservasi");
$rev=$sql4->fetchColumn();
$sql5=$conn->query("SELECT COUNT(*) FROM admin");
$admin=$sql5->fetchColumn();
?>
<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->

					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Ringkasan Data</h3>
							<p class="panel-subtitle">Periode: <?php echo date('d M Y') ; ?></p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-download"></i></span>
										<p>
											<span class="number"><?php echo number_format($reservasi) ; ?></span>
											<span class="title">Reservasi</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-users"></i></span>
										<p>
											<span class="number"><?php echo number_format($tamu) ; ?></span>
											<span class="title">Tamu</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-building"></i></span>
										<p>
											<span class="number"><?php echo number_format($kamar) ; ?></span>
											<span class="title">Kamar</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-user"></i></span>
										<p>
											<span class="number"><?php echo number_format($admin) ; ?></span>
											<span class="title">Karyawan</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-dollar"></i></span>
										<p>
											<span class="number"><?php echo number_format($rev*0.001) ; ?>K</span>
											<span class="title">Total Pembayaran</span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END OVERVIEW -->
					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Status Kamar Saat Ini</h3>
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No.Kamar</th>
												<th>Kelas</th>
												<th>Harga</th>
												<th>Status</th>
												<th>Keterangan</th>
											</tr>
										</thead>
										<tbody>

										<?php $sqlget=$conn->prepare("SELECT * FROM kamar");
				$sqlget->execute();
				$no=0;

				while($data=$sqlget->fetch(PDO::FETCH_ASSOC)){
					$dr=date('d M Y', strtotime($data['dari']));
					$sm=date('d M Y', strtotime($data['sampai']));
					if($data['status_kamar']=="Kosong"){
						$cl="label label-success";

						$ket ="-";
					}
					else {
						$cl="label label-danger";

						$ket = $dr." s/d ".$sm;

					}


											echo "<tr>
												<td>$data[no_kamar]</td>
												<td>$data[kelas]</td>
												<td>".number_format($data['harga'])."</td>
												<td><span class='$cl'>$data[status_kamar]</span></td>
												<td>$ket</span></td>
											</tr>";
										}
										?>
										</tbody>
									</table>
								</div>
								<div class="panel-footer">
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
						
					</div>
					
							</div>
							<!-- END TIMELINE -->
						</div>
					