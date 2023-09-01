<?php 	$this->db->query('truncate table centroid_temp'); ?>
<?php 	$this->db->query('truncate table hasil_iterasi'); ?>

<?php 
  include "header.php";
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Data Cluster Tahun <?php echo $thn ?> Iterasi Ke-1</h1>
	
	<a href="<?php echo site_url('Klaster/iterasi_lanjut/'.$thn.'/'.$jml.'/1') ?>" class="btn btn-success"><i class="fa fa-share"></i> Lanjutkan Iterasi</a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Centroid Centroid 1</h6>
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
                        <td><?php echo $no ?></td>
                        <td class="text-left"><?php echo $m1->nama_lokasi ?></td>
                        <td>
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
                        <td><?php echo $m1->produksi ?></td>
                        <td><?php echo $m1->produktivitas ?></td>
                        <td><?php echo $m1->luas_panen ?></td>
                        <td><?php echo $m1->tahun ?></td>
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
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Iterasi 1</h6>
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
        <?php
        $no = 1;
        $tc0 = 0;
        $tc = 0;
        $hc = array_fill(0, count($jagung_rand), 0);
        ?>

        <?php foreach ($jagung as $key) { ?>
            <tr align="center">
                <td class="align-middle"><?php echo $no ?></td>
                <td class="text-left align-middle"><?php echo $key->nama_lokasi ?></td>
                <td class="align-middle">
                    <?php if ($hc[0] == min($hc)) {
                        echo "Pemasaran Digital";
                    } elseif ($hc[1] == min($hc)) {
                        echo "Penjualan Langsung (Pemasaran Offline)";
                    } elseif ($hc[2] == min($hc)) {
                        echo "Pameran";
                    } else {
                        echo "Tidak Diketahui";
                    } ?>
                </td>
                <td class="align-middle"><?php echo $key->produksi ?></td>
                <td class="align-middle"><?php echo $key->produktivitas ?></td>
                <td class="align-middle"><?php echo $key->luas_panen ?></td>
                <td class="align-middle"><?php echo $key->tahun ?></td>
                <?php $no++ ?>
                <?php $e = 0;
                $tc = array(); ?>
                <?php foreach ($jagung_rand as $k) { ?>
                    <td class="align-middle" colspan="3">
                        <?php
                        $hm[$e] = sqrt(pow(($key->produksi - $c_prod[$e]), 2) + pow(($key->produktivitas - $c_prodt[$e]), 2) + pow(($key->luas_panen - $c_lp[$e]), 2));
                        echo $hm[$e];
                        $hc[$e] = $hm[$e];
                        ?>
                    </td>
                    <?php $e++ ?>
                <?php } ?>
                <?php for ($i = 0; $i < COUNT($hc); $i++) { ?>
                    <?php if ($hc[$i] == min($hc)) {
                        echo "<td class='align-middle bg-success text-white font-weight-bold'>1</td>";
                        $cm = $i + 1;
                        $q = "insert into centroid_temp(jenis,iterasi,c) values('M',1,'c" . $cm . "')";
                        $this->db->query($q);
                    } else {
                        echo "<td class='align-middle'>0</td>";
                    } ?>
                <?php } ?>
                <?php
                for ($j = 0; $j < COUNT($hc); $j++) {
                    $tc0 = $tc0 + $hc[$j];
                    $ttc[] = $tc0;
                }
                ?>
            </tr>
        <?php } ?>
        <tr align="center">
            <td class="align-middle" colspan="6"><b>TOTAL</b></td>
            <td class="align-middle" colspan="12"><b><?php echo $tc0 ?></b></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
</div>




