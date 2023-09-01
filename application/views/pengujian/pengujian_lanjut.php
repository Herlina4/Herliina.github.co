<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tools"></i> Data Pengujian</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Hasil Pengujian Pengelompokan Menggunakan Silhouette Coefficient</h6>
    </div>
	
	<div class="card-body">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
							<th width="5">No</th>
							<th>Klaster ke-</th>
							<th>S(i)</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						$jmlsi = 0 ?>
						<?php foreach ($hasil as $key) { ?>
							<tr align="center">
								<td><?php echo $no ?></td>
								<td><?php echo ($key->c)+1 ?></td>
								<td><?php echo $key->si;
								$jmlsi = $jmlsi + $key->si ?></td>
								<?php $no++ ?>
							</tr>
						<?php } ?>
						<tr align="center">
							<th colspan="2">Jumlah</th>
							<th colspan="2"><?php echo $jmlsi ?></th>
						</tr>
						<tr align="center">
							<th colspan="2">Rata-rata</th>
							<th><?php echo $rt2 = $jmlsi/count($hasil) ?></td>
						</tr>
						<tr align="center">
							<th colspan="2">Hasil</th>
							<th><?php if ($rt2<0) {
								echo "CLUSTERING KURANG BAIK";
							}
							else{
								echo "CLUSTERING BAIK";
							} ?></th>
						</tr>
					</tbody>
				</table>
          </div>
        </div>
		
<?php 
  include "footer.php";
?>
