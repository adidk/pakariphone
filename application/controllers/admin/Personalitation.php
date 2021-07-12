<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personalitation extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Load facebook oauth library 
        $this->load->library('facebook');

        // Load user model 
        $this->load->model('user');
    }

    public function index()
    {
        $data['datauser'] = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

        $data['breadcrumtext']  = "User Profile";
        $data['tittle']         = "Profile";
        $data['url']            = "personalitation";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_myprofile', $data);
        $this->load->view('v_admin/v_a_footer', $data);
        $this->load->view('j_admin/j_user', $data);
    }

    public function change_password()
    {
        $data['datauser'] = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

        $data['breadcrumtext']  = "Change Password";
        $data['tittle']         = "Change Password";
        $data['url']            = "change_password";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_changepass', $data);
        $this->load->view('v_admin/v_a_footer', $data);
        $this->load->view('j_admin/j_changepassword', $data);
    }

    public function deactive()
    {
        $data['datauser'] = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

        $data['breadcrumtext']  = "Deactive Account";
        $data['tittle']         = "Deactive Account";
        $data['url']            = "deactive";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_deactive', $data);
        $this->load->view('v_admin/v_a_footer', $data);
        $this->load->view('j_admin/j_deactive', $data);
    }
}
