<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-leaf"></i> Data Penjualan</h1>

    <a href="<?php echo site_url('Admin/kelola_jagung') ?>" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-fw fa-plus"></i> Tambah Data Penjualan
        </h6>
    </div>

    <?php echo form_open('Admin/add_tanaman/',array( 'class' => 'form-horizontal' )); ?>

    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold">Pilih Lokasi</label>

                <select name="fk_lokasi" id="inputFk_lokasi" class="form-control">
                    <?php foreach ($lokasi as $key) { ?>
                    <option value="<?php echo $key->id_lokasi ?>">
                        <?php echo $key->id_lokasi ?>.
                        <?php echo $key->nama_lokasi ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Nama Produk</label>

                <input autocomplete="off" type="text" name="kota" required class="form-control" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Pemasaran</label>

                <input autocomplete="off" type="text" name="pemasaran" required class="form-control" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Harga Satuan</label>

                <input autocomplete="off" type="text" name="produksi" required class="form-control" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Total Harga Jual (Tahun)</label>

                <input autocomplete="off" type="text" name="luas_panen" required class="form-control" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Produksi (Kg)</label>

                <input autocomplete="off" type="text" name="produktivitas" required class="form-control" />
            </div>
			
			<div class="form-group col-md-6">
                <label class="font-weight-bold">Pilih Tahun</label>

                <select name="tahun" id="tahun" class="form-control">
                    <option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
					<option value="2022">2022</option>
					<option value="2023">2023</option>
					<option value="2024">2024</option>
                </select>
            </div>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
    </div>
    <?php echo form_close(); ?>
</div>

<?php 
  include "footer.php";
?>