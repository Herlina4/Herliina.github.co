<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengujian extends CI_Controller {

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
				$this->load->model('Pengujian_model');
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
				$hasil = $this->Pengujian_model->getHasilKlaster();
			    // $data['admin'] = $this->Admin_model->getAdmin();
			    $data['hasil'] = $hasil;
			    foreach ($hasil as $key) {
			    	$tahun = $key->tahun;
			    }
			    $data['thn'] = $tahun;

				$this->load->view('pengujian/pengujian_view',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function mulai_pengujian()
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
				$hasilByC = $this->Pengujian_model->getHasilKlasterGroupC();
			    // $data['admin'] = $this->Admin_model->getAdmin();
			    $data['hasilByC'] = $hasilByC;

				$this->load->view('pengujian/pengujian_mulai',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

	public function lanjut_pengujian()
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
				$hasil = $this->Pengujian_model->getHasilPengujian();
			    // $data['admin'] = $this->Admin_model->getAdmin();
			    $data['hasil'] = $hasil;

				$this->load->view('pengujian/pengujian_lanjut',$data);
		}
		else{
			redirect('login','refresh');
		}
	}

}

/* End of file Pengujian.php */
/* Location: ./application/controllers/Pengujian.php */