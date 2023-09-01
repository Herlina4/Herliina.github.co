<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users-cog"></i> Data User</h1>

    <a href="<?php echo site_url('Admin/kelola_user') ?>" class="btn btn-secondary"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-fw fa-edit"></i> Edit Data User</h6>
    </div>
    <?php echo form_open('Admin/edit_user/'.$this->uri->segment(3),array(
                      'class' => 'form-horizontal'
                  )); ?>
              <?php echo validation_errors() ?>
              <?php foreach ($user as $key) { ?>

    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="font-weight-bold">Username</label>

                <input autocomplete="off" type="text" name="username" required class="form-control" value="<?php echo $key->username ?>"/>
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Password</label>

                <input autocomplete="off" type="password" name="password" required class="form-control" value="<?php echo base64_decode($key->password) ?>"/>
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">Nama</label>

                <input autocomplete="off" type="text" name="nama" required class="form-control" value="<?php echo $key->nama ?>"/>
            </div>

            <div class="form-group col-md-6">
                <label class="font-weight-bold">E-Mail</label>

                <input autocomplete="off" type="text" name="email" required class="form-control" value="<?php echo $key->email?>"/>
            </div>
        </div>
    </div>
	<?php } ?>

    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>
    </div>
    <?php echo form_close(); ?>
</div>

<?php 
  include "footer.php";
?>