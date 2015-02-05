<?php debug_backtrace() || die ("Direct access not permitted");
date_default_timezone_set("Asia/Jakarta"); // ngatur waktu
function eksyen($teks=false,$tujuan){ // buat pindah halaman
	if($teks){
		die("<script>alert('$teks');</script>
	     <meta http-equiv='refresh' content='0;$tujuan'>");
	}else{
		die("<meta http-equiv='refresh' content='0;$tujuan'>");
	}
}

function getdata($id,$tabel,$where,$kolom){ // buat ngambil data
	$qgetdata = mysql_query("select * from $tabel where $where='$id'");
	$dgetdata = mysql_fetch_array($qgetdata);
	return $dgetdata[$kolom];
}

function ambildata($tabel,$kolom){
	$qgetdata = mysql_query("select * from $tabel");
	$dgetdata = mysql_fetch_array($qgetdata);
	return $dgetdata[$kolom];
}

function indeks(){ // buat menu home/index
	if(!isset($_GET['hal'])){
		echo " class=\"active\"";
	}
}

function aktif($aktip){ // buat menu selain home
	if(isset($_GET['hal'])){
		if($_GET['hal']==$aktip){
			echo " class=\"active\"";
		}
	}
}

function aktip($aktip){ // buat menu selain home
	if(isset($_GET['hal'])){
		if($_GET['hal']==$aktip){
			echo " active";
		}
	}
}

function radio($a,$b){ 
	if($a==$b){
		echo "checked";
	}
}

function selects($a,$b){ 
	if($a==$b){
		echo " 

		selected";
	}
}

function tabel(){
	echo "<link href=\"css/jquery.dataTables.min.css\" rel=\"stylesheet\">\n<link href=\"css/dataTasdsbles.bootstrap.css\" rel=\"stylesheet\">\n<script src=\"js/jquery.dataTables.min.js\"></script>\n<script src=\"js/dataTables.bootstrap.js\"></script>\n<script>$(document).ready(function(){ $('#tbl').dataTable();});</script>";
}

function yakin(){
	echo "onClick=\"return confirm('Apakah Anda yakin akan melakukan aksi ini?');\" ";
}

?>