<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Katalog extends CI_Model
{
	public function getAllKatalog()
	{
		$this->db->order_by('nama_katalog', 'asc');

		return $this->db->get('katalog')->result();
	}

	// untuk tambah data katalog
	public function addKatalog($data)
	{
		return $this->db->insert('katalog', $data);
	}

	// mengambil 1 data katalog berdasarkan id
	public function getOneKatalog($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('katalog')->row();
	}

	// untuk edit data katalog
	public function editKatalog($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('katalog', $data);
	}

	// untuk hapus data katalog
	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('katalog');
	}
}
