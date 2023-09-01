<?php 
  include "header.php";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-map-marker-alt"></i> Data Lokasi</h1>

    <a href="<?php echo site_url('Admin/tambah_lokasi') ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Lokasi</h6>
    </div>

    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
                <tr align="center">
                    <th width="5%">No</th>
                    <th>Nama Lokasi</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($lokasi as $key) { ?>
                <tr>
                    <td class="text-center"><?php echo $no ?></td>
                    <td><?php echo $key->nama_lokasi ?></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="<?php echo site_url('Admin/edit_lokasi/'.$key->id_lokasi) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo site_url('Admin/delete_lokasi/'.$key->id_lokasi) ?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
