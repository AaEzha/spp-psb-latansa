<?php
$q = mysql_query("select * from bendahara1");
$n = mysql_num_rows($q);
if($n>=1){
	$d = mysql_fetch_object($q);
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
	$total_pa_sd = $pangkal + $spp + $buku_smp + $kaospa + $osis + $jubah + $lemari + $kalender + $ramadhan + $kasur + $tawab;
	$total_pi_sd = $pangkal + $spp + $buku_smp + $kaospi + $osispi + $lemari + $kalender + $ramadhan + $kasur + $tawab;
	$total_pa_smp = $pangkal + $spp + $buku_ext + $kaospa + $osis + $jubah + $lemari + $kalender + $ramadhan + $kasur + $tawab;
	$total_pi_smp = $pangkal + $spp + $buku_ext + $kaospi + $osispi + $lemari + $kalender + $ramadhan + $kasur + $tawab;

	if($n>=1){
		// update data
		mysql_query("update bendahara1 set
									pangkal='$pangkal',
									spp='$spp',
									buku_smp='$buku_smp',
									buku_ext='$buku_ext',
									kaospa='$kaospa',
									kaospi='$kaospi',
									osis='$osis',
									osispi='$osispi',
									jubah='$jubah',
									lemari='$lemari',
									kalender='$kalender',
									ramadhan='$ramadhan',
									kasur='$kasur',
									tawab='$tawab',
									total_pa_sd='$total_pa_sd',
									total_pi_sd='$total_pi_sd',
									total_pa_smp='$total_pa_smp',
									total_pi_smp='$total_pi_smp'");
		eksyen('','?hal=pengaturan');
	}else{
		// input data
		mysql_query("insert into bendahara1(nomor,pangkal,spp,buku_smp,buku_ext,kaospa,kaospi,osis,osispi,jubah,lemari,kalender,ramadhan,kasur,tawab,total_pa_sd,total_pi_sd,total_pa_smp,total_pi_smp) values('1','$pangkal','$spp','$buku_smp','$buku_ext','$kaospa','$kaospi','$osis','$osispi','$jubah','$lemari','$kalender','$ramadhan','$kasur','$tawab','$total_pa_sd','$total_pi_sd','$total_pa_smp','$total_pi_smp')") or die("Gagal input");
		eksyen('','?hal=pengaturan');
	}
}
?>

<form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<legend>Form Pengaturan Biaya</legend>
		</div>

	<div class="col-lg-6">

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Pangkal :</label>
			<div class="col-sm-5">
				<input type="number" maxlength="9" name="pangkal" id="input" class="form-control" value="<?php if($n>=1){echo $d->pangkal;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku SMP :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_smp" id="input" class="form-control" value="<?php if($n>=1){echo $d->buku_smp;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospa" id="input" class="form-control" value="<?php if($n>=1){echo $d->kaospa;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putra :</label>
			<div class="col-sm-5">
				<input type="number" name="osis" id="input" class="form-control" value="<?php if($n>=1){echo $d->osis;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Jubah :</label>
			<div class="col-sm-5">
				<input type="number" name="jubah" id="input" class="form-control" value="<?php if($n>=1){echo $d->jubah;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kalender :</label>
			<div class="col-sm-5">
				<input type="number" name="kalender" id="input" class="form-control" value="<?php if($n>=1){echo $d->kalender;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kasur :</label>
			<div class="col-sm-5">
				<input type="number" name="kasur" id="input" class="form-control" value="<?php if($n>=1){echo $d->kasur;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Total SD Pa :</label>
			<div class="col-sm-5">
				<input type="number" name="total_pa_sd" id="input" class="form-control" value="<?php if($n>=1){echo $d->total_pa_sd;} ?>" readonly="readonly" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Total SMP Pa :</label>
			<div class="col-sm-5">
				<input type="number" name="total_pa_smp" id="input" class="form-control" value="<?php if($n>=1){echo $d->total_pa_smp;} ?>" readonly="readonly" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

	<div class="col-lg-6">
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">SPP :</label>
			<div class="col-sm-5">
				<input type="number" name="spp" id="input" class="form-control" value="<?php if($n>=1){echo $d->spp;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Buku Ext :</label>
			<div class="col-sm-5">
				<input type="number" name="buku_ext" id="input" class="form-control" value="<?php if($n>=1){echo $d->buku_ext;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Kaos Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="kaospi" id="input" class="form-control" value="<?php if($n>=1){echo $d->kaospi;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">OSIS Putri :</label>
			<div class="col-sm-5">
				<input type="number" name="osispi" id="input" class="form-control" value="<?php if($n>=1){echo $d->osispi;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Lemari :</label>
			<div class="col-sm-5">
				<input type="number" name="lemari" id="input" class="form-control" value="<?php if($n>=1){echo $d->lemari;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Ramadhan :</label>
			<div class="col-sm-5">
				<input type="number" name="ramadhan" id="input" class="form-control" value="<?php if($n>=1){echo $d->ramadhan;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Tawab :</label>
			<div class="col-sm-5">
				<input type="number" name="tawab" id="input" class="form-control" value="<?php if($n>=1){echo $d->tawab;} ?>" required="required" onKeyPress="return num(this, event)">
			</div>
		</div>

		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Total SD Pi :</label>
			<div class="col-sm-5">
				<input type="number" name="total_pi_sd" id="input" class="form-control" value="<?php if($n>=1){echo $d->total_pi_sd;} ?>" readonly="readonly" onKeyPress="return num(this, event)">
			</div>
		</div>
		
		<div class="form-group">
			<label for="input" class="col-sm-3 control-label">Total SMP Pi :</label>
			<div class="col-sm-5">
				<input type="number" name="total_pi_smp" id="input" class="form-control" value="<?php if($n>=1){echo $d->total_pi_smp;} ?>" readonly="readonly" onKeyPress="return num(this, event)">
			</div>
		</div>

	</div>

		<div class="form-group">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-block btn-primary">Simpan</button>
			</div>
		</div>
</form>