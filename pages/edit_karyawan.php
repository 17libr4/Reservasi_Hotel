<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

if(isset($_POST['simpan'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $nama_admin=$_POST['nama_admin'];
    $nohp=$_POST['nohp'];
    $alamat=$_POST['alamat'];
    $tanggal_lahir=$_POST['tanggal_lahir'];
    
    
    $sql="UPDATE admin SET username='$username',password='$password',nama_admin='$nama_admin',nohp='$nohp',alamat='$alamat',tanggal_lahir='$tanggal_lahir' WHERE nama_admin='$nama_admin'" ;
    $conn->exec($sql);
   
   if($sql){
   
     echo "<script>alert(\"Data berhasil diupdate !\") ; window.location.href='?p=data_karyawan' ;</script>";
   }
   else {
     echo "<script>alert(\"Data gagal disimpan !\") ; window.location.href='?p=datakaryawan' ;</script>" ;
   }
   
   
   }
   
   
   $id=$_GET['id'];
       $query3 = $conn->prepare("SELECT * FROM admin WHERE username='$id'");
       $query3->execute();
       $data = $query3->fetch(PDO::FETCH_ASSOC);
   
   ?>


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
    url: "cek_available_username.php",
    data:'username='+$("#username").val(),
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
          	<h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=data_karyawan">Data Karyawan </a><i class="fa fa-angle-right"></i> Tambah Karyawan</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row">
          		<div class="col-lg-12">
                  <div class="panel">
                  <div class="panel-heading">
                  	  <h4 class="mb"><strong> Edit Karyawan</strong></h4>
                      </div>
                      <div class="panel-body">

                      <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ; ?>" onSubmit="return confirm('Anda yakin akan menyimpan data ?')">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Username</label>
                              <div class="col-sm-10">
                                  <input type="text" name="username" id="username" value="<?php echo $data['username'] ; ?>"   class="form-control" placeholder="Masukan Username" onBlur="checkAvailability()"  required="required" oninvalid="this.setCustomValidity('Ex : B09')" oninput="setCustomValidity('')" required=""><span id="user-availability-status"></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Nama Lengkap</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nama_admin" value="<?php echo $data['nama_admin'] ; ?>"  class="form-control" placeholder="Masukan Nama Lengkap" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Password</label>
                              <div class="col-sm-10">
                                  <input type="password" name="password"  class="form-control" placeholder="Masukan Password Baru" required>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">No Hp</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nohp" value="<?php echo $data['nohp'] ; ?>" class="form-control" placeholder="Masukan No Hp" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Alamat</label>
                              <div class="col-sm-10">
                                  <input type="text" name="alamat" value="<?php echo $data['alamat'] ; ?>"  class="form-control" placeholder="Masukan Alamat" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label text-right">Tanggal Lahir</label>
                              <div class="col-sm-10">
                                  <input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir'] ; ?>"  class="form-control" required>
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
