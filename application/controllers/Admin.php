<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $filename = "import_data";

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$this->load->helper('url','form','file');
				$this->load->library('form_validation');
				$this->load->model('Admin_model');
				$this->load->library('curl');
		}
		else{
			redirect('login','refresh');
		}
	}
	
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];
				$data['nama'] = $nama;
				
				if ($level == 1) {
					$this->load->view('admin/admin_view',$data);
				}
				elseif ($level == 2) {
					redirect('User','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function grafik()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasi();
			    // $data['admin'] = $this->Admin_model->getAdmin();

				if ($level == 1) {
					$this->load->view('admin/grafik',$data);
				}
				elseif ($level == 2) {
					redirect('User','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function filter_grafik()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['lokasi'] = $this->Admin_model->getLokasi();
			    $this->form_validation->set_rules('hidden', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('admin/admin_view', $data);
			    } else {
			    	$lokasi = $this->input->post('lokasi');
			    	$data['jagung'] = $this->Admin_model->getJagungByLokasi($lokasi);
			    	$data['lks'] = $lokasi;
			    	$this->load->view('admin/admin_filter',$data);
			    }
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_admin()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['admin'] = $this->Admin_model->getAdmin();

				$this->load->view('admin/kelola_admin',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_user()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['user'] = $this->Admin_model->getUser();

				$this->load->view('admin/kelola_user',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_lokasi()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['lokasi'] = $this->Admin_model->getLokasi();

				$this->load->view('admin/kelola_lokasi',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function kelola_jagung()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['tahun'] = $this->Admin_model->getTahun();

				$this->load->view('admin/kelola_jagung',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function filter_jagung()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $data['tahun'] = $this->Admin_model->getTahun();
			    $this->form_validation->set_rules('hidden', 'Tahun', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('admin/kelola_jagung', $data);
			    } else {
			    	$tahun = $this->input->post('tahun');
			    	$data['jagung'] = $this->Admin_model->getJagung($tahun);
			    	$data['thn'] = $tahun;
			    	$this->load->view('admin/kelola_jagung_filter',$data);
			    }
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_admin()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['tahun'] = $this->Admin_model->getTahun();
			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_admin',$data);
				}
				else
				{
					$this->Admin_model->addAdmin();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_user()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_user',$data);
				}
				else
				{
					$this->Admin_model->addUser();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}
	
	public function add_tanaman()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
			    $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
			    $this->form_validation->set_rules('pemasaran', 'Pemasaran', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');
				$this->form_validation->set_rules('tahun', 'Tahun', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/add_tanaman',$data);
				}
				else
				{
					$this->Admin_model->AddTanaman();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_jagung($tahun)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
			    $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_jagung',$data);
				}
				else
				{
					$this->Admin_model->addJagung($tahun);
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function tambah_lokasi()
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
			    $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/tambah_lokasi',$data);
				}
				else
				{
					$this->Admin_model->addLokasi();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_admin($id_admin)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteUser($id_admin);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_user($id)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteUser($id);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_lokasi($id_lokasi)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteLokasi($id_lokasi);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function delete_jagung($id_tanaman)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

					$this->Admin_model->deleteJagung($id_tanaman);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_lokasi($id_lokasi)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->Admin_model->getLokasiById($id_lokasi);

			    $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_lokasi',$data);
				}
				else
				{
					$this->Admin_model->edit_lokasi($id_lokasi);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_lokasi','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_admin($id_admin)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['admin'] = $this->Admin_model->getAdminById($id_admin);

			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_admin',$data);
				}
				else
				{
					$this->Admin_model->edit_admin($id_admin);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_admin','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_user($id)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['user'] = $this->Admin_model->getUserById($id);

			    $this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_user',$data);
				}
				else
				{
					$this->Admin_model->edit_user($id);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_user','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	public function edit_jagung($id_tanaman)
	{
		if ($this->session->userdata('logged_in')) {
				$session_data = $this->session->userdata('logged_in');
				$id_user = $session_data['id_user'];
				$username = $session_data['username'];
				$password = $session_data['password'];
				$nama = $session_data['nama'];
				$email = $session_data['email'];
				$level = $session_data['level'];

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['jagung'] = $this->Admin_model->getJagungById($id_tanaman);
				$data['tahun'] = $this->Admin_model->getTahun();
				$data['lokasi'] = $this->Admin_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
			    $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
			    $this->form_validation->set_rules('pemasaran', 'Pemasaran', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('admin/edit_jagung',$data);
				}
				else
				{
					$this->Admin_model->edit_jagung($id_tanaman);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('Admin/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

}