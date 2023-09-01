<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaster_model extends CI_Model {

	public function getTahun()
	{
		$this->db->distinct();
		$this->db->group_by('tahun');
		return $this->db->get('tanaman')->result();
	}

	public function getJagung($tahun)
	{
		$this->db->where('tahun', $tahun);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getJagungRand($tahun,$limit)
	{
		$this->db->where('tahun', $tahun);
		$this->db->order_by('rand()');
    	$this->db->limit($limit);
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join');
		return $this->db->get('tanaman')->result();
	}

	public function getIterasi($iterasi)
	{
		$this->db->where('iterasi', $iterasi);
		return $this->db->get('hasil_iterasi')->result();
	}

	public function getCentroidTempByIterasi()
	{
		$this->db->group_by('iterasi');
		return $this->db->get('centroid_temp')->result();
	}

	public function getCentroidTemp()
	{
		return $this->db->get('centroid_temp')->result();
	}

	public function getHasilIterasi()
	{
		return $this->db->get('hasil_iterasi')->result();
	}

	public function getCentroidTempByC()
	{
		$this->db->group_by('c');
		return $this->db->get('centroid_temp')->result();
	}

	public function getHasilKlaster()
	{
		$this->db->join('tanaman', 'tanaman.id_tanaman = hasil_klaster.fk_tanaman', 'join');
		$this->db->join('lokasi', 'lokasi.id_lokasi = tanaman.fk_lokasi', 'join'); 
		return $this->db->get('hasil_klaster')->result();
	}

}

/* End of file Klaster_model.php */
/* Location: ./application/models/Klaster_model.php */