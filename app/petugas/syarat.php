<br>
<br>
<br>
<br>
<?php  
	$id = $_GET['id_pinjaman'];
	$pinjaman = $aksi->caridata("pinjaman WHERE id_pinjaman = '$id'");
	$pengajuan = $aksi->caridata("pengajuan WHERE id_pengajuan = '$pinjaman[id_pengajuan]'");
	$tempat = "../images";
	$upload = $aksi->upload($tempat);
	if (isset($_POST['update'])) {
		if (empty($_FILES['foto']['name'])) {
			$data = array(
				'nama_jaminan'=>$_POST['nama_jaminan'],
				'ktp'=>$_POST['ktp'],
				'kk'=>$_POST['kk']
			);
		}else{
			$data = array(
				'nama_jaminan'=>$_POST['nama_jaminan'],
				'foto'=>$upload,
				'ktp'=>$_POST['ktp'],
				'kk'=>$_POST['kk']
			);
		}
		$aksi->ubah("pengajuan",$data,"id_pengajuan = '$pengajuan[id_pengajuan]'");
		$aksi->alert("Data Berhasil Diperbaharui","?menu=syarat&id_pinjaman=$pinjaman[id_pinjaman]");
	}

	if ($pinjaman['ket']=="Lengkapi Persyartan" || $pinjaman['ket']=="Pending") {
		if ($pengajuan['nama_jaminan'] != "" && $pengajuan['foto'] != "" && $pengajuan['ktp'] == "1" && $pengajuan['kk']=="1") {
				$aksi->ubah("pengajuan",array('ket'=>"Lengkap"),"id_pengajuan = '$pinjaman[id_pengajuan]'");
				$aksi->ubah("pinjaman",array('ket'=>"Pending"),"id_pinjaman = '$id'");
		}else{
			$aksi->ubah("pengajuan",array('ket'=>"Belum Lengkap"),"id_pengajuan = '$pinjaman[id_pengajuan]'");
			$aksi->ubah("pinjaman",array('ket'=>"Lengkapi Persyartan"),"id_pinjaman = '$id'");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Syarat Pinjaman</title>
</head>
<body>
	<br> <br> <br> <br> 
	<div class="container">
		<div class="row">
			<div class="col-md-12"> 
				<div class="col-md-1"> </div>
				<div class="col-md-10"> 
					<form method="post" enctype="multipart/form-data">
					<div class="panel panel-default">
						<div class="panel-heading">Syarat dan Ketentuan Pinjaman - <?php echo $id ?></div>
						<div class="panel-body">
							<div class="col-md-6">
								<div class="form-group">
									<input type="checkbox" name="ktp" value="1" <?php echo $pengajuan['ktp']=="1"?"checked":"" ?>> * Fotocopy KTP (Suami istri bila sudah menikah)
								</div>
								<div class="form-group">
									<input type="checkbox"  name="kk" value="1" <?php echo $pengajuan['kk']=="1"?"checked":"" ?>> * Fotocopy Kartu Keluarga
								</div>
								<div class="form-group"> 
									<label>Nama Jaminan : <strong><?php echo $pengajuan['nama_jaminan']; ?></strong></label>
								</div>	
								<div class="form-group"> 
										Foto : <img src="../images/<?php echo $pengajuan['foto'] ?>" width="80" height="80">
								</div>	
								
							</div>
							<div class="col-md-6"> 
								<div class="form-group"> 
									<label>Masukan Nama Jaminan</label>
									<input type="text" name="nama_jaminan" placeholder="Nama Jaminan" class="form-control" value="<?php echo @$pengajuan['nama_jaminan'] ?>">
								</div>	
								<div class="form-group"> 
									<label>Masukan Foto Jaminan</label>
									<input type="file" name="foto" class="form-control">
								</div>	
								<div class="form-group">
									<input type="submit" name="update" class="btn btn-primary btn-lg" value="UPDATE">
									<a href="?menu=pinjaman" class="btn btn-success btn-lg">Lihat Data</a>
								</div>
							</div>
						</div>
					</div>
				</form>	
				</div>
			</div>	
		</div>	
	</div>

</body>
</html>