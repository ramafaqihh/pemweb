<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_ListCelana extends CI_Model
{
	public function addListCelana($data)
	{
		return $this->db->insert('list_celana', $data);
	}

	public function getAllListCelana()
	{
		$this->db->select('list_celana.*, katalog.nama_katalog, jenis_celana.nama_celana, jenis_celana.bahan,  jenis_celana.detail, jenis_celana.gambar');
		$this->db->join('katalog', 'katalog.id = list_celana.idKatalog', 'inner');
		$this->db->join('jenis_celana', 'jenis_celana.id = list_celana.idjenis_celana', 'inner');



		return $this->db->get('list_celana')->result();
	}

	public function getOneListCelana($id)
	{
		$this->db->select('list_celana.*, katalog.nama_katalog, jenis_celana.nama_celana, jenis_celana.bahan,  jenis_celana.detail, jenis_celana.gambar');
		$this->db->join('katalog', 'katalog.id = list_celana.idKatalog', 'inner');
		$this->db->join('jenis_celana', 'jenis_celana.id = list_celana.idjenis_celana', 'inner');



		return $this->db->get('list_celana')->result();
	}

	public function editListCelana($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('list_celana', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('list_celana');
	}
}
