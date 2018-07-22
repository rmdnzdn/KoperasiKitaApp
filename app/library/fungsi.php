<?php  
	class oop{

		function caridata($table)
		{
			@$sql = "select * from $table";
			@$tampung = mysql_fetch_array(mysql_query($sql));
			return $tampung;
		}

		function cekdata($table)
		{
			@$sql = "select * from $table";
			@$tampung = mysql_num_rows(mysql_query($sql));
			return $tampung;
		}

		function simpan($table,array $field){
			$sql = "INSERT INTO $table SET";
				foreach ($field as $key => $value) {
					$sql.=" $key = '$value',";
				}
			$sql = rtrim($sql, ',');
			$jalan = mysql_query($sql);
		}

		function tampil($table,$cari,$urut){
			$sql = "SELECT * FROM $table $cari $urut";
			$tampil = mysql_query($sql);
			while($data = mysql_fetch_array($tampil))
				@$isi[] = $data;
				return @$isi;
		}


		function hapus($table,$where){
			$sql = "DELETE FROM $table WHERE $where";
			 mysql_query($sql);
		}

		function edit($table,$where){
			$sql = "SELECT * FROM $table WHERE $where";
			$jalan = mysql_fetch_array(mysql_query($sql));
			return $jalan;
		}

		function ubah($table,array $field,$where){
			$sql = "UPDATE $table SET";
			foreach ($field as $key => $value) {
				$sql.=" $key = '$value',";
			}
			$sql = rtrim($sql, ',');
			$sql.="WHERE $where";
			mysql_query($sql);
		}

		function alert($pesan,$alamat){
			echo "<script>alert('$pesan');document.location.href='$alamat'</script>";
		}

		function alamat($redirect){
			echo "<script>document.location.href='$redirect';</script>";
		}

		function pesan($pesan){
			echo "<script>alert('$pesan');</script>";
		}

		function norecord($col){
			echo "<tr><td colspan='$col' align='center'>Data Tidak Ada !!!</td></tr>";
		}

		function rupiah($uang){
			echo "Rp. ".number_format($uang,0,',','.').',-';
		}

		function upload($tempat){
			@$alamatfile = $_FILES['foto']['tmp_name'];
			@$namafile = $_FILES['foto']['name'];
			move_uploaded_file($alamatfile,"$tempat/$namafile");
			return $namafile;
		}

		function bulan($ke){
			switch ($ke) {
				case '01': echo "Januari"; break;
				case '02': echo "Februari"; break;
				case '03': echo "Maret"; break;
				case '04': echo "April"; break;
				case '05': echo "Mei"; break;
				case '06': echo "Juni"; break;
				case '07': echo "Juli"; break;
				case '08': echo "Agustus"; break;
				case '09': echo "September"; break;
				case '10': echo "Oktober"; break;
				case '11': echo "Nopember"; break;
				case '12': echo "Desember"; break;
			}
		}

		function format_tanggal($tanggal){
			@$thn = substr($tanggal,0,4);
			@$bln = substr($tanggal,5,2);
			@$tgl = substr($tanggal,8,2);
				switch ($bln) {
				case '01': $bulan = "Januari"; break;
				case '02': $bulan = "Februari"; break;
				case '03': $bulan = "Maret"; break;
				case '04': $bulan = "April"; break;
				case '05': $bulan = "Mei"; break;
				case '06': $bulan = "Juni"; break;
				case '07': $bulan = "Juli"; break;
				case '08': $bulan = "Agustus"; break;
				case '09': $bulan = "September"; break;
				case '10': $bulan = "Oktober"; break;
				case '11': $bulan = "Nopember"; break;
				case '12': $bulan = "Desember"; break;
			}
			echo $tgl." ".@$bulan." ".$thn;
		}
	}
?>