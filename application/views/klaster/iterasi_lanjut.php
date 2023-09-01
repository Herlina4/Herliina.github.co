<?php 
  include "header.php";
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Clustering Data Tahun <?php echo $thn ?> Iterasi Ke-<?php echo $this->uri->segment(5)+1 ?></h1>
	<?php $it = $iterasi+1 ?>
	<a href="<?php echo site_url('Klaster/iterasi_lanjut/'.$thn.'/'.$jml.'/'.$it) ?>" class="btn btn-success"><i class="fa fa-share"></i> Lanjutkan Iterasi</a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Means</h6>
    </div>
	
	<div class="card-body">
	<div class="alert alert-info">Dikarenakan hasil selisih antara Means dengan Non-Means di bawah 0, maka hasil dari Non-Means dijadikan sebagai Means dan dibentuk perhitungan untuk Non-Means baru.</div>
						<div class="alert alert-danger font-weight-bold">
							Hasil Means : <?php foreach ($hasil_iterasi as $key) {
								echo $medoids = $key->total_non_medoids;
							} ?>
						</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Centroid Non-Means</h6>
    </div>
	
	<div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
                <tr align="center">
								<th>Centroid ke-</th>
								<th>Lokasi</th>
                                <th>Pemasaran</th>
								<th>Harga Satuan</th>
								<th>Produksi (Kg)</th>
								<th>Total Harga Jual (Tahun)</th>
								<th>Tahun</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1 ?>
							<?php foreach ($jagung_rand as $m1) { ?>
								<tr align="center">
									<td class="align-middle"><?php echo $no ?></td>
									<td class="align-middle text-left"><?php echo $m1->nama_lokasi ?></td>
                                    <td class="align-middle">
                                        <?php
                                        if ($no == 1) {
                                            echo "Digital Marketing";
                                        } elseif ($no == 2) {
                                            echo "Penjualan Langsung (Pemasaran Offline)";
                                        } elseif ($no == 3) {
                                            echo "Pameran";
                                        }
                                        ?>
                                    </td>
									<td class="align-middle"><?php echo $m1->produksi ?></td>
									<td class="align-middle"><?php echo $m1->produktivitas ?></td>
									<td class="align-middle"><?php echo $m1->luas_panen ?></td>
									<td class="align-middle"><?php echo $m1->tahun ?></td>
									<?php $no++ ?>
								</tr>
							<?php } ?>
						</tbody>
		          </table>
              </div>
          </div>
        </div>
		
