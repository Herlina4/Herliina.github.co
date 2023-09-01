<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tools"></i> Data Pengujian</h1>

    <a href="<?php echo site_url('Pengujian/mulai_pengujian') ?>" class="btn btn-success"> <i class="fa fa-check"></i> Mulai Pengujian </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Hasil Pengelompokan Sebelumnya Pada Tahun <?php echo $thn ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
                <tr align="center">
						<th width="5%">No</th>
						<th>Nama Lokasi</th>
						<th>Klaster</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1 ?>
					<?php foreach ($hasil as $key) { ?>
						<tr align="center">
							<td><?php echo $no ?></td>
							<td class="text-left"><?php echo $key->nama_lokasi ?></td>
							<td><?php echo substr($key->c, -1); ?></td>
							<?php $no++ ?>
						</tr>
					<?php } ?>
				</tbody>
	          </table>
          </div>
        </div>
<?php 
  include "footer.php";
?>