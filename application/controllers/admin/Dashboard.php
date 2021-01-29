<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $this->load->view('v_admin/v_a_header');
        $this->load->view('v_admin/v_a_index');
        $this->load->view('v_admin/v_a_footer');
    }
}
