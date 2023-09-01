<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
				$this->load->model('User_model');
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

				$data['level'] = $level;
				$data['nama'] = $nama;
				$data['lokasi'] = $this->User_model->getLokasi();
			    // $data['admin'] = $this->Admin_model->getAdmin();

				$this->load->view('user/user_view',$data);
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
				$data['lokasi'] = $this->User_model->getLokasi();
			    // $data['admin'] = $this->Admin_model->getAdmin();

				$this->load->view('user/grafik',$data);
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
			    $data['lokasi'] = $this->User_model->getLokasi();
			    $this->form_validation->set_rules('hidden', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('user/user_view', $data);
			    } else {
			    	$lokasi = $this->input->post('lokasi');
			    	$data['jagung'] = $this->User_model->getJagungByLokasi($lokasi);
			    	$data['lks'] = $lokasi;
			    	$this->load->view('user/user_filter',$data);
			    }
		}
		else{
			redirect('login','refresh');
		}
	}

	public function jagung()
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
			    $data['tahun'] = $this->User_model->getTahun();

				$this->load->view('user/jagung',$data);
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
			    $data['tahun'] = $this->User_model->getTahun();
			    $this->form_validation->set_rules('hidden', 'Tahun', 'trim|required');

			    if ($this->form_validation->run() == FALSE) {
			    	$data['error'] = "Pilih Tahun";
			    	$this->load->view('User/kelola_jagung', $data);
			    } else {
			    	$tahun = $this->input->post('tahun');
			    	$data['jagung'] = $this->User_model->getJagung($tahun);
			    	$data['thn'] = $tahun;
			    	$this->load->view('user/kelola_jagung_filter',$data);
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
				$data['lokasi'] = $this->User_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
			    $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
			    $this->form_validation->set_rules('pemasaran', 'Pemasaran', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('user/tambah_jagung',$data);
				}
				else
				{
					$this->User_model->addJagung($tahun);
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('User/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}

	// public function filter_jagung()
	// {
	// 	if ($this->session->userdata('logged_in')) {
	// 			$session_data = $this->session->userdata('logged_in');
	// 			$id_user = $session_data['id_user'];
	// 			$username = $session_data['username'];
	// 			$password = $session_data['password'];
	// 			$nama = $session_data['nama'];
	// 			$email = $session_data['email'];
	// 			$level = $session_data['level'];

	// 			$data['level'] = $level;
	// 			$data['nama'] = $nama;
	// 		    $data['tahun'] = $this->User_model->getTahun();
	// 		    $this->form_validation->set_rules('hidden', 'Tahun', 'trim|required');

	// 		    if ($this->form_validation->run() == FALSE) {
	// 		    	$data['error'] = "Pilih Tahun";
	// 		    	$this->load->view('user/jagung', $data);
	// 		    } else {
	// 		    	$tahun = $this->input->post('tahun');
	// 		    	$data['jagung'] = $this->User_model->getJagung($tahun);
	// 		    	$data['thn'] = $tahun;
	// 		    	$this->load->view('user/jagung_filter',$data);
	// 		    }
	// 	}
	// 	else{
	// 		redirect('login','refresh');
	// 	}
	// }

	public function cetak($tahun)
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
			    $data['tahun'] = $this->User_model->getTahun();
			    $data['jagung'] = $this->User_model->getJagung($tahun);
			    $data['thn'] = $tahun;
			    $this->load->view('user/cetak',$data);
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
			    $data['lokasi'] = $this->User_model->getLokasi();

				$this->load->view('user/kelola_lokasi',$data);
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
			    $data['tahun'] = $this->User_model->getTahun();

				$this->load->view('user/kelola_jagung',$data);
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
					$this->load->view('user/tambah_lokasi',$data);
				}
				else
				{
					$this->User_model->addLokasi();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('User/kelola_lokasi','refresh');
				}
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
				$data['lokasi'] = $this->User_model->getLokasiById($id_lokasi);

			    $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('user/edit_lokasi',$data);
				}
				else
				{
					$this->User_model->edit_lokasi($id_lokasi);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('User/kelola_lokasi','refresh');
				}
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

					$this->User_model->deleteLokasi($id_lokasi);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('User/kelola_lokasi','refresh');
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
				$data['lokasi'] = $this->User_model->getLokasi();

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
					$this->load->view('User/add_tanaman',$data);
				}
				else
				{
					$this->User_model->AddTanaman();
					echo "<script>alert('Tambah Data Berhasil')</script>";
					redirect('User/kelola_jagung','refresh');
				}
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

					$this->User_model->deleteJagung($id_tanaman);
					echo "<script>alert('Hapus Data Berhasil')</script>";
					redirect('User/kelola_jagung','refresh');
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
				$data['jagung'] = $this->User_model->getJagungById($id_tanaman);
				$data['tahun'] = $this->User_model->getTahun();
				$data['lokasi'] = $this->User_model->getLokasi();

			    $this->form_validation->set_rules('fk_lokasi', 'Lokasi', 'trim|required');
			    $this->form_validation->set_rules('kota', 'Kota', 'trim|required');
			    $this->form_validation->set_rules('pemasaran', 'Pemasaran', 'trim|required');
				$this->form_validation->set_rules('produksi', 'Produksi', 'trim|required');
				$this->form_validation->set_rules('luas_panen', 'Luas Panen', 'trim|required');
				$this->form_validation->set_rules('produktivitas', 'Produktivitas', 'trim|required');

			    if ($this->form_validation->run()==FALSE)
				{
					$data['error'] = "Data Harus Lengkap";
					$this->load->view('User/edit_jagung',$data);
				}
				else
				{
					$this->User_model->edit_jagung($id_tanaman);
					echo "<script>alert('Update Data Berhasil')</script>";
					redirect('User/kelola_jagung','refresh');
				}
		}
		else{
			redirect('login','refresh');
		}
	}
}
/* End of file User.php */
/* Location: ./application/controllers/User.php */