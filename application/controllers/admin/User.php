<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // Load facebook oauth library 
        $this->load->library('facebook');

        // Load user model 
    }


    public function index()
    {
        
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

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
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

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
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

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
