
<?php 
require_once('config/config.php');

                $connection= new Connection();
                $conn=$connection->getConnection();


$id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM reservasi LEFT JOIN tamu ON reservasi.id_tamu=tamu.id_tamu WHERE no_reservasi='$id'");
    $query3->execute();
    $data = $query3->fetch(PDO::FETCH_ASSOC);

?>

<div class="main-content">
				<div class="container-fluid">
<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=data_reservasi"> Data Reservasi</a> <i class="fa fa-angle-right"></i> Detail Reservasi</h3>

					<div class="row">
						<div class="col-md-12">
							<!-- RECENT PURCHASES -->
							<div class="panel">
								<div class="panel-heading">

										<h4 class="mb"><strong> Detail Reservasi</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">No Reservasi</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nores"  class="form-control"  readonly="readonly" value="<?php echo $data['no_reservasi'] ; ?>" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Dari Tanggal</label>
                              <div class="col-sm-3">
                              <input type="text" name="dari" class="form-control" value="<?php echo $data['tgl_checkin'] ; ?>" readonly>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Sampai Tanggal</label>
                              <div class="col-sm-3">
                              <input type="text" name="sampai" class="form-control" value="<?php echo $data['tgl_checkout'] ; ?>" readonly>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Lama(Malam)</label>
                              <div class="col-sm-1">
                              <input type="text" name="lama" class="form-control" value="<?php echo $data['jumlah_hari'] ; ?>" readonly>
                              </div>
                              <div class="col-sm-5">
                              Malam
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Tamu</label>
                              <div class="col-sm-4">
                              <input type="text" name="tamu" class="form-control" value="<?php echo $data['id_tamu'].' - '.$data['nama_tamu'] ; ?>" readonly>
                              


                              </div>
                          </div>

								<div class="form-group">

                              <label class="col-sm-12 col-sm-12 text-left ">Detail Kamar :</label>
                              </div>

                          <div class="form-group">
                              <div class="col-sm-12">
                                 <table class="table table-bordered">
                                 <tr align="center">
                                 <td><strong>No</strong></td>
                                 <td><strong>No Kamar</strong></td>
                                 <td><strong>Kelas</strong></td>
                                 <td><strong>Harga</strong></td>
                                 <td><strong>Jumlah Harga</strong></td>
                                 </tr>

                                 <?php


    $query = $conn->prepare("SELECT * FROM detail_reservasi LEFT JOIN kamar ON detail_reservasi.no_kamar=kamar.no_kamar WHERE no_reservasi='$id'");
    $query->execute();
    $no=0;
    while($data2 = $query->fetch(PDO::FETCH_ASSOC)) {
      $no++;
      $jb=$data2['harga']*$data['jumlah_hari'];


      echo "<tr align='center'><td>$no</td><td>$data2[no_kamar]</td><td>$data2[kelas]</td><td>".number_format($data2['harga'])." x $data[jumlah_hari]</td><td>Rp.".number_format($jb)."</td></tr>";
    }

?>
<tr>
<td colspan="4" align="right"><strong>Total Harga</strong></td>
<td align="center"><Strong>Rp.<?php echo number_format($data['jumlah_bayar']) ; ?></Strong><input type="hidden" value="<?php echo $total ; ?>" name="total"> <input type="hidden" name="kamar" value="<?php echo $kmr ; ?>" ></td>
</tr>


                                 </table>
                                 <a href="?p=data_reservasi">>>Kembali</a>
                              </div>
									</div>
								</div>
							</div>
							<!-- END RECENT PURCHASES -->
						</div>
					</div>
					
				</div>
			</div>