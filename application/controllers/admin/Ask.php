<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_ask', 'ask');
    }

    public function index()
    {
        $data['breadcrumtext']  = "Ask Question";
        $data['tittle']         = "Ask";
        $data['url']            = "Ask";

        $data['cekkerusakan'] = $this->ask->getdamage();
        $data['device'] = $this->ask->getdevice();

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_ask', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_ask', $data);
    }
}
