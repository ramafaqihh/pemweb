<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}

		// memanggil model dengan nama M_User dan di rename menjadi katalog
		$this->load->model('M_Katalog', 'katalog');
	}

	public function index()
	{
		$data = [
			'title'  => 'Katalog',
			'page'   => 'katalog/v_katalog',
			'katalog' => $this->katalog->getAllKatalog()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Katalog',
			'page'  => 'katalog/v_addKatalog'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('nama_katalog', 'Nama Katalog', 'required', [
			'required' => 'Nama katalog tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$nama_katalog = $this->input->post('nama_katalog');

			$data = [
				'nama_katalog' => $nama_katalog
			];

			$insert = $this->katalog->addKatalog($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');

				redirect('katalog', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');

				redirect('katalog', 'refresh');
			}
		}
	}

	public function edit($id)
	{
		$katalog = $this->katalog->getOneKatalog($id);

		$data = [
			'title'  => 'Edit Katalog',
			'page'   => 'katalog/v_editKatalog',
			'katalog' => $katalog
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('nama_katalog', 'Nama Katalog', 'required', [
			'required' => 'Nama katalog harus diisi!'
		]);

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$nama_katalog = $this->input->post('nama_katalog');

			$data = [
				'nama_katalog' => $nama_katalog
			];

			$update = $this->katalog->editKatalog($id, $data);

			if ($update) {
				$this->session->set_flashdata('sukses', 'Data berhasil diedit');

				redirect('katalog', 'refresh');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diedit');

				redirect('katalog', 'refresh');
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->katalog->delete($id);

		if ($delete) {
			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');

			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}
	}
}
