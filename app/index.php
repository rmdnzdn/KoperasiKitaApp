<?php 	 
	include 'config/koneksi.php';
	@$usename = $_POST['tusername'];
	@$password= $_POST['tpassword'];
	@$hak_akses = $_POST['hak_akses'];

	if (isset($_POST['blogin'])) {
		
		echo "<script>alert('Berhasil LOGIN');document.location.href='petugas/'</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>KOPERASI KITA</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.svg">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6" style="margin-top: 120px;">
				<div class="panel panel-default">
					<div class="panel-heading" style="padding: 20px;font-size: 25px;"><center>KOPERASI KITA</center></div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<div class="input-group col-md-12" style="margin: 10px 5px;">
									<label>USERNAME</label>
									<input type="text" name="tuser" id="tuser" required class="form-control">
								</div>						
							</div>
							<div class="form-group">
								<div class="input-group col-md-12" style="margin: 10px 5px;">
									<label>PASSWORD</label>
									<input type="password" name="tpass" id="tpass" required class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group col-md-12" style="margin: 10px 5px;">
									<label>AKSES</label>
									<select class="form-control" name="takses" required>
										<option></option>
										<option value="PETUGAS">PETUGAS</option>
										<option value="KEPALA PETUGAS">KEPALA PETUGAS</option>
									</select>
								</div>
							</div>
							<button type="submit" name="blogin" class="btn btn-primary btn-lg btn-block">LOGIN</button>		
						</form>
					</div>
					<div class="panel-footer"><center>&copy;<?php echo date('Y'); ?>&nbsp; - &nbsp;Muhammad Ramdan</center></div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>