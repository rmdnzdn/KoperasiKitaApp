<?php 
	$table ="simpanan";

	@$i= mysql_query("SELECT * FROM $table ORDER BY id_simpanan DESC");
	@$j = mysql_fetch_array($i);
	if (@$j=="") {
		@$kode="S0001";
	}else{
		@$kd =substr($j['id_simpanan'], 1,4)+1;
		if ($kd<10) { @$kode="S000".$kd;}
		elseif($kd<100){ @$kode="S00".$kd;}
		elseif($kd<1000){ @$kode="S0".$kd;}
		else{ @$kode="S".$kd;}
	}
	
	@$alamat = "?menu=simpanan";
	@$id = $_GET['id'];
	@$where = "id_simpanan = '$id'";

	@$id_simpanan = $kode;
	@$nama_simpanan = $_POST['tnmsimpanan'];
	@$id_anggota = $_POST['tanggota'];
	@$tanggal = date("Y-m-d");
	@$besar_simpanan = $_POST['tbesar_simpanan'];
	@$ket = $_POST['tnmsimpanan'];

	@$field_simpan = array(
		'id_simpanan'=>$id_simpanan,
		'nm_simpanan'=>$nama_simpanan,
		'id_anggota'=>$id_anggota,
		'tgl_simpanan'=>$tanggal,
		'besar_simpanan'=>$besar_simpanan,
	);

	@$field_ubah = array(
		'nm_simpanan'=>$nama_simpanan,
		'id_anggota'=>$id_anggota,
		'besar_simpanan'=>$besar_simpanan,
	);

	if (isset($_POST['bsimpan'])) {
		$r = $aksi->edit("anggota","id_anggota = '$id_anggota'");
		if ($r=="") {
			$aksi->alert("Anggota Tidak ada",$alamat);
		}else{
			$aksi->simpan($table,$field_simpan);
			$aksi->alert("Data Berhasil Disimpan",$alamat);
		}
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$alamat);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_POST['bubah'])) {
		$aksi->ubah($table,$field_ubah,$where);
		$aksi->alert('Data Berhasil Diperbahrui',$alamat);
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>FORM SIMPANAN</title>
</head>
<body>
	<br><br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-3">
					<div class="panel panel-default">
						<?php if(!isset($_GET['edit'])){ ?>
							<div class="panel-heading">Tambah Simpanan</div>
						<?php }else{ ?>
							<div class="panel-heading">Ubah Simpanan</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="form-group">
									<label>ID SIMPANAN</label>
									<div class="input-group col-md-12">
										<input type="text" name="tid" class="form-control" value="<?php if(@$_GET['id']==""){ echo $kode;}else{echo @$edit['id_simpanan'];} ?>" readonly required placeholder="Masukan ID">
									</div>
								</div>
								<?php  if (@$_GET['id']=="") {?>
									<div class="form-group">
										<label>TANGGAL</label>
										<div class="input-group col-md-12">
											<input type="text" name="ttanggal" class="form-control" value="<?php @$aksi->format_tanggal(@$tanggal); ?>" readonly required placeholder="Masukan Tanggal">
										</div>
									</div>
								<?php } ?>

								<div class="form-group">
									<label>NAMA ANGGOTA</label>
									<div class="input-group col-md-12">
										<input list="anggota" name="tanggota" class="form-control" value="<?php echo @$edit['id_anggota'] ?>" required placeholder="Pilih ID Anggota">
										<datalist id="anggota">
											<?php  
												$agt = mysql_query("SELECT * FROM anggota");
												while ($r = mysql_fetch_array($agt)) { ?>
													<option value="<?php echo $r['id_anggota'] ?>"><?php echo $r['nama']; ?></option>
												<?php }
											?>
										</datalist>
									</div>
								</div>

								<div class="form-group">
									<label>JENIS SIMPANAN</label>
									<div class="input-group col-md-12">
										<select name="tnmsimpanan" id="nama_simpanan" class="form-control" onchange="uang()">
											<option value="<?php echo @$edit['nm_simpanan']; ?>" selected><?php echo @$edit['nm_simpanan']; ?></option>
											<option></option>
											<option value="Simpanan Wajib">Simpanan Wajib</option>
											<option value="Simpanan Pokok">Simpanan Pokok</option>
											<option value="Simpanan Sukarela">Simpanan Sukarela</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label>BESAR SIMPANAN</label>
									<div class="input-group col-md-12">
										<input type="text" name="tbesar_simpanan" id="besar_simpanan"  class="form-control" required onkeypress="return event.charCode >=48 && event.charCode <=57" value="<?php echo @$edit['besar_simpanan'] ?>" placeholder="Masukan Nominal" >
									</div>
								</div>

								<div class="form-group">
									<?php if (@$_GET['id']=="") {?>
										<button type="submit" name="bsimpan" class="btn btn-block btn-lg btn-primary">SIMPAN</button>
									<?php }else{ ?>
										<button type="submit" name="bubah" class="btn btn-block btn-lg btn-success">UBAH</button>
									<?php } ?>
								</div>
							</form>
						</div>
						<script type="text/javascript">
							function uang(){
								var x = document.getElementById("nama_simpanan").value;
								var y = document.getElementById("besar_simpanan");
								if (x =="Simpanan Pokok") {
									y.value = 50000;
								}else if(x == "Simpanan Wajib"){
									y.value = 30000;
								}else if(x == "Simpanan Sukarela"){
									y.value = "";
								}
							}
						</script>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>

				<!-- menampilkan data -->
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">Daftar Simpanan</div>
						<div class="panel-body">
							<form method="post">
								<div class="table table-responsive">
									<table class="table table-bordered table-striped table-hovered">
										<!-- penggunaan seach -->
										<div class="col-md-12" style="margin-bottom: 10px;">
											<div class="input-group">
												<input type="text" class="form-control" list="cari" name="tcari" placeholder="Cari Simpanan">
												<span class="input-group-btn">
													<button type="submit" name="bcari" class="btn btn-primary"><div class="glyphicon glyphicon-search"></div></button>
													<button type="submit" name="brefresh" class="btn btn-success"><div class="glyphicon glyphicon-refresh"></div>&nbsp;Refresh</button>
												</span>
											</div>
										</div>

										<!-- tampil data ke tabel -->
										<thead>
											<tr>
												<th width="5%">No.</th>
												<th>NAMA ANGGOTA</th>
												<th>TANGGAL SIMPANAN</th>
												<th>JENIS SIMPANAN</th>
												<th>BESAR SIMPANAN</th>
												<th colspan="2" width="5%"><center>AKSI</center></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php  
													$a=$aksi->tampil($table,"","");
													$no=0;
													if ($a=="") {
														$aksi->norecord(7);
													}else{
														foreach ($a as $data) {
															$id_smp = $data[0];
															$id_agt = $data[2];
															$tgl_smp = $data[3];
															$jns_smp = $data[1];
															$bsr_smp = $data[4];
															$no++;
														?>
													<td><?php echo $no; ?>.</td>
													<td>
														<?php 
														$i = mysql_query("SELECT * FROM anggota WHERE id_anggota='$id_agt'");
														while ($j=mysql_fetch_array($i)) {
														 	echo $j['nama'];
														 } ?>
													</td>
													<td><?php $aksi->format_tanggal($tgl_smp); ?></td>
													<td><?php echo $jns_smp; ?></td>
													<td><?php $aksi->rupiah($bsr_smp); ?></td>
													<td><a href="?menu=simpanan&hapus&id=<?php echo $id_smp ?>" onclick="return confirm('Anda akan menghapus data tersebut ?')"><center><span class="glyphicon glyphicon-trash"></span></center></a></td>
													<td><a href="?menu=simpanan&edit&id=<?php echo $id_smp ?>"><center><span class="glyphicon glyphicon-edit"></span></center></a></td>
											</tr>
												<?php }}?>
										</tbody>
									</table>
								</div>
							</form>
						</div>
						<div class="panel-footer"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>