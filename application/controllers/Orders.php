<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');
			redirect('login', 'refresh');
		}

		$this->load->model('M_ListCelana', 'list_celana');
		$this->load->model('M_Orders', 'orders');
	}

	public function index()
	{
		$data = [
			'title'  => 'List Orders',
			'page'   => 'orders/v_orders',
			'orders' => $this->orders->getAllOrders()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$list_celana = $this->list_celana->getAllListCelana();

		$data = [
			'title'      => 'Orders',
			'page'       => 'orders/v_addOrders',
			'list_celana' => $list_celana,
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('idList_celana', 'Nama Celana', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah Order', 'required|numeric');
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('orders/add', 'refresh');
		} else {
			$idListCelana = $this->input->post('idList_celana');
			$jumlah       = $this->input->post('jumlah');
			$ukuran       = $this->input->post('ukuran');

			$data = [
				'idUser'       => $this->session->userdata('user_login')['data']->id,
				'idList_celana' => $idListCelana,
				'jumlah'       => $jumlah,
				'ukuran'       => $ukuran,
				'harga'        => (40000 * $jumlah)
			];

			$insert = $this->orders->addOrders($data);

			if ($insert) {
				$list_celana = $this->list_celana->getOneListCelana($idListCelana);

				$this->db->where('id', $idListCelana);
				$this->db->update('list_celana', ['celanaTerjual' => $list_celana->celanaTerjual + $jumlah]);

				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
				redirect('orders', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
				redirect('orders/add', 'refresh');
			}
		}
	}
}
