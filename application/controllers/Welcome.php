<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function kebijakan_privasi()
	{
		$this->load->view('kebijakan_privasi');
	}

	public function ketentuan_layanan()
	{
		$this->load->view('ketentuan_layanan');
	}

	public function penghapusan_data()
	{
		$this->load->view('penghapusan_data');
	}
	public function tentang_kami()
	{
		$this->load->view('tentang_kami');
	}
}
