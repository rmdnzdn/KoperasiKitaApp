<?php  
	$table = "anggota";

	$i = mysql_query("SELECT * FROM $table ORDER BY id_anggota DESC");
	$j = mysql_fetch_array($i);
	if ($j=="") {
		$kode = "A0001";
	}else{
		$kd=substr($j['id_anggota'], 1,4)+1;
		if($kd<10){$kode="A000".$kd;}
		elseif($kd<100){$kode="A00".$kd;}
		elseif($kd<100){$kode="A00".$kd;}
		else{$kode="A".$kd;}
	}

	@$alamat = "?menu=anggota";
	@$id = $_GET['id'];
	@$where = "id_anggota = '$id'";

	@$id_anggota = $kode;
	@$nama = $_POST['tnama'];
	@$alamat_anggota = $_POST['talamat'];
	@$tanggal = $_POST['ttgl'];
	@$tempat = $_POST['ttempat'];
	@$jk= $_POST['tjk'];
	@$status = $_POST['tstatus'];
	@$nohp = $_POST['tnohp'];

	@$field_simpan = array(
		'id_anggota'=>$id_anggota,
		'nama'=>$nama,
		'alamat'=>$alamat_anggota,
		'tgl_lhr'=>$tanggal,
		'tmp_lhr'=>$tempat,
		'jk'=>$jk,
		'status'=>$status,
		'no_tlp'=>$nohp,
		'saldo'=>0
	);

	@$field_ubah = array(
		'nama'=>$nama,
		'alamat'=>$alamat_anggota,
		'tgl_lhr'=>$tanggal,
		'tmp_lhr'=>$tempat,
		'jk'=>$jk,
		'status'=>$status,
		'no_tlp'=>$nohp,
	);

	if (isset($_POST['bsimpan'])) {
		$aksi->simpan($table,$field_simpan);
		$aksi->alert("Data Berhasil Disimpan",$alamat);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
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
	<title>FORM ANGGOTA</title>
</head>
<body>
<br><br><br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<?php if(!isset($_GET['edit'])){ ?>
				<div class="panel-heading">Tambah Anggota</div>
				<?php }else{ ?>
				<div class="panel-heading">Ubah Anggota</div>
				<?php } ?>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label>ID ANGGOTA</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tid" class="form-control" required readonly placeholder="Masukan ID" maxlength="" value="<?php if(@$_GET['id']){echo @$edit['id_anggota'];}else{ echo $kode;} ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>NAMA</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tnama" class="form-control" required placeholder="Masukan Nama" maxlength="30" value="<?php echo @$edit['nama']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>JENIS KELAMIN</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<select class="form-control" name="tjk" required>
									<?php if($edit['jk']=="L"){$gen = "LAKI-LAKI";}elseif($edit['jk']=="P"){$gen="PEREMPUAN";} ?>
									<option value="<?php echo $gen ?>"><?php echo @$gen;; ?></option>
									<option></option>
									<option value="L">LAKI-LAKI</option>
									<option value="P">PEREMPUAN</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>TEMPAT LAHIR</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="ttempat" class="form-control" required placeholder="Masukan Tempat Lahir" maxlength="30" value="<?php echo @$edit['tmp_lhr']; ?>">
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
								<textarea name="talamat" placeholder="Masukan Alamat" class="form-control" required><?php echo @$edit['alamat']; ?></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>NO.HANDPHONE</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<input type="text" name="tnohp" class="form-control" onkeypress="return event.charCode>=48 && event.charCode <=57 " required placeholder="Masukan No.HP" maxlength="15" value="<?php echo @$edit['no_tlp']; ?>">
							</div>
						</div>
					</div>

					<div class="form-group">
						<label>STATUS</label>
						<div class="form-group">
							<div class="input-group col-md-12">
								<select class="form-control" name="tstatus" required>
									<option value="<?php echo @$edit['status']; ?>" selected><?php echo @$edit['status']; ?></option>
									<option></option>
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
				<div class="panel-heading">Daftar Data Anggota</div>
				<div class="panel-body">
					<form method="post">
						<div class="table table-responsive">
							<table class="table table-bordered table-striped table-hovered">
								<!--  penggunaan searh -->
								<div class="col-md-12" style="margin-bottom: 10px;">
									<div class="input-group">
										<input type="text" name="tcari" placeholder="Cari Anggota" class="form-control">
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
										<th width="15%">Nama</th>
										<th>Alamat</th>
										<th width="5%">JK</th>
										<th>No.HP</th>
										<th>Saldo</th>
										<th>Status</th>
										<th>Keterangan</th>
										<th colspan="2" width="5%"><center>AKSI</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php
											$a = $aksi->tampil($table,"","");
											$no = 0;
											if ($a=="") {
												$aksi->norecord(11);
											}else{
												foreach ($a as $data) {
													$id_agt = $data[0];
													$nm_agt = $data[1];
													$ala_agt = $data[2];
													$jk_agt = $data[5];
													$no_agt = $data[7];
													$saldo = $data[9];
													$sts = $data[6];
													$ket_agt = $data[8];
													$no++;
													?>
														<td><?php 	echo $no; ?></td>
														<td><?php 	echo $id_agt; ?></td>
														<td><?php 	echo $nm_agt; ?></td>
														<td><?php 	echo $ala_agt; ?></td>
														<td><?php 	echo $jk_agt; ?></td>
														<td><?php 	echo $no_agt; ?></td>
														<td><?php 	echo $saldo; ?></td>
														<td><?php 	echo $sts; ?></td>
														<td><?php 	echo $ket_agt; ?></td>
														<td><a href="?menu=anggota&hapus&id=<?php echo $id_agt;?>" onclick="return confirm('Anda akan menghapus data tersebut ?')"><center><span class="glyphicon glyphicon-trash"></span></center></a></td>
										<td><a href="?menu=anggota&edit&id=<?php echo $id_agt; ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
									</tr>
									<?php }}	?>	
										
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