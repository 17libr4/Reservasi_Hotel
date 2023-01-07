<?php

require_once("config/config.php");

require_once("config/function.php");
$connection=new Connection() ;
$conn=$connection->getConnection();

if(isset($_POST['simpan'])){
$nk=$_POST['nokamar'];
$kelas=$_POST['kelas'];
$harga=$_POST['harga'];


        $sqlgetin6=$conn->prepare("SELECT * FROM kamar WHERE no_kamar='$nk'");
      $sqlgetin6->execute();
        $ada=$sqlgetin6->fetch(PDO::FETCH_COLUMN)+0;
if($ada==0){
 $sql="INSERT INTO kamar VALUES ('$nk','$kelas','$harga')" ;
 $conn->exec($sql);


  echo "<script>alert(\"Databerhasil disimpan !\") ; window.location.href='?p=kamar' ;</script>";

}
else {
  echo "<script>alert(\"Data gagal disimpan, coba lagi !\") ; window.location.href='?p=kamar' ;</script>";
  
}

}


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

<link href="assets/bs/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
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
                <h3><a href="?p=home">Beranda </a><i class="fa fa-angle-right"></i> <a href="?p=data_reservasi">Data Reservasi </a><i class="fa fa-angle-right"></i> Transaksi Reservasi</h3>
                
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row">
                    <div class="col-lg-12">
                    <div class="panel">
                    <div class="panel-heading">
                        <h4 class="mb"><strong> Pilih Tanggal Menginap</strong></h4>
                        </div>
                        <div class="panel-body">

<form method="post" action="?p=trx_reservasi2" class="form-horizontal" >

		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label text-right">Dari Tanggal :</label>
			<div class="col-sm-10">
			            <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="dari"   required="required" oninvalid="this.setCustomValidity('Silahkan Masukan Tanggal !!!')" oninput="setCustomValidity('')" readonly="readonly" >
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 col-sm-2 control-label text-right">Sampai Tanggal :</label>
			<div class="col-sm-10">
			              <div class="input-group date form_date " data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" name="sampai" required="required" oninvalid="this.setCustomValidity('Silahkan Masukan Tanggal !!!')" oninput="setCustomValidity('')" readonly="readonly">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                </div>
		</div>
		<div class="form-group text-right">
			<button class="btn btn-success" type="submit" name="btntanggal"> Cek Kamar</button>
		</div>
		</form>
<script type="text/javascript" src="assets/bs/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/bs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/bs/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="assets/bs/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'id',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
						
                          </div>
                          
                  </div>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
            </div>
            </div>
