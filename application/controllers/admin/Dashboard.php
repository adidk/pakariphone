<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $data['breadcrumtext']  = "Hello Admin! :)";
        $data['tittle']     = "Dashboard";
        $data['url']            = "admin";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_index', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_dashboard', $data);
    }
}
