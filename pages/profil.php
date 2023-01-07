<?php
 
require_once('config/config.php');

$connection=new Connection();
$conn=$connection->getConnection();
?>

<div class="main-content">
        <div class="container-fluid">
          	<h3><a href="?p=home">Beranda </a> <i class="fa fa-angle-right"></i> Profil</h3>

          	<div class="row">
          	<div class="col-sm-12">
          	<div class="panel">

                  <div class="panel-heading">
                  	  <h4 class="mb"><strong> Profil</strong></h4>
                      </div>
                      <div class="panel-body">

          	<form action="?p=ubah_user" method="post" class="form-horizontal" onsubmit="return confirm('Anda yakin akan merubah data anda ?')">
<div class="form-group">
<label for="nama" class="col-sm-2 col-sm-2 control-label text-right">Nama</label>
<div class="col-sm-10">
<input type="text" name="nama" id="texk" class="form-control" value="<?php echo $hasil78['nama_admin'] ; ?>">
</div>
</div>
<div class="form-group">
<label for="user" class="col-sm-2 col-sm-2 control-label text-right">Username</label>
<div class="col-sm-10">
<input type="text" name="user" id="texk" class="form-control" value="<?php echo $hasil78['username'] ; ?>" readonly></div>
</div>
<div class="form-group">
	<label for="passl" class="col-sm-2 col-sm-2 control-label text-right">Password Lama</label>
	<div class="col-sm-10">
	<input type="password" id="texk" class="form-control" name="passl" placeholder="Masukan Password" required="required" oninvalid="this.setCustomValidity('Silahkan Masukan Password !!!')" oninput="setCustomValidity('')" >
</div>
</div>
<div class="form-group">
	<label for="passb" class="col-sm-2 col-sm-2 control-label text-right">Password Baru</label>
	<div class="col-sm-10">
	<input type="password" id="texk" class="form-control" name="passb" placeholder="Masukan jika akan diganti" >
</div>
</div>
<div class="form-group text-right">
<div class="col-sm-12">
	<input type="Submit" value="Ubah" class="btn btn-success" id="button">
</div>
</div>
</form>


          	</div>
          	</div>
          	</div>
          	</div>
          	</div>
</div>