<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load user model 
        $this->load->model('m_user', 'user');
    }


    public function index()
    {

        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Users Data";
                $data['url']            = "user";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_cuser', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function facebook_user()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Facebook Users";
                $data['url']            = "facebook_user";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_userfacebook', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function phone_user()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Phone Number Users";
                $data['url']            = "phone_user";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_userphone', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }
}
