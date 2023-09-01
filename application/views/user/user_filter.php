<?php
        foreach($jagung as $data){
            $tahun[] = $data->tahun;
            $produksi[] = (float) $data->produksi;
            $produktivitas[] = (float) $data->produktivitas;
            $luas_panen[] = (float) $data->luas_panen;
            $nama_lokasi = $data->nama_lokasi;
        }
?>


<?php 
  include "header_user.php";
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

<div class="card shadow mb-4">
                <!-- /.card-header -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-chart-area"></i> Data Grafik</h6>
                </div>

                <div class="card-body">
                    <h5>
                        Grafik Data Produksi (Kg) di
                        <?php echo $nama_lokasi ?>
                    </h5>
                    <div class="chart-area mb-5">
                        <canvas id="canvas1"></canvas>
                    </div>

                    <h5>
                        Grafik Data Harga Satuan di
                        <?php echo $nama_lokasi ?>
                    </h5>
                    <div class="chart-area mb-5">
                        <canvas id="canvas2"></canvas>
                    </div>

                    <h5>
                        Grafik Data Total Harga Jual (Tahun) di
                        <?php echo $nama_lokasi ?>
                    </h5>
                    <div class="chart-area">
                        <canvas id="canvas3"></canvas>
                    </div>
                </div>
            </div>



<?php 
  include "footer.php";
?>
