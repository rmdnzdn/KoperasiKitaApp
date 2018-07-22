<br><br><br>
<?php  
	@$id_pinjaman = $_GET['id'];
	@$pinjaman = $aksi->caridata("pinjaman WHERE id_pinjaman = '$id_pinjaman'");
	if (isset($_GET['hapus'])) {
		$aksi->hapus("pengajuan","id_pengajuan = '$pinjaman[id_pengajuan]'");
		$aksi->ubah("anggota",array('ket'=>""),"id_anggota = '$pinjaman[id_anggota]'");
		$aksi->hapus("pinjaman","id_pinjaman = '$id_pinjaman'");
		$aksi->alert("Data Berhasil Dihapus","?menu=pinjaman");
	}
?>
<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
	<br>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">Data Pinjaman</div>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="pull-left col-md-3">
										<a href="?menu=pengajuan" class="btn btn-primary btn-block btn-lg">Ajukan Pinjaman</a>
									</div>
									<div class="input-group col-md-6 pull-right">
										<input type="text" class="form-control" name="tcari" placeholder="Cari Berdasarkan Nama....." >
										<div class="input-group-btn">
											<button type="submit" class="btn btn-primary">CARI</button>
											<button type="submit" class="btn btn-success">REFRESH</button>
										</div>
									</div>
								</div>
							</form>
							<br>
							<br>
							<br>
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<thead>
											<th>No.</th>
											<th>ID Pinjaman</th>
											<th>Nama</th>
											<th>Nama Pinjaman</th>
											<th>Besar Pinjaman</th>
											<th>Tanggal Pengajuan</th>
											<th>Ket</th>
											<th>Aksi</th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												if (isset($_POST['tcari'])) {
													@$cari = "AND nama like '%$_POST[tcari]%";
												}
												@$sql = mysql_query("SELECT pinjaman.*,nama,nama_pinjaman from pinjaman INNER JOIN anggota ON anggota.id_anggota = pinjaman.id_anggota INNER JOIN kategori_pinjaman ON kategori_pinjaman.id_kategori = pinjaman.id_kategori WHERE pinjaman.ket != 'lunas' $cari");
												$cek = mysql_num_rows($sql);
												if ($cek <="") {
													$aksi->norecord("8");
												}else{
													while ($data = mysql_fetch_array($sql)) {
														$no++;
												?>
													<tr>
														<td><?php echo $no;; ?></td>
														<td><?php echo $data['id_pinjaman']; ?></td>
														<td><?php echo $data['nama']; ?></td>
														<td><?php echo $data['nama_pinjaman']; ?></td>
														<td><?php $aksi->rupiah($data['besar_pinjaman']); ?></td>
														<td><?php $aksi->format_tanggal($data['tgl_pengajuan_pinjaman']); ?></td>
														<td><?php echo $data['ket']; ?></td>
														<td>
														<?php  
															if ($data['ket']=="Lengkapi Persyaratan" || $data['ket']=="Pending") { ?>
															<a href="?menu=syarat&id_pinjaman=<?php echo $data['id_pinjaman'] ?>" class="btn btn-primary">Lengkapi Persyaratan</a>
															<a href="?menu=pengajuan&edit&id=<?php echo $data['id_pinjaman'] ?>" class="btn btn-success">Edit</a>
															<a href="?menu=pinjaman&hapus&id=<?php echo $data['id_pinjaman']; ?>" class="btn btn-danger">Hapus</a>
														<?php }elseif($data['ket']=="Disetujui"){?>
															<a href="?menu=acc&id=<?php $data['id_pinjaman']?>" class="btn btn-primary">Tindak Lanjut</a>
														<?php }elseif($data['ket']=="Meminjam"){?>
															<a href="#" class="btn btn-primary">Bayar Angsuran</a>		
														<?php } ?>
														</td>
													</tr>
													<?php }} ?>
										</tbody>
									</table>
								</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>