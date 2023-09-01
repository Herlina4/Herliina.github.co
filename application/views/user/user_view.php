<?php 
  include "header_user.php";
?>

<div class="mb-4">

		  <!-- Page Heading -->
      <div class="jumbotron"></div>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-home"></i> Dashboard</h1>
          </div>
		  
		  <!-- Content Row -->
		  <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            Selamat datang <strong><?php echo $nama; ?></strong> Anda bisa mengoperasikan sistem dengan wewenang tertentu melalui pilihan menu di bawah.
          </div>
		  <div class="row">
		  
		  <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?php echo site_url('User/kelola_lokasi') ?>" class="text-secondary text-decoration-none">Data Lokasi</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-leaf fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <!-- <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?php echo site_url('Klaster') ?>" class="text-secondary text-decoration-none">Data Pengelompokan</a></div> -->
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?php echo site_url('User/kelola_jagung') ?>" class="text-secondary text-decoration-none">Data Penjualan</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cubes fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<!-- <div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?php echo site_url('Pengujian') ?>" class="text-secondary text-decoration-none">Data Pengujian</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-tools fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
			
			<div class="col-xl-6 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="<?php echo site_url('User/grafik') ?>" class="text-secondary text-decoration-none">Data Grafik</a></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chart-area fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			</div>
</div>
	
<?php 
  include "footer.php";
?>