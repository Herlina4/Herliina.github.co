<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Hasil Clustering Tahun <?php echo $thn ?></h1>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Centroid Non-Means</h6>
    </div>
	<div class="card-body">
		 <ol>
		 	<li>Cluster 1 strategi pemasarannya akan menggunakan digital marketing dalam melakukan penawaran produk</li>
		 	<li>Cluster 2 strategi pemasarannya akan menggunakan penjualan langsung ke customer dalam melakukan penawaran produk</li>
		 	<li>cluster 3 pemasaran produk akan dilakukan pameran untuk memperkenalkan produk pada customer pada cluster yang kurang baik dalam penjualannya</li>
		 </ol>
	</div>
 </div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Centroid Non-Means</h6>
    </div>
	
	<div class="card-body">
	
				
              <?php foreach ($centroid_temp_by_c as $val) { ?>
					<?php $c[] = $val->c; ?>
				<?php } ?>
				<?php foreach ($centroid_temp_by_iterasi as $key) { ?>
					<?php $q = $this->db->query('select * from centroid_temp where iterasi='.$key->iterasi.''); ?>
					<?php $no = 1; ?>
					
					<h5>Iterasi ke-<?php echo $key->iterasi ?></h5>
					<div class="table-responsive">
						<table class="table table-bordered" width="100%" cellspacing="0">
							<thead class="bg-success text-white">
								<tr align="center">
									<th width="5%">No</th>
									<th>Jenis</th>
									<?php for ($i=0; $i < count($c); $i++) { ?>
										<th width="5%"><?php echo strtoupper($c[$i]); ?></th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
					                <?php foreach($q->result() as $tq) { ?>
						              <tr align="center">
						              	<td class="align-middle"><?php echo $no ?></td>
						              	<td class="align-middle text-left"><?php if ($tq->jenis == "M") {
						              		echo "Means";
						              	}
						              	else{
						              		echo "Non-Means";
						              	} ?></td>
						              	<?php for ($j=0; $j < COUNT($c); $j++) { 
						              		if ($tq->c == $c[$j]) { ?>
						              			<td class='align-middle bg-success text-white font-weight-bold'>1</td>
						              		<?php }
						              		else{
						              			echo "<td>0</td>";
						              		}
						              	} ?>
						              </tr>
						            <?php $no++ ?>
					              <?php } ?>
							</tbody>
						</table>
					</div>

				<?php } ?>
          </div>
        </div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Pengelompokan</h6>
    </div>

    <div class="card-body">
        <?php foreach ($centroid_temp_by_iterasi as $key) {
            if ($key->iterasi == 1) {
                $it = $key->iterasi;
            } else {
                $it = $key->iterasi - 1;
            }
        } ?>
        <?php $q2 = $this->db->query('select * from centroid_temp where iterasi=' . $it . ''); ?>
        <?php foreach ($q2->result() as $vil) {
            $hc[] = $vil->c;
        } ?>
        <?php $no = 0 ?>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-success text-white">
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Lokasi</th>
                    <th>Pemasaran</th>
                    <?php for ($i = 0; $i < count($c); $i++) { ?>
                        <th width="5%"><?php echo strtoupper($c[$i]); ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($jagung as $key) { ?>
                    <tr align="center">
                        <td class="align-middle"><?php echo $no + 1 ?></td>
                        <td class="align-middle text-left"><?php echo $key->nama_lokasi ?></td>
                        <td>
                            <?php
                            if ($hc[$no] == $c[0]) {
                                echo "Digital Marketing";
                            } elseif ($hc[$no] == $c[1]) {
                                echo "Penjualan Langsung (Pemasaran Offline)";
                            } elseif ($hc[$no] == $c[2]) {
                                echo "Pameran";
                            }
                            ?>
                        </td>
                        <?php for ($k = 0; $k < count($c); $k++) { ?>
                            <?php if ($hc[$no] == $c[$k]) { ?>
                                <td class='align-middle bg-success text-white font-weight-bold'>1</td>
                                <?php $kk = $k + 1; ?>
                                <?php $q3 = "insert into hasil_klaster(fk_tanaman,c) values('" . $key->id_tanaman . "','c" . $kk . "')";
                                $this->db->query($q3); ?>
                            <?php } else {
                                echo "<td>0</td>";
                            } ?>
                        <?php } ?>

                    </tr>
                    <?php $no++ ?>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card shadow mb-4">
        <!-- /.card-header -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Kesimpulan</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="bg-success text-white">
                    <tr align="center">
                        <th width="5%">No</th>
                        <th>Kesimpulan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $lokasi_array = array(); // Array untuk menyimpan lokasi unik yang telah diproses
                    $no = 1;
                    foreach ($jagung as $key) {
                        $lokasi_id = $key->fk_lokasi;
                        $klaster = '';
                        if ($hc[$no - 1] == $c[0]) {
                            $klaster = 'Digital Marketing';
                        } elseif ($hc[$no - 1] == $c[1]) {
                            $klaster = 'Penjualan Langsung (Pemasaran Offline)';
                        } elseif ($hc[$no - 1] == $c[2]) {
                            $klaster = 'Pameran';
                        }

                        // Ambil data nama lokasi dari tabel lokasi berdasarkan id_lokasi atau nama_lokasi
                        $q = $this->db->query("SELECT nama_lokasi FROM lokasi WHERE id_lokasi = $lokasi_id OR nama_lokasi = '$lokasi_id'");
                        $row = $q->row();
                        $nama_lokasi = $row->nama_lokasi;

                        // Hapus string dalam tanda kurung
                        $nama_lokasi_clean = preg_replace('/\([^)]*\)/', '', $nama_lokasi);

                        // Ambil data kota dari tabel tanaman berdasarkan fk_lokasi
                        $q2 = $this->db->query("SELECT kota FROM tanaman WHERE fk_lokasi = $lokasi_id");
                        $row2 = $q2->row();
                        $kota = $row2->kota;

                        // Periksa apakah lokasi telah diproses sebelumnya
                        if (!in_array(substr($nama_lokasi, 0, 5), $lokasi_array)) {
                            $lokasi_array[] = substr($nama_lokasi, 0, 5); // Tambahkan 5 huruf awal lokasi ke array
                            ?>
                            <tr align="center">
                                <td class="align-middle"><?php echo $no ?></td>
                                <td class="align-middle">Daerah <?php echo $nama_lokasi_clean  ?> (<?php echo $kota ?>) Cara pemasaran paling efektif di lakukan adalah <?php echo $klaster ?></td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
  include "footer.php";
?>