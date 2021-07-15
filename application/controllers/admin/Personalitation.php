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


        if ($data['user']['gender'] == 'Perempuan') {
            $data['perempuan'] = 'checked';
            $data['lakilaki'] = 'unchecked';
        } else {
            $data['lakilaki'] = 'checked';
            $data['perempuan'] = 'unchecked';
        }
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('v_admin/v_a_header', $data);
            $this->load->view('v_admin/v_a_sidebar', $data);
            $this->load->view('v_admin/v_a_myprofile', $data);
            $this->load->view('v_admin/v_a_footer', $data);
            $this->load->view('j_admin/j_user', $data);
        } else {


            $gender = $this->input->post('gender');
            $phone = $this->input->post('phone');
            $update = array(
                'phone' => $phone,
                'gender' => $gender
            );

            $where = array(
                'email' => $data['user']['email']
            );
            $this->user->update_kategori($where, $update);
            redirect('admin/personalitation');
        }
    }

    public function change_password()
    {
        $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
        $data['user'] = $this->db->get_where('users', array('email' => $useronline['email']))->row_array();
        $data['breadcrumtext']  = "Change Password";
        $data['tittle']         = "Change Password";
        $data['url']            = "change_password";

        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]', [
            'min_length' =>  'Password minimal 5 karakter'
        ]);
        $this->form_validation->set_rules(
            'password1',
            'Password Confirmation',
            'required|matches[password]',
            [
                'matches'   =>  'Password tidak sama'
            ]
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('v_admin/v_a_header', $data);
            $this->load->view('v_admin/v_a_sidebar', $data);
            $this->load->view('v_admin/v_a_changepass', $data);
            $this->load->view('v_admin/v_a_footer', $data);
            $this->load->view('j_admin/j_user', $data);
        } else {

            $password = $this->input->post('password');
            $update = array(
                'password' => password_hash($password, PASSWORD_DEFAULT)
            );

            $where = array(
                'email' => $data['user']['email']
            );
            $this->user->update_kategori($where, $update);
            redirect('admin/personalitation/change_password');
        }
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
