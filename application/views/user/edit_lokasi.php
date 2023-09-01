<?php 
  include "header_user.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-map-marker-alt"></i> Data Lokasi</h1>

    <a href="<?php echo site_url('Admin/kelola_lokasi') ?>" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data Lokasi</h6>
    </div>

    <?php echo form_open('Admin/edit_lokasi/'.$this->uri->segment(3),array('class' => 'form-horizontal')); ?>

    <div class="card-body">
        <?php echo validation_errors() ?>
        <?php foreach ($lokasi as $key) { ?>
        <div class="form-group col-md-12">
            <label class="font-weight-bold">Nama Lokasi</label>

            <input autocomplete="off" type="text" name="nama_lokasi" value="<?php echo $key->nama_lokasi ?>" required class="form-control" />
        </div>
        <?php } ?>
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
