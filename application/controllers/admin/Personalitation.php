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
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

        $data['breadcrumtext']  = "User Profile";
        $data['tittle']         = "Profile";
        $data['url']            = "personalitation";

        $this->form_validation->set_rules('notelp', 'notelp', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('v_admin/v_a_header', $data);
            $this->load->view('v_admin/v_a_sidebar', $data);
            $this->load->view('v_admin/v_a_myprofile', $data);
            $this->load->view('v_admin/v_a_footer', $data);
            $this->load->view('j_admin/j_user', $data);
        } else {

            $gender = $this->input->post('gender');
            $phone = $this->input->post('notelp');

            $ganti = array(
                'gender' => $gender,
                'phone' => $phone
            );

            $where = array(
                'email' => $data['user']['email']
            );
            // $data = $this->load->model('User');
            // $this->user->update_kategori($ganti, $where);
            $this->db->where($where);
            $this->db->update($this->tableName, $ganti);

            redirect('admin/personalitation');
        }
    }

    public function update()
    {
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();


        // $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');

        $update = array(
            'gender' => 'ojngdxx',
            // 'phone' => 
        );

        $where = array(
            'email' => $data['user']['email']
        );
        $this->db->where($where);

        return $this->db->update('users', $update)->result();
    }
    public function change_password()
    {
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

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
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();

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
