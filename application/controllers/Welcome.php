<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('login_user');
	}

	public function kebijakan_privasi()
	{
		$this->load->view('kebijakan_privasi');
	}

	public function penghapusan_data()
	{
		$this->load->view('penghapusan_data');
	}
}
