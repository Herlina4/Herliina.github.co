<?php 
  include "header_user.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-leaf"></i> Data Penjualan</h1>

    <a href="<?php echo site_url('User/kelola_jagung') ?>" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Penjualan</h6>
    </div>

    <?php echo form_open('User/edit_jagung/'.$this->uri->segment(3),array( 'class' => 'form-horizontal' )); ?>

    <div class="card-body">
        <div class="row">
            <?php echo validation_errors() ?>
            <?php foreach ($jagung as $key) { ?>
            <div class="form-group col-md-6">
                <label class="font-weight-bold">Pilih Lokasi</label>

                <select name="fk_lokasi" id="inputFk_lokasi" class="form-control">
                    <option value="<?php echo $key->id_lokasi ?>">
                        --<?php echo $key->id_lokasi ?>.
                        <?php echo $key->nama_lokasi ?>--
                    </option>
                    <?php foreach ($lokasi as $val) { ?>
                    <option value="<?php echo $val->id_lokasi ?>">
                        <?php echo $val->id_lokasi ?>.
                        <?php echo $val->nama_lokasi ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Nama Produk</label>

                <input autocomplete="off" type="text" name="kota" required class="form-control" value="<?php echo $key->kota ?>" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Pemasaran</label>

                <input autocomplete="off" type="text" name="pemasaran" required class="form-control" value="<?php echo $key->pemasaran ?>" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Harga Satuan</label>

                <input autocomplete="off" type="text" name="produksi" required class="form-control" value="<?php echo $key->produksi ?>" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Total Harga Jual</label>

                <input autocomplete="off" type="text" name="luas_panen" required class="form-control" value="<?php echo $key->luas_panen ?>" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Produktivitas (KG)</label>

                <input autocomplete="off" type="text" name="produktivitas" required class="form-control" value="<?php echo $key->produktivitas ?>" />
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-control">
                    <option value="<?php echo $key->tahun ?>">
                        --<?php echo $key->tahun ?>--
                    </option>
                    <?php foreach ($tahun as $val) { ?>
                    <option value="<?php echo $val->tahun ?>"><?php echo $val->tahun ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
    </div>
    <?php echo form_close(); ?>
</div>

<?php 
  include "footer.php";
?>
