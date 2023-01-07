<?php 
require_once('config/config.php');
date_default_timezone_set('Asia/Jakarta');
$tanggal=date('d-M-Y');
$today=date('Y-m-d');

$ngaran=$_POST['nama'];
$passl=$_POST['passl'];
$passb=$_POST['passb'];
$user=$_POST['user'];


                $connection= new Connection();
                $conn=$connection->getConnection();
    $sql79=$conn->prepare("SELECT * FROM admin WHERE username='$_SESSION[username]'");
        $sql79->execute();
    $admin=$sql79->fetch(PDO::FETCH_ASSOC);




$ngarana = $admin['nama_admin'];
$pass = $admin['password'];
$username= $admin['username'];

//
if($passl==$pass AND $passb=="" ){
	$sqInsert="UPDATE admin SET nama_admin='$ngaran' WHERE username='$_SESSION[username]'";
				$conn->exec($sqInsert);
	?>
	<script>
		alert("Perubahan Berhasil");
		window.location.href="?p=profil";
</script>
<?php }

elseif ( $passl == $pass ){
	$sqInsert="UPDATE admin SET password='$passb',nama_admin='$ngaran' WHERE username='$_SESSION[username]'";
				$conn->exec($sqInsert);
	
	?>
	<script>
		alert("Perubahan Berhasil");
		window.location.href="?p=profil";
</script>
<?php }
else {
	?>
	<script>
alert("Password Lama Salah ! Silahkan Coba Lagi !");
window.location.href="?p=profil";
</script>
<?php } ?>
