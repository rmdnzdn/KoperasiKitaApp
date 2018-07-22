<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';

	$aksi = new oop();

?>
<!DOCTYPE html>
<html>
<head>
	<title>KEPALA PETUGAS KOPERASI</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="navbar navbar-fixed-top navbar-inverse">
				<a href="index.php" class="navbar-brand">KOPERASI KITA</a>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="?menu=kategori">KATEGORI</a>
					</li>
					<li class="dropdown">
						<a href="?menu=petugas">PETUGAS</a>
					</li>
					<li class="dropdown">
						<a href="?menu=pengajuan">DATA PENGAJUAN</a>
					</li>
					<li class="dropdown">
						<a href="?menu=simpanan">LAPORAN</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right" style="margin-right: 50px">
					<li class="dropdown">
						<a href="#" id="akun">ZIDUN</a>
					</li>
					<li class="dropdown">
						<a href="?logout" id="akun">KELUAR</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<?php  
		switch (@$_GET['menu']) {
			case 'halkepala':include 'hal_kepala.php'; break;
			case 'kategori':include 'kategori.php'; break;
			case 'petugas':include 'petugas.php'; break;
			case 'anggota':include 'anggota.php'; break;
			case 'pengajuan':include 'pengajuan.php'; break;
			default:$aksi->alamat("index.php?menu=halkepala");break;
		}
			?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

</body>
</html>