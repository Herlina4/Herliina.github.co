<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function getAdmin()
	{
		$this->db->where('level', '1');
		return $this->db->get('user')->result();
	}

	public function getUser()
	{
		$this->db->where('level', '2');
		return $this->db->get('user')->result();
	}

	public function getJagung($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getJagungByLokasi($lokasi)
	{
		$this->db->where('fk_lokasi', $lokasi);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getLokasi()
	{
		return $this->db->get('lokasi')->result();
	}

	public function getTahun()
	{
		$this->db->distinct();
		$this->db->group_by('tahun');
		return $this->db->get('tanaman')->result();
	}

	public function addAdmin()
	{
		$object = array('username' => $this->input->post('username'),
			'password' => base64_encode($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'level' => '1' );
		$this->db->insert('user', $object);
	}

	public function AddTanaman()
	{
		$object = array('fk_lokasi' => $this->input->post('fk_lokasi'),
			'kota' => $this->input->post('kota'),
			'pemasaran' => $this->input->post('pemasaran'),
			'produksi' => $this->input->post('produksi'),
			'luas_panen' => $this->input->post('luas_panen'),
			'produktivitas' => $this->input->post('produktivitas'),
			'tahun' =>$this->input->post('tahun'));
		$this->db->insert('tanaman', $object);
	}

	public function addJagung($tahun)
	{
		$object = array('fk_lokasi' => $this->input->post('fk_lokasi'),
			'kota' => $this->input->post('kota'),
			'pemasaran' => $this->input->post('pemasaran'),
			'produksi' => $this->input->post('produksi'),
			'luas_panen' => $this->input->post('luas_panen'),
			'produktivitas' => $this->input->post('produktivitas'),
			'tahun' =>$tahun );
		$this->db->insert('tanaman', $object);
	}

	public function addUser()
	{
		$object = array('username' => $this->input->post('username'),
			'password' => base64_encode($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'level' => '2' );
		$this->db->insert('user', $object);
	}

	public function addLokasi()
	{
		$object = array('nama_lokasi' => $this->input->post('nama_lokasi'));
		$this->db->insert('lokasi', $object);
	}

	public function deleteUser($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('user');
	}

	public function deleteLokasi($id_lokasi)
	{
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->delete('lokasi');
	}

	public function deleteJagung($id_tanaman)
	{
		$this->db->where('id_tanaman', $id_tanaman);
		$this->db->delete('tanaman');
	}

	public function getAdminById($id_user)
	{
		$this->db->where('id_user', $id_user);
		// $this->db->where('level', '1');
		return $this->db->get('user')->result();
	}

	public function getUserById($id_user)
	{
		$this->db->where('id_user', $id_user);
		// $this->db->where('level', '2');
		return $this->db->get('user')->result();
	}

	public function getJagungById($id_tanaman)
	{
		$this->db->where('id_tanaman', $id_tanaman);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getLokasiById($id_lokasi)
	{
		$this->db->where('id_lokasi', $id_lokasi);
		return $this->db->get('lokasi')->result();
	}

	public function edit_admin($id_admin)
	{
		$object = array('username' => $this->input->post('username'),
			'password' => base64_encode($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'level' => '1' );
		$this->db->where('id_user', $id_admin);
		$this->db->update('user', $object);
	}

	public function edit_jagung($id_tanaman)
	{
		$object = array('fk_lokasi' => $this->input->post('fk_lokasi'),
			'kota' => $this->input->post('kota'),
			'pemasaran' => $this->input->post('pemasaran'),
			'produksi' => $this->input->post('produksi'),
			'luas_panen' => $this->input->post('luas_panen'),
			'produktivitas' => $this->input->post('produktivitas'),
			'tahun' => $this->input->post('tahun') );
		$this->db->where('id_tanaman', $id_tanaman);
		$this->db->update('tanaman', $object);
	}

	public function edit_user($id_user)
	{
		$object = array('username' => $this->input->post('username'),
			'password' => base64_encode($this->input->post('password')),
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'level' => '2' );
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $object);
	}

	public function edit_lokasi($id_lokasi)
	{
		$object = array('nama_lokasi' => $this->input->post('nama_lokasi'));
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->update('lokasi', $object);
	}

	public function upload_file($filename){
	    $this->load->library('upload'); // Load librari upload
	    
	    $config['upload_path'] = './excel/';
	    $config['allowed_types'] = 'xlsx';
	    $config['max_size']  = '2048';
	    $config['overwrite'] = true;
	    $config['file_name'] = $filename;
	  
	    $this->upload->initialize($config); // Load konfigurasi uploadnya
	    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
	      // Jika berhasil :
	      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	      return $return;
	    }else{
	      // Jika gagal :
	      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	      return $return;
	    }
	  }

	  public function insert_multiple($data){
	    $this->db->insert_batch('tanaman', $data);
	  }

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */