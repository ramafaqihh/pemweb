<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_celana extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('user_login'))) {
			$this->session->set_flashdata('error', 'Anda belum login');

			redirect('login', 'resfresh');
		}

		$this->load->model('M_JenisCelana', 'jenis_celana');
	}

	public function index()
	{
		$data = [
			'title' => 'Jenis Celana',
			'page'  => 'jenis_celana/v_JenisCelana',
			'jenis_celana'  => $this->jenis_celana->getAlljenis_celana()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'title' => 'Jenis Celana',
			'page'  => 'jenis_celana/v_addJenisCelana'
		];

		$this->load->view('index', $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('nama_celana', 'Nama Celana', 'required', [
			'required' => 'Nama Celana  tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('bahan', 'Bahan Celana', 'required', [
			'required' => 'Bahan Celana tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {
			$nama_celana    = $this->input->post('nama_celana');
			$bahan    = $this->input->post('bahan');

			$detail = $this->input->post('detail');

			$upload_gambar = $_FILES['gambar']['name'];

			if ($upload_gambar) {
				$this->load->library('upload');
				$config['upload_path']   = './upload/gambar';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 3072;               // 3 mb
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = true;
				$config['encrypt_name']  = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());

					redirect('jenis_celana', 'refresh');
				} else {
					$upload_data = $this->upload->data();

					$data = [
						'nama_celana'    => $nama_celana,
						'bahan'    => $bahan,

						'detail' => $detail,
						'gambar'   => $upload_data['file_name']
					];
				}
			} else {
				$data = [
					'nama_celana'    => $nama_celana,
					'bahan'    => $bahan,

					'detail' => $detail,
				];
			}

			$insert = $this->jenis_celana->addjenis_celana($data);

			if ($insert) {
				$this->session->set_flashdata('sukses', 'Data berhasil disimpan');
			} else {
				$this->session->set_flashdata('error', 'Data gagal disimpan!');
			}

			redirect('jenis_celana', 'refresh');
		}
	}

	public function edit($id)
	{
		$jenis_celana = $this->jenis_celana->getOnejenis_celana($id);

		$data = [
			'title' => 'Edit Jenis Celana',
			'page'  => 'jenis_celana/v_editJenisCelana',
			'jenis_celana'  => $jenis_celana
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');

		$this->form_validation->set_rules('nama_celana', 'Nama Celana', 'required', [
			'required' => 'Nama Celana tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('bahan', 'Bahan Celana', 'required', [
			'required' => 'Bahan Celana tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('detail', 'Detail', 'required');

		if ($this->form_validation->run() == false) {
			$this->edit($id);
		} else {
			$nama_celana    = $this->input->post('nama_celana');
			$bahan    = $this->input->post('bahan');

			$detail = $this->input->post('detail');

			$upload_gambar = $_FILES['gambar']['name'];

			if ($upload_gambar) {
				$this->load->library('upload');
				$config['upload_path']   = './upload/gambar';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 3072;               // 3 mb
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = true;
				$config['encrypt_name']  = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());

					redirect('jenis_celana', 'refresh');
				} else {
					$upload_data = $this->upload->data();

					$data = [
						'nama_celana'    => $nama_celana,
						'bahan'    => $bahan,

						'detail' => $detail,
						'gambar'   => $upload_data['file_name']
					];
				}
			} else {
				$data = [
					'nama_celana'    => $nama_celana,
					'bahan'    => $bahan,

					'detail' => $detail,
				];
			}

			$jenis_celana = $this->jenis_celana->getOnejenis_celana($id);

			$update = $this->jenis_celana->editjenis_celana($id, $data);

			if ($update) {
				if ($upload_gambar) {
					$path = FCPATH . 'upload/gambar/';

					if ($jenis_celana->gambar != NULL) {
						unlink($path . $jenis_celana->gambar);
					}
				}

				$this->session->set_flashdata('sukses', 'Data berhasil diedit');
			} else {
				$this->session->set_flashdata('error', 'Data gagal diedit');
			}

			redirect('jenis_celana', 'refresh');
		}
	}

	public function delete($id)
	{
		$jenis_celana = $this->jenis_celana->getOnejenis_celana($id);
		$delete = $this->jenis_celana->delete($id);

		if ($delete) {
			$path = FCPATH . 'upload/gambar/';

			if ($jenis_celana->gambar != NULL) {
				unlink($path . $jenis_celana->gambar);
			}

			$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Data gagal dihapus');
		}

		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}

/* End of file Jenis_celana.php */
