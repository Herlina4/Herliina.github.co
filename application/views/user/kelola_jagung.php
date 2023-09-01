<?php 
  include "header_user.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-leaf"></i> Data Penjualan</h1>

    <a href="<?php echo site_url('User/add_tanaman') ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
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

<?php 
  include "footer.php";
?>
