<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Personalitation extends CI_Controller
{

    public function index()
    {
        $data['breadcrumtext']  = "User Profile";
        $data['tittle']         = "Profile";
        $data['url']            = "personalitation";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_myprofile', $data);
        $this->load->view('v_admin/v_a_footer', $data);
    }

    public function change_password()
    {
        $data['breadcrumtext']  = "Change Password";
        $data['tittle']         = "Change Password";
        $data['url']            = "change_password";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_changepass', $data);
        $this->load->view('v_admin/v_a_footer', $data);
    }

    public function deactive()
    {
        $data['breadcrumtext']  = "Deactive Account";
        $data['tittle']         = "Deactive Account";
        $data['url']            = "deactive";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_deactive', $data);
        $this->load->view('v_admin/v_a_footer', $data);
    }
}
