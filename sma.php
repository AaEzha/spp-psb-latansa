<?php tabel();
if(!isset($_GET['tipe'])){
	// daftar siswa SMA
?>
<h2>Daftar Santri SMA <small>| <a class="btn btn-xs btn-primary" href="?hal=sma&tipe=input">Input Santri Baru</a></small></h2>
<table class="table" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Nama</th>
			<th class="col-lg-2 text-center">Jenis Kelamin</th>
			<th class="col-lg-3 text-center">#</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$q = mysql_query("select * from siswa where jenis='sma'");
		$no = 1;
		while($d = mysql_fetch_object($q)){
		?>
		<tr>
			<td class="text-center">#</td>
			<td><?php echo $d->namasiswa;?></td>
			<td class="text-center"><?php $jk=($d->jk=='pa') ? 'Putra' : 'Putri'; echo $jk; ?></td>
			<td class="text-center"><a href="?hal=sma&tipe=input&id=<?php echo $d->idsiswa; ?>" class="btn btn-xs btn-success">ubah</a> <a href="?hal=bayar1&tipe=sma&id=<?php echo $d->idsiswa; ?>" class="btn btn-xs btn-warning">pembayaran 1</a> <a href="?hal=bayar2&tipe=sma&id=<?php echo $d->idsiswa; ?>" class="btn btn-xs btn-danger">pembayaran 2</a></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>
<?php
}else{
	$tipe = $_GET['tipe'];

	switch ($tipe) {
		case 'input':
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$q = mysql_query("select * from siswa where idsiswa='$id'");
			$n = mysql_num_rows($q);
			if($n==1){
				$d = mysql_fetch_object($q);
			}

			if(isset($_POST['namasiswa'])){
				$namasiswa = mysql_real_escape_string($_POST['namasiswa']);
				$jk = $_POST['jk'];
				// input
				mysql_query("update siswa set namasiswa='$namasiswa',jk='$jk' where idsiswa='$id'") or die('Gagal input');
				eksyen('','?hal=sma');
			}
		}else{
			if(isset($_POST['namasiswa'])){
				$namasiswa = mysql_real_escape_string($_POST['namasiswa']);
				$jk = $_POST['jk'];
				// input
				mysql_query("insert into siswa(namasiswa,jk,jenis) values('$namasiswa','$jk','sma')") or die('Gagal input');
				eksyen('','?hal=sma');
			}
		}
?>
<h2>Input/Edit Santri SMA <small>| <a class="btn btn-xs btn-primary" href="?hal=sma">Kembali</a></small></h2>
<form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="input" class="col-sm-2 control-label">Nama Santri:</label>
			<div class="col-sm-10">
				<input type="text" name="namasiswa" id="input" class="form-control" placeholder="Nama Santri" value="<?php if(isset($_GET['id'])){echo $d->namasiswa;} ?>" required="required">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-2 control-label">Jenis Kelamin:</label>
			<div class="col-sm-10">
				<select name="jk" id="input" class="form-control">
					<option value="pa"<?php if(isset($_GET['id'])){ selects('pa',$d->jk); } ?> />Putra</option>
					<option value="pi"<?php if(isset($_GET['id'])){ selects('pi',$d->jk); } ?> />Putri</option>
				</select>
			</div>
		</div>
		

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<button type="submit" class="btn btn-success">Simpan</button>
			</div>
		</div>
</form>
<?php
			break;

		case 'pembayaran':
			# code...
			break;
		
		default:
			# code...
			break;
	}
}
?>