<!DOCTYPE html>
<html>
<head>
	<title>ANGSURAN</title>
</head>
<body>
	<br> <br> <br> <br> 
	<div class="container">
		<div class="row"> 
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Data Angsuran</div>
					<div class="panel-body">
					<form method="post">
						<div class="form-group col-md-5">
							<label>Nama Anggota</label>
							<div class="input-group pull-left">
								<input type="text" name="id_anggota" class="form-control" list="anggota" required>
								<datalist id="anggota">
									<?php  
										$agt = mysql_query("SELECT * FROM anggota");
										while ($r = mysql_fetch_array($agt)) { ?>
											<option value="<?php echo $r['id_anggota'] ?>"><?php echo $r['nama']; ?></option>
										<?php }
									?>
								</datalist>
								<div class="input-group-btn">
									<input type="submit" name="cari" value="CARI" class="btn btn-primary" >
								</div>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>