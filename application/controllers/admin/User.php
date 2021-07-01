<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function index()
    {
        $data['breadcrumtext']  = "Users";
        $data['tittle']         = "Users Data";
        $data['url']            = "user";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_user', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_cuser', $data);
    }

    public function facebook_user()
    {
        $data['breadcrumtext']  = "Users";
        $data['tittle']         = "Facebook Users";
        $data['url']            = "facebook_user";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_user', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_userfacebook', $data);
    }

    public function phone_user()
    {
        $data['breadcrumtext']  = "Users";
        $data['tittle']         = "Phone Number Users";
        $data['url']            = "phone_user";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_user', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_userphone', $data);
    }
}
