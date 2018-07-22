<br><br>
<?php  
	$carikodep = mysql_fetch_array(mysql_query("select * from pinjaman order by id_pinjaman DESC"));
	$kodep = substr($carikodep['id_pinjaman'],3,5)+1;
	$nextkodep = sprintf("PJN".'%05s',$kodep);

	$carikodepn = mysql_fetch_array(mysql_query("select * from pengajuan order by id_pengajuan DESC"));
	$kodepn = substr($carikodepn['id_pengajuan'],3,5)+1;
	$nextkodepn = sprintf("AJN".'%05s',$kodepn);

	@$anggota = $aksi->caridata("anggota WHERE id_anggota = '$_POST[id_anggota]'");
	@$kategori = $aksi->caridata("kategori_pinjaman WHERE id_kategori = '$_POST[id_kategori]'");
	if (isset($_POST['simpan'])) {
		if ($anggota['ket']=="meminjam") {
			$aksi->pesan('Anggota Tersebut Terkait Pinjaman');
		}elseif ($_POST['tbesar'] > $kategori['max_pinjaman']) {
			$aksi->pesan('Maaf Pinjaman Melebihi Maksimal Pinjaman');
		}else{
			$data = array(
				'id_pinjaman'=>$nextkodep,
				'id_pengajuan'=>$nextkodepn,
				'id_kategori'=>$_POST['id_kategori'],
				'id_anggota'=>$_POST['id_anggota'],
				'besar_pinjaman'=>$_POST['tbesar'],
				'tgl_pengajuan_pinjaman'=>date("Y-m-d"),
				'ket'=>'Lengkapi Persyaratan'
			);
			$datap = array(
				'id_pengajuan'=>$nextkodepn,
				'ket'=>'Belum Lengkap'
			);

			$aksi->simpan("pinjaman",$data);
			$aksi->simpan("pengajuan",$datap);
			$aksi->ubah("anggota",array('ket'=>"Meminjam"),"id_anggota = '$_POST[id_anggota]'");
			$aksi->alert("Data Berhasil Disimpan!","?menu=pinjaman");
		}
	}

	// $pinjaman = $aksi->caridata("pinjaman","WHERE ");
	if (isset($_GET['edit'])) {
		$edit = $aksi->edit("pinjaman","id_pinjaman = '$_GET[id]'");
	}
	if (isset($_POST['ubah'])) {
		if ($_POST['tbesar'] > $kategori['max_pinjaman']) {
			$aksi->pesan('Maaf Pinjaman Melebihi Maksimal Pinjaman');
		}else{
			$data = array(
			'id_kategori'=>$_POST['id_kategori'],
			'besar_pinjaman'=>$_POST['tbesar']
			);
			$aksi->ubah("pinjaman",$data,"id_pinjaman='$_GET[id]'");
			$aksi->alert("Data Berhasil Di Ubah","?menu=pinjaman");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pengajuan Pinjaman</title>
</head>
<body>
<br><br>
<div class="container">	
	<div class="row"> 
		<div class="col-md-12"> 
			<div class="col-md-2"> </div>
			<div class="col-md-8">
				<form method="post">
					<div class="panel panel-default">
						<?php if (@$_GET['id']=="") {?>
							<div class="panel-heading">Pengajuan Peminjaman - Kode Pengajuan : <?php echo $nextkodepn; ?> Kode Pinjaman : <?php echo $nextkodep; ?></div>
						<?php }else{ ?>
							<div class="panel-heading">Pengajuan Peminjaman - Kode Pengajuan : <?php echo $edit['id_pengajuan'] ?> Kode Pinjaman : <?php echo $_GET['id']; ?></div>
						<?php } ?>
						<div class="panel-body">
							<?php if (@$_GET['id']=="") {?>
							<div class="form-group">
								<label>Tanggal Pengajuan</label>
								<input type="text" class="form-control" readonly name="tgl_pengajuan" value="<?php echo date('Y-m-d')?>" required>
							</div>
							<div class="form-group">
								<label>Nama Anggota</label>
								<input type="text" name="id_anggota" class="form-control" list="anggota" required>
								<datalist id="anggota">
									<?php  
										$agt = mysql_query("SELECT * FROM anggota wHERE ket != 'meminjam'");
										while ($r = mysql_fetch_array($agt)) { ?>
											<option value="<?php echo $r['id_anggota'] ?>"><?php echo $r['nama']; ?></option>
										<?php }
									?>
								</datalist>
							</div>
							<?php } ?>
							<div class="form-group">
								<label>Jenis Pinjaman</label>
								<select name="id_kategori" class="form-control" required>
									<?php 
										$namakategori = $aksi->caridata("kategori_pinjaman where id_kategori ='$edit[id_kategori]'");
										if(@$_GET['id']!=""){
									 ?>
									<option value="<?php echo @$edit['id_kategori'] ?>" selected><?php echo $namakategori['nama_pinjaman'] ?> - Maksimal Pinjaman = <?php $aksi->rupiah($namakategori['max_pinjaman']) ?></option>
									<?php } ?>
									<option></option>
									<?php  
										$jns = mysql_query("SELECT * FROM kategori_pinjaman");
										while ($a = mysql_fetch_array($jns)) { ?>
											<option value="<?php echo $a['id_kategori'] ?>"><?php echo $a['nama_pinjaman']." - Maksimal Pinjaman = ";$aksi->rupiah($a['max_pinjaman']); ?></option>
										<?php }
									?>
									
								</select>
							</div>
							<div class="form-group">
								<label>Besar Pinjaman</label>
								<input type="text" name="tbesar" value="<?php echo @$edit['besar_pinjaman'] ?>" class="form-control" required onkeypress="return event.charCode >=48 && event.charCode <=57" >
							</div>
							<div class="form-group">
								<?php if (!isset($_GET['edit'])) { ?>
									<input type="submit" name="simpan" class="btn btn-primary btn-lg" value="SIMPAN">
									<a href="?menu=pengajuan" class="btn btn-danger btn-lg" onclick="return confirm('Yakin Akan Reset Data?');">RESET</a>
								<?php }else{ ?>
									<input type="submit" name="ubah" class="btn btn-primary btn-lg" value="UBAH">
								<?php } ?>
									<a href="?menu=pinjaman" class="btn btn-success btn-lg">Lihat Data</a>

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