<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_JenisCelana extends CI_Model
{
	public function getAlljenis_celana()
	{
		$this->db->order_by('nama_celana', 'asc');

		return $this->db->get('jenis_celana')->result();
	}

	public function addjenis_celana($data)
	{
		return $this->db->insert('jenis_celana', $data);
	}

	public function getOnejenis_celana($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('jenis_celana')->row();
	}

	public function editjenis_celana($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('jenis_celana', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('jenis_celana');
	}
}
