<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengujian_model extends CI_Model {

	public function getHasilKlaster()
	{
		$this->db->join('tanaman', 'tanaman.id_tanaman = hasil_klaster.fk_tanaman', 'join');
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join'); 
		return $this->db->get('hasil_klaster')->result();
	}

	public function getHasilKlasterGroupC()
	{
		$this->db->group_by('c');
		$this->db->join('tanaman', 'tanaman.id_tanaman = hasil_klaster.fk_tanaman', 'join');
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join'); 
		return $this->db->get('hasil_klaster')->result();
	}

	public function getHasilPengujian()
	{
		return $this->db->get('hasil_pengujian')->result();
	}

}

/* End of file Pengujian_model.php */
/* Location: ./application/models/Pengujian_model.php */