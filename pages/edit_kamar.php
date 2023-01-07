<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

if(isset($_POST['simpan'])){
$nk=$_POST['nokamar'];
$kelas=$_POST['kelas'];
$harga=$_POST['harga'];


 $sql="UPDATE kamar SET kelas='$kelas', harga='$harga'" ;
 $conn->exec($sql);


  echo "<script>alert(\"Data berhasil disimpan !\") ; window.location.href='?p=kamar' ;</script>";



}


$id=$_GET['id'];
    $query3 = $conn->prepare("SELECT * FROM kamar WHERE no_kamar='$id'");
    $query3->execute();
    $data = $query3->fetch(PDO::FETCH_ASSOC);

?>

<style>
#frmCheckUsername {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
.status-available{color:#2FC332;}
.status-not-available{color:#D60202;}

.dropdown-menu a {
    text-decoration: none;
    display: block;
    text-align: left;
}
#nou {
    text-decoration: none;

</style>

<script>
function checkAvailability() {  
    jQuery.ajax({
    url: "cek_available2.php",
    data:'nokamar='+$("#nokamar").val(),
    type: "POST",
    success:function(data){
        $("#user-availability-status").html(data);
    },
    error:function (){}
    });
}
</script>
<div class="main-content">
        <div class="container-fluid">
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=tamu">Data Kamar</a> <i class="fa fa-angle-right"></i> Edit Kamar</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading">
                  	  <h4 class="mb"><strong> Edit Kamar</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">No.Kamar</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nokamar" id="nokamar" value="<?php echo $data['no_kamar'] ; ?>"  class="form-control" placeholder="Masukan No Kamar" readonly="readonly" required="required" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Kelas</label>
                              <div class="col-sm-10">
                                  <select   class="form-control" name="kelas" required >
                                    <option value="<?php echo $data['kelas'] ; ?>"><?php echo $data['kelas'] ; ?></option>
                                    <option value="Low Budget">Low Budget</option>
                                    <option value="Full Service">Full Service</option>
                                  </select>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Harga Per Malam</label>
                              <div class="col-sm-10">
                                  <input type="text" name="harga" value="<?php echo $data['harga'] ; ?>"  class="form-control" placeholder="Masukan Harga" required>
                              </div>
                          </div>
                          <div class="form-group">
                          <div class="col-sm-12 text-right"> 
                          <button class="btn btn-warning" type="reset" name="reset">Atur Ulang</button> 
                          <button class="btn btn-success" type="submit" name="simpan">Simpan</button>
                          </div>
                          </div>

                      </form>
                          </div>
                          
                  </div>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
            </div>
            </div>
