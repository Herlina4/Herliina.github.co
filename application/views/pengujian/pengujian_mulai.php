<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tools"></i> Data Pengujian</h1>

    <a href="<?php echo site_url('Pengujian/lanjut_pengujian') ?>" class="btn btn-success"> <i class="fa fa-share"></i> Lanjut Pengujian </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Pengujian Pengelompokan Menggunakan Silhouette Coefficient</h6>
    </div>
	
	<div class="card-body">
      <?php $this->db->query('truncate table hasil_pengujian'); ?>
      <?php foreach ($hasilByC as $vil) { ?>
				<?php unset($c_prod); ?>
				<?php unset($c_prodv); ?>
				<?php unset($c_lp); ?>
				<?php $kondisiC  = $vil->c; ?>
				<?php $q2 = $this->db->query('select * from hasil_klaster  join tanaman on tanaman.id_tanaman=hasil_klaster.fk_tanaman JOIN lokasi ON tanaman.fk_lokasi=lokasi.id_lokasi where c="'.$kondisiC.'"'); ?>
				<?php foreach ($q2->result() as $vel) {
												$c_prod[] = $vel->produksi;
												$c_prodv[] = $vel->produktivitas;
												$c_lp[] = $vel->luas_panen;
											} ?>
				<div class="text-center mb-4"><h5 class="font-weight-bold">Hasil Perhitungan Jarak Ke Klaster Ke-<?php echo substr($vil->c, -1); ?></h5></div>
				<?php $cc = 0; ?>
				<?php unset($hp) ?>
				<?php foreach ($hasilByC as $key) { ?>
					<div class="mt-4 mb-4"><h5 class="font-weight-bold">Klaster ke-<?php echo $clus = substr($key->c, -1); ?></h5></div>
					<?php $q = $this->db->query('select * from hasil_klaster  join tanaman on tanaman.id_tanaman=hasil_klaster.fk_tanaman JOIN lokasi ON tanaman.fk_lokasi=lokasi.id_lokasi where c="'.$key->c.'"'); ?>
					<?php $no = 0; ?>
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead class="bg-success text-white">
								<tr align="center">
									<th width="5%">No</th>
									<th>Nama Lokasi</th>
									<th>Harga Satuan</th>
									<th>Produksi (Kg)</th>
									<th>Total Harga Jual (Tahun)</th>
									<?php $jarak = 0; ?>
									<?php for ($i=0; $i < count($c_prod); $i++) { ?>
										<th>Jarak ke-<?php echo $i+1 ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($q->result_array() as $val) { ?>
									<tr align="center">
										<td class="align-middle"><?php echo $no+1 ?></td>
										<td class="align-middle text-left"><?php echo $val['nama_lokasi'] ?></td>
										<td class="align-middle"><?php echo $val['produksi'] ?></td>
										<td class="align-middle"><?php echo $val['produktivitas'] ?></td>
										<td class="align-middle"><?php echo $val['luas_panen'] ?></td>
										<?php for ($i=0; $i < count($c_prod); $i++) { ?>
											<td class="align-middle">
												<!-- <?php echo $c_lp[$i] ?> -->
												<?php echo $ccc = sqrt(pow(($c_prod[$i]-$val['produksi']),2)+pow(($c_prodv[$i]-$val['produktivitas']),2)+pow(($c_lp[$i]-$val['luas_panen']),2)) ?>
												<?php $cc = $cc + $ccc ?>
											</td>
										<?php } ?>
										<?php $no++ ?>
									</tr>
								<?php } ?>
								<?php $jml = count($c_prod) ?>
								<tr>
									<td colspan="<?php echo $jml+4 ?>" align="right"><b>Rata-rata</b></td>
									<td><b><?php echo $hp[] = $cc/($no*$jml); ?></b></td>
								</tr>
							</tbody>
						</table>
					</div>
					<?php $cc++ ?>
				<?php } ?>
				<!-- <?php var_dump($hp) ?> -->
				
				<table class="table table-bordered mt-4 mb-4">
					<thead class="bg-success text-white">
						<tr align="center">
							<th>a(i)</th>
							<th>b(i)</th>
							<th>S(i)</th>
						</tr>
					</thead>
					<tbody>
						<tr align="center">
							<td><?php echo $a1[] = $hp[substr($vil->c, -1)-1];$ai = $hp[substr($vil->c, -1)-1]; ?></td>
							<td><?php $array = array_diff($hp, $a1); echo $bi = min($array)?></td>
							<td><?php echo $si[] = ($bi-$ai)/(MAX($bi,$ai)) ?></td>
						</tr>
					</tbody>
				</table>
			<?php } ?>
			<?php for ($o=0; $o < count($si); $o++) {
				$q3 = "insert into hasil_pengujian(c,si) values('".$o."','".$si[$o]."')";
              							$this->db->query($q3);
			} ?>
    </div>
</div>



<?php 
  include "footer.php";
?>