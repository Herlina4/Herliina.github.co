<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function getJagung($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getTahun()
	{
		$this->db->distinct();
		$this->db->group_by('tahun');
		return $this->db->get('tanaman')->result();
	}

	public function getLokasiById($id_lokasi)
	{
		$this->db->where('id_lokasi', $id_lokasi);
		return $this->db->get('lokasi')->result();
	}

	public function getJagungById($id_tanaman)
	{
		$this->db->where('id_tanaman', $id_tanaman);
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

	public function addLokasi()
	{
		$object = array('nama_lokasi' => $this->input->post('nama_lokasi'));
		$this->db->insert('lokasi', $object);
	}

	public function edit_lokasi($id_lokasi)
	{
		$object = array('nama_lokasi' => $this->input->post('nama_lokasi'));
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->update('lokasi', $object);
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

	public function deleteLokasi($id_lokasi)
	{
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->delete('lokasi');
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

	public function deleteJagung($id_tanaman)
	{
		$this->db->where('id_tanaman', $id_tanaman);
		$this->db->delete('tanaman');
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */