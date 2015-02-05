<h1>Pembayaran #2</h1>

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
$qp1 = mysql_query("select * from bta1 where idsiswa='$id'");
$np1 = mysql_num_rows($qp1);
if($np1>=1){
	$dp1 = mysql_fetch_object($qp1);
	$total1 = $dp1->total;
	$sisa1 = $dp1->sisa;
}else{
	eksyen('Error! Lakukan Pembayaran #1 terlebih dahulu',"?hal=$sekolah");
}

// Detail Pembayaran #2 diambil dari tabel bta2
$qp2 = mysql_query("select * from bta2 where idsiswa='$id'");
$np2 = mysql_num_rows($qp2);
if($np2>=1){
	$dp2 = mysql_fetch_object($qp2);
	$total2 = $dp2->total;
	$sisa2 = $dp2->sisa;
}else{
	$total2 = 0;
	$sisa2 = 0;
}

// Jika Pa
if($jk=='pa'){
	if($tipe=='smp'){
		$totalharusdibayar = $d->total_pa_sd;
		$buku = $d->buku_smp;
	}elseif($tipe=='sma'){
		$totalharusdibayar = $d->total_pa_smp;
		$buku = $d->buku_ext;
	}else{
		eksyen('Error!',"?hal=$sekolah");
	}
	$kaos = $d->kaospa;
	$osis = $d->osis;
	$jubah = $d->jubah;
}

// Jika Pi
if($jk=='pi'){
	if($tipe=='smp'){
		$totalharusdibayar = $d->total_pi_sd;
		$buku = $d->buku_smp;
	}elseif($tipe=='sma'){
		$totalharusdibayar = $d->total_pi_smp;
		$buku = $d->buku_ext;
	}else{
		eksyen('Error!',"?hal=$sekolah");
	}
	$kaos = $d->kaospi;
	$osis = $d->osispi;
	$jubah = 0;
}

// Menampilkan Sisa Yang Harus dibayar pada Form
$tpangkal = $d->pangkal - $dp1->pangkal;
$tspp = $d->spp - $dp1->spp;
$tbuku = $buku - $dp1->buku;
$tkalender = $d->kalender - $dp1->kalender;
$tkaos = $kaos - $dp1->kaos;
$tosis = $osis - $dp1->osis;
$tjubah = $jubah - $dp1->jubah;
$tlemari = $d->lemari - $dp1->lemari;
$tramadhan = $d->ramadhan - $dp1->ramadhan;
$tkasur = $d->kasur - $dp1->kasur;
$ttawab = $d->tawab - $dp1->tawab;

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
	$_total1 = $_POST['total1'];
	$sisa = $_total - $_total1 - $total;

	mysql_query("insert into bta2(idsiswa,pangkal,spp,buku,kaos,osis,jubah,lemari,kalender,ramadhan,kasur,tawab,total,sisa) values('$id','$pangkal','$spp','$buku','$kaos','$osis','$jubah','$lemari','$kalender','$ramadhan','$kasur','$tawab','$total','$sisa')") or die("Gagal input");
	eksyen('',"?hal=bayar2&tipe=$sekolah&id=$id");
}
?>

<?php if($np2<1){ ?>
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
			<legend>Form Pengaturan Biaya <small>| Total Sementara Rp.<span id="totalsementara"></span></small></legend>
		</div>

	<div class="col-lg-6">

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Pangkal :</label>
			<div class="col-sm-5">
				<input type="number" maxlength="9" name="pangkal" id="pangkal" class="form-control" value="<?php if($np2>=1){echo $d1->pangkal;}else{ echo $tpangkal;} ?>" onKeyPress="return num(this, event)" onKeyUp="hitung()">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku SMP :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_smp" id="buku_smp" class="form-control" value="<?php if($np2>=1){echo $d1->buku_smp;}else{ echo $tbuku;} ?>" onKeyPress="return num(this, event)" <?php if($sekolah!='smp'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospa" id="kaospa" class="form-control" value="<?php if($np2>=1){echo $d1->kaos;}else{ echo $tkaos;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="osis" id="osis" class="form-control" value="<?php if($np2>=1){echo $d->osis;}else{ echo $tosis;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Jubah :</label>
			<div class="col-sm-5">
				<input type="number" name="jubah" id="jubah" class="form-control" value="<?php if($np2>=1){echo $d1->jubah;}else{ echo $tjubah;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pa'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kalender :</label>
			<div class="col-sm-5">
				<input type="number" name="kalender" id="kalender" class="form-control" value="<?php if($np2>=1){echo $d1->kalender;}else{ echo $tkalender;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kasur :</label>
			<div class="col-sm-5">
				<input type="number" name="kasur" id="kasur" class="form-control" value="<?php if($np2>=1){echo $d1->kasur;}else{ echo $tkasur;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

	<div class="col-lg-6">
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">SPP :</label>
			<div class="col-sm-5">
				<input type="number" name="spp" id="spp" class="form-control" value="<?php if($np2>=1){echo $d1->spp;}else{ echo $tspp;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku Ext :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_ext" id="buku_ext" class="form-control" value="<?php if($np2>=1){echo $d1->buku_ext;}else{ echo $tbuku;} ?>" onKeyPress="return num(this, event)" <?php if($sekolah!='sma'){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospi" id="kaospi" class="form-control" value="<?php if($np2>=1){echo $d1->kaos;}else{ echo $tkaos;} ?>" onKeyPress="return num(this, event)" <?php if($jk!='pi'){echo "readonly";} ?>>
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="osispi" id="osispi" class="form-control" value="<?php if($np2>=1){echo $d1->osis;}else{ echo $tosis;} ?>" onKeyPress="return num(this, event)" <?php if($jk!="pi"){echo "readonly";} ?>>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Lemari :</label>
			<div class="col-sm-5">
				<input type="number" name="lemari" id="lemari" class="form-control" value="<?php if($np2>=1){echo $d1->lemari;}else{ echo $tlemari;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Ramadhan :</label>
			<div class="col-sm-5">
				<input type="number" name="ramadhan" id="ramadhan" class="form-control" value="<?php if($np2>=1){echo $d1->ramadhan;}else{ echo $tramadhan;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Tawab :</label>
			<div class="col-sm-5">
				<input type="number" name="tawab" id="tawab" class="form-control" value="<?php if($np2>=1){echo $d1->tawab;}else{ echo $ttawab;} ?>" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

		<div class="form-group">
			<div class="col-sm-12">
				<!-- HIDDEN FIELD -->
				<input type="hidden" name="total1" id="inputTotal" class="form-control" value="<?php echo $total1;?>">
				<input type="hidden" name="total" id="inputTotal" class="form-control" value="<?php echo $totalharusdibayar;?>">
				<button type="submit" class="btn btn-block btn-primary">Simpan</button>
			</div>
		</div>
</form>
<?php }else{
	echo "Detail Pembayaran";
} ?>