<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Iterasi Non-Means</h6>
    </div>

	<div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="bg-success text-white">
        <tr align="center">
            <th rowspan="2">No</th>
            <th rowspan="2">Lokasi</th>
            <th rowspan="2">Pemasaran</th>
            <th rowspan="2">Harga Satuan</th>
            <th rowspan="2">Produksi (Kg)</th>
            <th rowspan="2">Total Harga Jual (Tahun)</th>
            <th rowspan="2">Tahun</th>
            <?php $c = 1 ?>
            <?php foreach ($jagung_rand as $m) { ?>
                <th colspan="3">Centroid <?php echo $c; $c++ ?></th>
            <?php } ?>
            <?php $d = 1 ?>
            <?php foreach ($jagung_rand as $m) { ?>
                <th rowspan="2">C<?php echo $d; $d++ ?></th>
            <?php } ?>
        </tr>
        <tr align="center">
            <?php foreach ($jagung_rand as $m1) { ?>
                <th><?php $c_prod[] = $m1->produksi; echo $m1->produksi ?></th>
                <th><?php $c_prodt[] = $m1->produktivitas; echo $m1->produktivitas ?></th>
                <th><?php $c_lp[] = $m1->luas_panen; echo $m1->luas_panen ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1;
        $tc0 = 0;
        $tc = 0 ?>
        <?php foreach ($jagung as $key) { ?>
            <tr align="center">
                <td class="align-middle"><?php echo $no ?></td>
                <td class="align-middle text-left"><?php echo $key->nama_lokasi ?></td>
                <td class="align-middle">
                    <?php
                    $hm = array();
                    $e = 0;
                    foreach ($jagung_rand as $k) {
                        $hm[$e] = sqrt(pow(($key->produksi-$c_prod[$e]),2)+pow(($key->produktivitas-$c_prodt[$e]),2)+pow(($key->luas_panen-$c_lp[$e]),2));
                        $hc[$e] = $hm[$e];
                        $e++;
                    }

                    $selected_centroid = array_keys($hc, min($hc))[0];

                    switch ($selected_centroid) {
                        case 0:
                            echo 'Digital Marketing';
                            break;
                        case 1:
                            echo 'Penjualan Langsung (Pemasaran Offline)';
                            break;
                        case 2:
                            echo 'Pameran';
                            break;
                        default:
                            echo 'Unknown';
                            break;
                    }
                    ?>
                </td>
                <td class="align-middle"><?php echo $key->produksi ?></td>
                <td class="align-middle"><?php echo $key->produktivitas ?></td>
                <td class="align-middle"><?php echo $key->luas_panen ?></td>
                <td class="align-middle"><?php echo $key->tahun ?></td>
                <?php $no++ ?>

                <?php $e = 0; ?>
                <?php foreach ($jagung_rand as $k) { ?>
                    <td class="align-middle" colspan="3"><?php echo $hm[$e]; ?></td>
                    <?php $e++ ?>
                <?php } ?>

                <?php for ($i=0; $i < COUNT($hc); $i++) { ?>
                    <?php if ($hc[$i] == MIN($hc)) { ?>
                        <td class='align-middle bg-success text-white font-weight-bold'>1</td>
                        <?php
                        $cm = $i+1;
                        $q = "insert into centroid_temp(jenis,iterasi,c) values('NM','".$it."','c".$cm."')";
                        $this->db->query($q);
                    }
                    else{
                        echo "<td>0</td>";
                    }
                    ?>
                <?php } ?>

                <?php
                for ($j=0; $j < COUNT($hc); $j++) {
                    $tc0 = $tc0 + $hc[$j];
                    $ttc[] = $tc0;
                }
                ?>
            </tr>
        <?php } ?>
        <tr align="center">
            <td class="align-middle" colspan="6"><b>TOTAL</b></td>
            <td class="align-middle" colspan="12"><b><?php echo $ttc[6].'/'.end($ttc) ?></b></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
    
    <div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Selisih antara Non-Means dengan Means</h6>
    </div>

	<div class="card-body">
	<table class="table table-bordered">
	<tr>
	<th width="30%">Total Means</th>
	<td><?php echo $medoids ?></td>
	</tr>
	
	<tr>
	<th>Total Non Means</th>
	<td><?php echo $ttc[6] ?></td>
	</tr>
	
	<tr>
	<th>Selisih</th>
	<td><?php echo $selisih = $ttc[6] - $medoids ?></td>
	</tr>
	
	</table>
	
	<?php $n = "insert into hasil_iterasi(iterasi,total_medoids,total_non_medoids,selisih) values('".$it."','".$medoids."','".$ttc[6]."','".$selisih."')";
              							$this->db->query($n); ?>
	
	</div>
</div>
<br>br
<div class="card-body">
	        <div class="table-responsive">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead class="bg-success text-white">
						<tr align="center">
							<th width="5%">No</th>
							<th>Teknik Pemasaran</th>
							<th width="5%">Klaster</th>
						</tr>
					</thead>
					<tbody>
						<tr align="center">
							<td class="align-middle">1.</td>
							<td class="align-middle text-left">Digital Marketing</td>
							<td>Klaster C1</td>
						</tr>
						<tr align="center">
							<td class="align-middle">2.</td>
							<td class="align-middle text-left">Penjualan Langsung (Pemasaran Offline)</td>
							<td>Klaster C2</td>
						</tr>
						<tr align="center">
							<td class="align-middle">3.</td>
							<td class="align-middle text-left">Pameran</td>
							<td>Klaster C3</td>
						</tr>
					</tbody>
				</table>

            </div>
          </div>
	
<?php 
  include "footer.php";
?>