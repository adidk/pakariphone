<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->model('m_ask', 'ask');
        $this->load->library('facebook');
    }
   

    public function index()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] =$this->db->get_where('users', array('email' => $useronline))->row_array();

        $data['breadcrumtext']  = "Ask Question";
        $data['tittle']         = "Ask";
        $data['url']            = "Ask";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_ask', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_ask', $data);
    }
}
