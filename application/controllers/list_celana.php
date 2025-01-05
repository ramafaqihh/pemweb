<?php

defined('BASEPATH') or exit('No direct script access allowed');

class list_celana extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'refresh');
		}

		$this->load->model('M_Katalog', 'katalog');
		$this->load->model('M_JenisCelana', 'jenis_celana');
		$this->load->model('M_ListCelana', 'list_celana');  // Changed from ListCelana to list_celana
	}

	public function index()
	{
		$list_celana = $this->list_celana->getAllListCelana();

		$data = [
			'title'  => 'List Celana',
			'page'   => 'list_celana/v_listcelana',  // Changed from ListCelana to list_celana
			'list_celana' => $list_celana
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title'  => 'List Celana',
			'page'   => 'list_celana/v_addListCelana',  // Changed from ListCelana to list_celana
			'katalog' => $this->katalog->getAllKatalog(),
			'jenis_celana'   => $this->jenis_celana->getAlljenis_celana()
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('idKatalog', 'Nama Katalog', 'required');
		$this->form_validation->set_rules('idJenis_celana', 'Nama Celana', 'required');
		$this->form_validation->set_rules('jumlahCelana', 'Jumlah Celana', 'required|numeric');

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$idKatalog    = $this->input->post('idKatalog');
			$idJenis_celana      = $this->input->post('idJenis_celana');
			$jumlahCelana = $this->input->post('jumlahCelana');

			$data = [
				'idKatalog'    => $idKatalog,
				'idJenis_celana' => $idJenis_celana,
				'jumlahCelana' => $jumlahCelana
			];

			$insert = $this->list_celana->addListCelana($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
			}

			redirect('list_celana', 'refresh');
		}
	}

	public function edit($id)
	{
		$list_celana = $this->list_celana->getOneListCelana($id);

		$data = [
			'title'  => 'Edit List Celana',
			'page'   => 'list_celana/v_editListCelana',  // Changed from ListCelana to list_celana
			'list_celana' => $list_celana,
			'katalog' => $this->katalog->getAllKatalog(),
			'jenis_celana'   => $this->jenis_celana->getAlljenis_celana()
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('idKatalog', 'Nama Katalog', 'required');
		$this->form_validation->set_rules('idJenis_celana', 'Nama Celana', 'required');
		$this->form_validation->set_rules('jumlahCelana', 'Jumlah Celana', 'required|numeric');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$idKatalog    = $this->input->post('idKatalog');
			$idJenis_celana      = $this->input->post('idJenis_celana');
			$jumlahCelana = $this->input->post('jumlahCelana');

			$data = [
				'idKatalog'    => $idKatalog,
				'idJenis_celana'      => $idJenis_celana,
				'jumlahCelana' => $jumlahCelana
			];

			$update = $this->list_celana->editListCelana($id, $data);

			if ($update) {
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');

				redirect('list_celana', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diedit');

				redirect('list_celana', 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->list_celana->delete($id);

		if ($delete) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}
