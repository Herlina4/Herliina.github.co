<?php 
  include "header.php";
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cubes"></i> Clustering Data </h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Masukkan Data Klaster</h6>
    </div>
<?php echo form_open('Klaster/iterasi_klaster',array(
                      'class' => 'form-horizontal'
                  )); ?>
    <div class="card-body">
	
        <div class="row">
			<div class="form-group col-md-6">
                <label class="font-weight-bold">Pilih Tahun</label>

                <select name="tahun" id="inputTahun" class="form-control" required>
          				<?php foreach ($tahun as $key) { ?>
          				<?php if ($key->tahun == $key->tahun): ?>
          					<option value="<?php echo $key->tahun ?>"><?php echo $key->tahun ?></option>
          				<?php endif ?>
          				<?php } ?>
          			</select>
            </div>
			
			<div class="form-group col-md-6">
                <label class="font-weight-bold">Jumlah Klaster</label>

                <input type="text" name="jumlah" autocomplete="off" id="inputJumlah" class="form-control" required="required" placeholder="Jumlah Klaster Harus > 3">
				<input type="hidden" name="hidden" class="form-control" value="Tahun">
            </div>
        </div>
	</div>
	
	<div class="card-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Klasterisasi</button>
        <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
    </div>
	
	<?php echo form_close(); ?>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Klaster Sebelumnya Pada Tahun <?php echo $thn ?></h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
            <tr align="center">
                <th width="5%">No</th>
                <th>Nama Lokasi</th>
                <th>Pemasaran</th>
                <th width="15%">Klaster</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1 ?>
            <?php foreach ($hasil as $key) { ?>
                <tr>
                    <td class="text-center"><?php echo $no ?></td>
                    <td><?php echo $key->nama_lokasi ?></td>
                    <td>
                        <?php
                        $klaster = substr($key->c, -1);
                        if ($klaster == 1) {
                            echo "Digital Marketing";
                        } elseif ($klaster == 2) {
                            echo "Penjualan Langsung (Pemasaran Offline)";
                        } elseif ($klaster == 3) {
                            echo "Pameran";
                        } else {
                            echo "Klaster tidak valid";
                        }
                        ?>
                    </td>
                    <td class="text-center"><?php echo $klaster; ?></td>
                    <?php $no++ ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>


<?php 
  include "footer.php";
?>