<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Centroid Proses 2</h6>
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
                <?php $nom = 1 ?>
                <?php foreach ($jagung_rand2 as $nm1) { ?>
                    <tr align="center">
                        <td><?php echo $nom ?></td>
                        <td class="text-left"><?php echo $nm1->nama_lokasi ?></td>
                        <td>
                            <?php
                            if ($nom == 1) {
                                echo "Digital Marketing";
                            } elseif ($nom == 2) {
                                echo "Penjualan Langsung (Pemasaran Offline)";
                            } elseif ($nom == 3) {
                                echo "Pameran";
                            }
                            ?>
                        </td>
                        <td><?php echo $nm1->produksi ?></td>
                        <td><?php echo $nm1->produktivitas ?></td>
                        <td><?php echo $nm1->luas_panen ?></td>
                        <td><?php echo $nm1->tahun ?></td>
                        <?php $nom++ ?>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>



    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Iterasi ke 2</h6>
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
                        <?php $f = 1 ?>
                        <?php foreach ($jagung_rand2 as $m) { ?>
                            <th colspan="3">Centroid <?php echo $f; $f++ ?></th>
                        <?php } ?>
                        <?php $g = 1 ?>
                        <?php foreach ($jagung_rand2 as $m) { ?>
                            <th rowspan="2">C<?php echo $g; $g++ ?></th>
                        <?php } ?>
                    </tr>
                    <tr align="center">
                        <?php foreach ($jagung_rand2 as $nm1) { ?>
                            <th><?php $cn_prod[] = $nm1->produksi; echo $nm1->produksi ?></th>
                            <th><?php $cn_prodt[] = $nm1->produktivitas; echo $nm1->produktivitas ?></th>
                            <th><?php $cn_lp[] = $nm1->luas_panen; echo $nm1->luas_panen ?></th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $tcnm0 = 0;
                    $tcnm = 0;
                    ?>
                    <?php foreach ($jagung as $key) { ?>
                        <tr align="center">
                            <td class="align-middle"><?php echo $no ?></td>
                            <td class="text-left align-middle"><?php echo $key->nama_lokasi ?></td>
                            <td class="align-middle">
                                <?php
                                $hcnm = array();
                                $hcnm[] = sqrt(pow(($key->produksi - $cn_prod[0]), 2) + pow(($key->produktivitas - $cn_prodt[0]), 2) + pow(($key->luas_panen - $cn_lp[0]), 2));
                                $hcnm[] = sqrt(pow(($key->produksi - $cn_prod[1]), 2) + pow(($key->produktivitas - $cn_prodt[1]), 2) + pow(($key->luas_panen - $cn_lp[1]), 2));
                                $hcnm[] = sqrt(pow(($key->produksi - $cn_prod[2]), 2) + pow(($key->produktivitas - $cn_prodt[2]), 2) + pow(($key->luas_panen - $cn_lp[2]), 2));
                                $cnm = array_search(min($hcnm), $hcnm) + 1;
                                switch ($cnm) {
                                    case 1:
                                        echo "Digital Marketing";
                                        break;
                                    case 2:
                                        echo "Penjualan Langsung (Pemasaran Offline)";
                                        break;
                                    case 3:
                                        echo "Pameran";
                                        break;
                                    default:
                                        echo "";
                                        break;
                                }
                                ?>
                            </td>
                            <td class="align-middle"><?php echo $key->produksi ?></td>
                            <td class="align-middle"><?php echo $key->produktivitas ?></td>
                            <td class="align-middle"><?php echo $key->luas_panen ?></td>
                            <td class="align-middle"><?php echo $key->tahun ?></td>
                            <?php $no++ ?>
                            <?php $l = 0; ?>
                            <?php foreach ($jagung_rand2 as $k) { ?>
                                <td class="align-middle" colspan="3"><?php echo $hcnm[$l]; ?></td>
                                <?php $l++ ?>
                            <?php } ?>
                            <?php for ($i = 0; $i < COUNT($hcnm); $i++) { ?>
                                <?php if ($hcnm[$i] == min($hcnm)) {
                                    $cnm = $i + 1;
                                    $q = "insert into centroid_temp(jenis, iterasi, c) values('NM', 1, 'c" . $cnm . "')";
                                    $this->db->query($q);
                                    switch ($cnm) {
                                        case 1:
                                            echo "<td class='align-middle bg-success text-white font-weight-bold'>1</td>";
                                            break;
                                        case 2:
                                            echo "<td class='align-middle bg-success text-white font-weight-bold'>1</td>";
                                            break;
                                        case 3:
                                            echo "<td class='align-middle bg-success text-white font-weight-bold'>1</td>";
                                            break;
                                        default:
                                            echo "<td class='align-middle'></td>";
                                            break;
                                    }
                                } else {
                                    echo "<td class='align-middle'>0</td>";
                                }
                                ?>
                            <?php } ?>
                            <?php
                            for ($j = 0; $j < COUNT($hcnm); $j++) {
                                $tcnm0 = $tcnm0 + $hcnm[$j];
                                $ttcnm[] = $tcnm0;
                            }
                            ?>
                        </tr>
                    <?php } ?>
                    <tr align="center">
                        <td class="align-middle" colspan="6"><b>TOTAL</b></td>
                        <td class="align-middle" colspan="12"><b><?php echo $tcnm0 ?></b></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Selisih antara klaster</h6>
    </div>
	
	<div class="card-body">
	<table class="table table-bordered">
	<tr>
	<th width="30%">Total Iterasi 1</th>
	<td><?php echo $tc0 ?></td>
	</tr>
	
	<tr>
	<th>Total Iterasi 2</th>
	<td><?php echo $tcnm0 ?></td>
	</tr>
	
	<tr>
	<th>Selisih</th>
	<td><?php echo $selisih = $tcnm0 - $tc0 ?></td>
	</tr>
	
	</table>
	
	<?php $n = "insert into hasil_iterasi(iterasi,total_medoids,total_non_medoids,selisih) values('1','".$tc0."','".$tcnm0."','".$selisih."')";
    $this->db->query($n); ?>
	
	</div>
</div>

<?php 
  include "footer.php";
?>
