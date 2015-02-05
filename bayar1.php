<h1>Pembayaran #1</h1>

<?php
if(!isset($_GET['id']) or !isset($_GET['tipe'])){eksyen('','.');}

if($_GET['tipe']!='smp'){
	if($_GET['tipe']!='sma'){
		eksyen('','.');
	}
}

// Detail Siswa
$id = $_GET['id'];
$jk = getdata($id,'siswa','idsiswa','jk');
$sekolah = getdata($id,'siswa','idsiswa','jenis');
$namasiswa = getdata($id,'siswa','idsiswa','namasiswa');
$tipe = $_GET['tipe'];

	// Jika Jenis Sekolah tidak sesuai dengan data siswa
	if($sekolah!=$tipe){eksyen('Error!',"?hal=$sekolah");}

// Detail Pembayaran diambil dari tabel bendahara1
$q = mysql_query("select * from bendahara1");
$d = mysql_fetch_object($q);

// Detail Pembayaran #1 diambil dari tabel bta1
$q1 = mysql_query("select * from bta1 where idsiswa='$id'");
$nq1 = mysql_num_rows($q1);
if($nq1>=1){
	$d1 = mysql_fetch_object($q1);
	$total1 = $d1->total;
	$sisa1 = $d1->sisa;
}else{
	$total1 = 0;
	$sisa1 = 0;
}

// Jika Pa
if($jk=='pa'){
	if($tipe=='smp'){
		$totalharusdibayar = $d->total_pa_sd;
	}elseif($tipe=='sma'){
		$totalharusdibayar = $d->total_pa_smp;
	}else{
		eksyen('Error!',"?hal=$sekolah");
	}
}

// Jika Pi
if($jk=='pi'){
	if($tipe=='smp'){
		$totalharusdibayar = $d->total_pi_sd;
	}elseif($tipe=='sma'){
		$totalharusdibayar = $d->total_pi_smp;
	}else{
		eksyen('Error!',"?hal=$sekolah");
	}
}

if(isset($_POST['pangkal'])){
	$pangkal = mysql_real_escape_string($_POST['pangkal']);
	$spp = mysql_real_escape_string($_POST['spp']);
	$buku_smp = mysql_real_escape_string($_POST['buku_smp']);
	$buku_ext = mysql_real_escape_string($_POST['buku_ext']);
	$kaospa = mysql_real_escape_string($_POST['kaospa']);
	$kaospi = mysql_real_escape_string($_POST['kaospi']);
	$osis = mysql_real_escape_string($_POST['osis']);
	$osispi = mysql_real_escape_string($_POST['osispi']);
	$jubah = mysql_real_escape_string($_POST['jubah']);	
	$lemari = mysql_real_escape_string($_POST['lemari']);
	$kalender = mysql_real_escape_string($_POST['kalender']);
	$ramadhan = mysql_real_escape_string($_POST['ramadhan']);
	$kasur = mysql_real_escape_string($_POST['kasur']);
	$tawab = mysql_real_escape_string($_POST['tawab']);

	// Jika Pa
	if($jk=='pa'){
		if($tipe=='smp'){
			$buku = $buku_smp;
			$total = $pangkal + $spp + $buku_smp + $kaospa + $osis + $jubah + $lemari + $kalender + $ramadhan + $kasur + $tawab;
		}elseif($tipe=='sma'){
			$buku = $buku_ext;
			$total = $pangkal + $spp + $buku_ext + $kaospa + $osis + $jubah + $lemari + $kalender + $ramadhan + $kasur + $tawab;
		}else{
			eksyen('Error!',"?hal=$sekolah");
		}
		$kaos = $kaospa;
	}

	// Jika Pi
	if($jk=='pi'){
		if($tipe=='smp'){
			$buku = $buku_smp;
			$total = $pangkal + $spp + $buku_smp + $kaospi + $osispi + $lemari + $kalender + $ramadhan + $kasur + $tawab;
		}elseif($tipe=='sma'){
			$buku = $buku_ext;
			$total = $pangkal + $spp + $buku_ext + $kaospi + $osispi + $lemari + $kalender + $ramadhan + $kasur + $tawab;
		}else{
			eksyen('Error!',"?hal=$sekolah");
		}
		$kaos = $kaospi;
		$jubah = 0;
	}
	
	// PENGHITUNGAN SISA 
	$_total = $_POST['total'];
	$sisa = $_total - $total;

	mysql_query("insert into bta1(idsiswa,pangkal,spp,buku,kaos,osis,jubah,lemari,kalender,ramadhan,kasur,tawab,total,sisa) values('$id','$pangkal','$spp','$buku','$kaos','$osis','$jubah','$lemari','$kalender','$ramadhan','$kasur','$tawab','$total','$sisa')") or die("Gagal input");
	eksyen('',"?hal=bayar1&tipe=$sekolah&id=$id");
}
?>

