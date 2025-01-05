<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Orders extends CI_Model
{
	public function getAllOrders($where = null)
	{
		$this->db->select('orders.*, user.nama,  jenis_celana.nama_celana, katalog.nama_katalog');

		$this->db->join('user', 'user.id = orders.idUser', 'inner');
		$this->db->join('list_celana', 'list_celana.id = orders.idlist_celana', 'inner');
		$this->db->join('katalog', 'katalog.id = list_celana.idKatalog', 'inner');
		$this->db->join('jenis_celana', 'jenis_celana.id = list_celana.idJenis_celana', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		$this->db->order_by('orders.createdAt', 'desc');

		return $this->db->get('orders')->result();
	}

	public function addOrders($data)
	{
		return $this->db->insert('orders', $data);
	}

	public function getOneOrders($where)
	{
		$this->db->select('orders.*, user.nama,  jenis_celana.nama_celana, katalog.nama_katalog');

		$this->db->join('user', 'user.id = orders.idUser', 'inner');
		$this->db->join('list_celana', 'list_celana.id = orders.idListCelana', 'inner');
		$this->db->join('katalog', 'katalog.id = list_celana.idKatalog', 'inner');
		$this->db->join('jenis_celana', 'jenis_celana.id = list_celana.idJenis_celana', 'inner');

		if ($where) {
			$this->db->where($where);
		}

		return $this->db->get('orders')->row();
	}

	public function updateOrders($data, $where)
	{
		$this->db->where($where);

		return $this->db->update('orders', $data);
	}

	public function deleteOrders($where)
	{
		return $this->db->delete('orders', $where);
	}
}
/* End of file M_Orders.php */
