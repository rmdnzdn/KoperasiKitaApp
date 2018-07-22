<?php  
	$table = "kategori_pinjaman";

	$i = mysql_query("SELECT * FROM $table ORDER BY id_kategori DESC");
	$j = mysql_fetch_array($i);

	if ($j=="") {
		$kode="K0001";
	}else{
		$kd = substr($j['id_kategori'], 1,4)+1;
		if($kd<10){$kode="K000".$kd;}
		elseif($kd<100){$kode="K00".$kd;}
		elseif($kd<1000){$kode="K0".$kd;}
		else{$kode="K".$kd;}
	}
	@$alamat="?menu=kategori";
	@$id = $_GET['id'];
	@$where = "id_kategori='$id'";

	@$id_kategori = $kode;
	@$nama_pinjaman = $_POST['tkategori'];
	@$max_pinjaman = $_POST['tmax'];

	$field_simpan = array(
		'id_kategori'=>$id_kategori,
		'nama_pinjaman'=>$nama_pinjaman,
		'max_pinjaman'=>$max_pinjaman
	);
	$field_ubah = array('nama_pinjaman' => $nama_pinjaman,'max_pinjaman'=>$max_pinjaman);

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
		$aksi->alert("Data Berhasil Diubah",$alamat);
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>KATEGORI PINJAMAN</title>
</head>
<body>
<br><br><br><br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<div class="col-md-3"></div>	
			<div class="col-md-6">
				<div class="panel panel-default">		
					<?php if(!isset($_GET['edit'])){ ?>
						<div class="panel-heading">Tambah Kategori Pinjaman
					<?php }else{ ?>
						<div class="panel-heading">Ubah Pinjaman
					<?php } ?>
					</div>
					<div class="panel-body">
						<form method="post">	
							<div class="form-group">
								<label>NAMA PINJAMAN</label>
								<input type="text" name="tkategori" class="form-control" placeholder="Masukan Nama Pinjaman" autofocus tabindex="0" autocomplete="off" required maxlength="25" value="<?php echo @$edit['nama_pinjaman']; ?>"> 
							</div>
							<div class="form-group">
								<label>MAKSIMAL PINJAM</label>
								<input type="text" name="tmax" class="form-control" onkeypress="return event.charCode >=48 && event.charCode <=57" placeholder="Masukan Maksimal Besar Pinjaman" autofocus tabindex="0" autocomplete="off" required maxlength="25" value="<?php echo @$edit['max_pinjaman']; ?>" > 
							</div>
							<div class="form-group">
								<?php  
									if (@$_GET['id']=="") { ?>
										<button type="submit" name="bsimpan" class="btn btn-primary btn-block btn-lg" tabindex="0">SIMPAN
									<?php }else{ ?>
										<button type="submit" name="bubah" class="btn btn-success btn-block btn-lg" tabindex="0">UBAH
									<?php }?>
									</button>
							</div>
						</form>
					</div>	
					<div class="panel-footer">&nbsp;</div>
				</div>
			</div>	
		</div>
		</div>
		<br>
		<!-- ini tampil data -->
		<div class="col-md-12">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Daftar Kategori Pinjamanan</div>
					<div class="panel-body">
						<form method="post">
							<div class="table table-responsive" style="margin-top:10px;">	
							<table class="table table-bordered table-hover table-striped">
								<!-- penggunaan search -->
								<div class="col-md-12" style="margin-bottom: 10px;">
									<div class="input-group">
										<input type="text" name="tcari"  value="" class="form-control" placeholder="Cari Kategori Pinjaman">
										<span class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><div class="glyphicon glyphicon-search"></div></button>
											<button type="submit" name="brefresh" class="btn btn-success"><div class="glyphicon glyphicon-refresh"></div>Refresh</button>
										</span>
									</div>
								</div>
								<thead>
									<tr>
										<td width="6%">No.</td>
										<td width="20%">ID KATEGORI</td>
										<td>NAMA PINJAMAN</td>
										<td>MAKSIMAL PINJAM</td>
										<th colspan="2" width="5%"><center>AKSI</center></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php  
											$a = $aksi->tampil($table,"","");
											$no = 0;
											if ($a=="") {
												$aksi->norecord(5);
											}else{
												foreach ($a as $data) {
													$id_kat = $data[0]; 
													$nm_kat = $data[1];
													$max_pinjam = $data[2];
													$no++;
													?>

													<td><?php echo $no; ?></td>
													<td><?php echo $id_kat; ?></td>
													<td><?php echo $nm_kat; ?></td>
													<td><?php $aksi->rupiah($max_pinjam); ?></td>
													<td><a href="?menu=kategori&hapus&id=<?php echo $id_kat; ?>" onclick="return confirm('Anda akan menghapus data tersebut ?')"><center><span class="glyphicon glyphicon-trash"></span></center></a></td>
													<td><a href="?menu=kategori&edit&id=<?php echo $id_kat;?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>

									</tr>
										<?php }}?>
								</tbody>
							</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>