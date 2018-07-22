<?php 	 
	$table = "petugas"; 

	$i = mysql_query("SELECT * FROM $table ORDER BY id_petugas DESC");
	$j = mysql_fetch_array($i);
	if ($j=="") {
		$kode ="P0001";
	}else{
		$kd = substr($j['id_petugas'], 1,4)+1;
		if($kd<10){$kode="P000".$kd;}
		elseif($kd<100){$kode="P00".$kd;}
		elseif($kd<1000){$kode="P0".$kd;}
		else{$kode="P".$kd;}
	}

	@$alamat = "?menu=petugas";
	@$id = $_GET['id'];
	@$where = "id_petugas = '$id'";

	@$id_petugas = $kode;
	@$nama = $_POST['tnama'];
	@$alamat_petugas = $_POST['talamat'];
	@$nohp = $_POST['tnohp'];
	@$tempat = $_POST['ttempat'];
	@$tanggal = $_POST['ttgl'];
	@$ket = $_POST['tket'];
	@$user = $_POST['tuser'];
	@$pass = $_POST['tpass'];
	@$akses = $_POST['takses'];

	@$field_simpan = array(
		'id_petugas'=>$id_petugas,
		'nama'=>$nama,
		'alamat'=>$alamat_petugas,
		'no_tlp'=>$nohp,
		'tmp_lhr'=>$tempat,
		'tgl_lhr'=>$tanggal,
		'ket'=>$ket,
		'username'=>$user,
		'password'=>$pass,
		'akses'=>$akses
	);

	@$field_ubah = array(
		'nama'=>$nama,
		'alamat'=>$alamat_petugas,
		'no_tlp'=>$nohp,
		'tmp_lhr'=>$tempat,
		'tgl_lhr'=>$tanggal,
		'ket'=>$ket,
		'username'=>$user,
		'password'=>$pass,
		'akses'=>$akses
	);

	if (isset($_POST['bsimpan'])) {
		$r = $aksi->edit($table,"username = '$user' && akses == '$akses'");
		if ($r=="") {
			$aksi->simpan($table,$field_simpan);
			$aksi->alert("Data Berhasil Disimpan",$alamat);
		}else{
			$aksi->alert("Username Sudah ada",$alamat);
		}
	}

	if (isset($_GET['edit'])) {
		@$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$alamat);
	}

	if (isset($_POST['bubah'])) {
		$aksi->ubah($table,$field_ubah,$where);
		$aksi->alert("Data Berhasil Diperbaharui",$alamat);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>FORM PETUGAS</title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<?php if(!isset($_GET['edit'])){ ?>
				<div class="panel-heading">Tambah Petugas</div>
				<?php }else{ ?>
				<div class="panel-heading">Ubah Petugas</div>
				<?php } ?>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label>ID PETUGAS</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tid" class="form-control" required readonly placeholder="Masukan ID" maxlength="" value="<?php if(@$_GET['id']){echo @$edit['id_petugas'];}else{ echo $kode;} ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>USERNAME</label>
						<div class="input-group col-md-12">
							<input type="text" name="tuser" class="form-control" required placeholder="Masukan Username" maxlength="30" value="<?php echo @$edit['username'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label>PASSWORD</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="password" name="tpass" class="form-control" required placeholder="Masukan Password" maxlength="30" value="<?php echo @$edit['password'] ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>AKSES</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<select class="form-control" name="takses" required>
									<option value="<?php echo @$edit['akses']; ?>" selected><?php echo @$edit['akses']; ?></option>
									<option></option>
									<option value="PETUGAS">PETUGAS</option>
									<option value="KEPALA PETUGAS">KEPALA PETUGAS</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>NAMA</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tnama" class="form-control" required placeholder="Masukan Nama" maxlength="30" value="<?php echo @$edit['nama'] ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>TEMPAT LAHIR</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="ttempat" class="form-control" required placeholder="Masukan Tempat Lahir" maxlength="30" value="<?php echo @$edit['tmp_lhr'] ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>TANGGAL LAHIR</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="date" name="ttgl" class="form-control" value="<?php echo @$edit['tgl_lhr'] ?>" placeholder="Masukan Tanggal" required>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>ALAMAT</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<textarea name="talamat" placeholder="Masukan Alamat" class="form-control" required><?php echo @$edit['alamat'] ?></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>NO.HANDPHONE</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tnohp" class="form-control" onkeypress="return event.charCode>=48 && event.charCode <=57 " required placeholder="Masukan No.HP" maxlength="15" value="<?php echo @$edit['no_tlp'] ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>KETERANGAN</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<select class="form-control" name="tket" required>
									<option value="AKTIF">AKTIF</option>
									<option value="TIDAK AKTIF">TIDAK AKTIF</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<?php if(@$_GET['id']==""){ ?>
							<button type="submit" name="bsimpan" class="btn btn-lg btn-primary btn-block">SIMPAN
						<?php }else{ ?>
							<button type="submit" name="bubah" class="btn btn-lg btn-success btn-block">UBAH
						<?php } ?>
						</button>
					</div>
				</form>
			</div>
			</div>
		</div>

		<!-- tampil data -->
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Daftar Data Petugas</div>
				<div class="panel-body">
					<form method="post">
						<div class="table table-responsive">
							<table class="table table-bordered table-striped table-hovered">
								<!--  penggunaan searh -->
								<div class="col-md-12" style="margin-bottom: 10px;">
									<div class="input-group">
										<input type="text" name="tcari" placeholder="Cari Petugas" class="form-control">
										<span class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><div class="glyphicon glyphicon-search"></div></button>
											<button type="submit" name="brefresh" class="btn btn-success"><div class="glyphicon glyphicon-refresh"></div>&nbsp;Refesh</button>
										</span>
									</div>
								</div>

								<!-- menampilkan data -->
								<thead>
									<tr>
										<th width="5%">No.</th>
										<th width="10%">ID</th>
										<th>US</th>
										<th>Akses</th>
										<th width="15%">Nama</th>
										<th>Tempat Lahir</th>
										<th width="12%">Tanggal Lahir</th>
										<th>Alamat</th>
										<th>No.HP</th>
										<th>KET</th>
										<th colspan="2" width="5%"><center>AKSI</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php 	
											$a = $aksi->tampil($table,"","");
											$no =0;
											if ($a=="") {
												$aksi->norecord(11);
											}else{
												foreach ($a as $data) {
													$id_pet = $data[0];
													$us_pet = $data[7];
													$nm_pet = $data[1];
													$tmp_pet = $data[4];
													$tgl_pet = $data[5];
													$ala_pet = $data[2];
													$no_pet = $data[3];
													$ket_pet = $data[6];
													$no++;
													?>

												<td><?php echo $no; ?></td>
												<td><?php echo $id_pet; ?></td>
												<td><?php echo $us_pet; ?></td>
												<td><?php echo $data['akses']; ?></td>
												<td><?php echo $nm_pet; ?></td>
												<td><?php echo $tmp_pet; ?></td>
												<td><?php $aksi->format_tanggal($tgl_pet);?></td>
												<td><?php echo $ala_pet; ?></td>
												<td><?php echo $no_pet; ?></td>
												<td><?php echo $ket_pet; ?></td>
												<td><a href="?menu=petugas&hapus&id=<?php echo $id_pet; ?>" onclick="return confirm('Anda akan menghapus data tersebut ?')"><center><span class="glyphicon glyphicon-trash"></span></center></a></td>
												<td><a href="?menu=petugas&edit&id=<?php echo $id_pet; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
											</tr>
								<?php }}?>
								</tbody>
							</table>
						</div>
					</form>
				</div>
				<div class="panel-footer">&nbsp;</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>