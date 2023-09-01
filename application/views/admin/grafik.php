<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-chart-area"></i> Data Grafik</h1>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Filter Berdasarkan Lokasi</h6>
    </div>

    <div class="card-body">
	<?php echo form_open('Admin/filter_grafik',array(
                      'class' =>
                    'form-horizontal' )); ?>
        <div class="row">
            <div class="input-group mb-3 col-10">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Pilih Lokasi</label>
                </div>
				<select name="lokasi" id="inputTahun" class="custom-select" required=>

							<?php foreach ($lokasi as $key) { ?>
								<option value="<?php echo $key->id_lokasi ?>"><?php echo $key->nama_lokasi ?></option>
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

<?php 
  include "footer.php";
?>