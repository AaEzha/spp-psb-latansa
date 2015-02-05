<?php tabel();?>
<h2>Laporan Pembayaran</h2>
<table class="table" id="tbl">
	<thead>
		<tr>
			<th class="col-lg-1 text-center">No</th>
			<th>Nama</th>
			<th class="col-lg-1 text-center">JK</th>
			<th class="col-lg-1 text-center">Skl</th>
			<th class="col-lg-1">Total</th>
			<th class="col-lg-1">#1</th>
			<th class="col-lg-1">#2</th>
			<th class="col-lg-1">Sisa</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$q = mysql_query("select * from siswa");
		$no = 1;
		while($d = mysql_fetch_object($q)){
			$_1 = getdata($d->idsiswa,'bta1','idsiswa','total');
			$_2 = getdata($d->idsiswa,'bta2','idsiswa','total');

			$jk = $d->jk;
			$tipe = $d->jenis;

			// Jika Pa
			if($jk=='pa'){
				if($tipe=='smp'){
					$total = ambildata('bendahara1','total_pa_sd');
				}elseif($tipe=='sma'){
					$total = ambildata('bendahara1','total_pa_smp');
				}
			}

			// Jika Pi
			if($jk=='pi'){
				if($tipe=='smp'){
					$total = ambildata('bendahara1','total_pi_sd');
				}elseif($tipe=='sma'){
					$total = ambildata('bendahara1','total_pi_smp');
				}
			}
		?>
		<tr>
			<td class="text-center"><?php echo $no;?></td>
			<td><?php echo $d->namasiswa;?></td>
			<td class="text-center"><?php $jk=($d->jk=='pa') ? 'Putra' : 'Putri'; echo $jk; ?></td>
			<td class="text-center"><?php $jenis=($d->jenis=='smp') ? 'SMP' : 'SMA'; echo $jenis; ?></td>
			<td><?php echo number_format($total);?></td>
			<td><?php echo number_format($_1);?></td>
			<td><?php echo number_format($_2);?></td>
			<td><?php echo number_format($total-$_1-$_2);?></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
</table>