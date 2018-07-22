<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';

	$aksi = new oop();

?>
<!DOCTYPE html>
<html>
<head>
	<title>PETUGAS KOPERASI</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="navbar navbar-fixed-top navbar-inverse">
				<a href="index.php" class="navbar-brand">KOPERASI KITA</a>
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="?menu=anggota">ANGGOTA</a>
					</li>
					<li class="dropdown">
						<a href="?menu=simpanan">SIMPANAN</a>
					</li>
					<li class="dropdown">
						<a href="?menu=pinjaman">PINJAMAN</a>
					</li>
					<li class="dropdown">
						<a href="?menu=angsuran">ANGSURAN</a>
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
			case 'halpetugas':include 'hal_petugas.php'; break;
			case 'anggota':include 'anggota.php'; break;
			case 'simpanan':include 'simpanan.php'; break;
			case 'pinjaman':include 'pinjaman.php'; break;
			case 'pengajuan':include 'pengajuan.php'; break;
			case 'syarat':include 'syarat.php'; break;
			case 'angsuran':include 'angsuran.php'; break;
			default:$aksi->alamat("index.php?menu=halpetugas");break;
		}
			?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

</body>
</html>