<?php if($nq1<1){ ?>
<div class="panel panel-default">
	  <div class="panel-heading">
			<h3 class="panel-title">Detail Pembayaran</h3>
	  </div>
	  <div class="panel-body">
	  	Nama Santri : <?php echo $namasiswa;?> (<?php echo strtoupper($sekolah);?> <?php echo $jeka=($jk=='pa')?'Putra':'Putri';?>)<br>
			Total Yang Harus Dibayar : Rp.<?php echo number_format($totalharusdibayar,'0',',','.');?><br>
			Total Yang Telah Dibayar : Rp.<?php echo number_format($total1,'0',',','.');?><br>
			Sisa Yang Harus Dibayar : Rp.<?php echo number_format($sisa1,'0',',','.');?><br>
	  </div>
</div>
<form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<legend>Form Pengaturan Biaya <small>| Defaultnya, semuanya telah dibagi 2 dari total semestinya</small></legend>
		</div>

	<div class="col-lg-6">

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Pangkal :</label>
			<div class="col-sm-5">
				<input type="number" maxlength="9" name="pangkal" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->pangkal;}else{ echo $d->pangkal/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku SMP :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_smp" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->buku_smp;}else{ echo $d->buku_smp/2;} ?>" onKeyPress="return num(this, event)" <?php if($sekolah!='smp'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospa" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->kaos;}else{ echo $d->kaospa/2;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="osis" id="input" class="form-control" value="<?php if($nq1>=1){echo $d->osis;}else{ echo $d->osis/2;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Jubah :</label>
			<div class="col-sm-5">
				<input type="number" name="jubah" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->jubah;}else{ echo $d->jubah/2;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kalender :</label>
			<div class="col-sm-5">
				<input type="number" name="kalender" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->kalender;}else{ echo $d->kalender/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kasur :</label>
			<div class="col-sm-5">
				<input type="number" name="kasur" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->kasur;}else{ echo $d->kasur/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

	<div class="col-lg-6">
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">SPP :</label>
			<div class="col-sm-5">
				<input type="number" name="spp" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->spp;}else{ echo $d->spp/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku Ext :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_ext" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->buku_ext;}else{ echo $d->buku_ext/2;} ?>" onKeyPress="return num(this, event)" <?php if($sekolah!='sma'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospi" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->kaos;}else{ echo $d->kaospi/2;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pi'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="osispi" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->osis;}else{ echo $d->osispi/2;} ?>" onKeyPress="return num(this, event)" <?php if($jk!="pi"){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Lemari :</label>
			<div class="col-sm-5">
				<input type="number" name="lemari" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->lemari;}else{ echo $d->lemari/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Ramadhan :</label>
			<div class="col-sm-5">
				<input type="number" name="ramadhan" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->ramadhan;}else{ echo $d->ramadhan/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Tawab :</label>
			<div class="col-sm-5">
				<input type="number" name="tawab" id="input" class="form-control" value="<?php if($nq1>=1){echo $d1->tawab;}else{ echo $d->tawab/2;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

		<div class="form-group">
			<div class="col-sm-12">
				<!-- HIDDEN FIELD -->
				<input type="hidden" name="total" id="inputTotal" class="form-control" value="<?php echo $totalharusdibayar;?>">
				<button type="submit" class="btn btn-block btn-primary">Simpan</button>
			</div>
		</div>
</form>
<?php }else{
	echo "Detail Pembayaran";
} ?>