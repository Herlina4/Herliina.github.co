<?php 
  include "header_user.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-leaf"></i> Data Penjualan</h1>
	
	<a href="<?php echo site_url('User/tambah_jagung/'.$thn) ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Filter Berdasarkan Tahun</h6>
    </div>

    <div class="card-body">
        <?php echo form_open('User/filter_jagung',array('class' =>
        'form-horizontal')); ?>
        <div class="row">
            <div class="input-group mb-3 col-10">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Pilih Tahun</label>
                </div>
                <select name="tahun" id="inputTahun" class="custom-select" required>
                    <?php foreach ($tahun as $key) { ?>
                    <?php if ($key->tahun == $key->tahun): ?>
                    <option value="<?php echo $key->tahun ?>"><?php echo $key->tahun ?></option>
                    <?php endif ?>
                    <?php } ?>
                </select>
                <input type="hidden" name="hidden" class="form-control" value="Tahun" />
            </div>

            <div class="col-2">
                <button type="submit" class="btn btn-success w-100"><i class="fa fa-search"></i> Filter</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Penjulan Tahun <?php echo $thn ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
                <tr align="center">
					<th width="5%">No</th>
					<th>Lokasi</th>
                    <th>Nama Produk</th>
                    <th>Pemasaran</th>
					<th>Harga Satuan</th>
					<th>Produksi (KG) </th>
					<th>Total Harga Jual (Tahun)</th>
					<th>Tahun</th>
					<th width="15%">Aksi</th>
	              </tr>
	            </thead>
	            <tbody>
	            	<?php $no = 1 ?>
					<?php foreach ($jagung as $key) { ?>
						<tr>
							<td class="text-center"><?php echo $no ?></td>
							<td><?php echo $key->nama_lokasi ?></td>
                            <td class="text-center"><?php echo $key->kota ?></td>
                            <td class="text-center"><?php echo $key->pemasaran ?></td>
							<td class="text-center"><?php echo $key->produksi ?></td>
							<td class="text-center"><?php echo $key->produktivitas ?></td>
							<td class="text-center"><?php echo $key->luas_panen ?></td>
							<td class="text-center"><?php echo $key->tahun ?></td>
							<td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="<?php echo site_url('User/edit_jagung/'.$key->id_tanaman) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url('User/delete_jagung/'.$key->id_tanaman) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
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
