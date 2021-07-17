<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_user', 'user');
        $this->load->model('m_admin', 'admin');
    }

    public function index()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['pengguna_count']     = $this->admin->penggunacount();
                $data['pengguna_phone']     = $this->admin->penggunaphone();
                $data['pertanyaan_dijawab'] = $this->admin->pertanyaan_dijawab();


                $data['breadcrumtext']  = "Hello Admin! :)";
                $data['tittle']     = "Dashboard";
                $data['url']            = "admin";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_index', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_dashboard', $data);
            } else {
                redirect('admin/personalitation');
            }
        } else {
            redirect('auth');
        }
    }
}
