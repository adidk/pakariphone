<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('user', 'user');
    }

    public function index()
    {

        if ($this->session->userdata('userData')) {
            redirect('admin/personalitation');
        } else {
            if ($this->facebook->is_authenticated()) {
                // Get user info from facebook 
                $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,middle_name,last_name,email,link,gender,picture');
                $useronline = $this->db->get_where('users', array('email' =>  $fbUser['email']))->row_array();



                if ($useronline['role_id'] == 1) {
                    $user_data = array(
                        'email' => $useronline['email'],
                        'role_id' => $useronline['role_id']
                    );
                    $this->session->set_userdata('userData', $user_data);

                    redirect(['admin/dashboard']);
                } else {
                    // Preparing data for database insertion 
                    $userData['email']        = !empty($fbUser['email']) ? $fbUser['email'] : '';
                    $userData['oauth_provider'] = 'facebook';
                    $userData['oauth_uid']    = !empty($fbUser['id']) ? $fbUser['id'] : '';;
                    $userData['first_name']    = !empty($fbUser['first_name'] . ' ' . $fbUser['middle_name']) ? $fbUser['first_name'] . ' ' . $fbUser['middle_name'] : '';
                    $userData['last_name']    = !empty($fbUser['last_name']) ? $fbUser['last_name'] : '';
                    $userData['gender']        = !empty($fbUser['gender']) ? $fbUser['gender'] : '';
                    $userData['picture']    = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
                    $userData['link']        = !empty($fbUser['link']) ? $fbUser['link'] : 'https://www.facebook.com/';


                    // Insert or update user data to the database 
                    $userID = $this->user->checkUser($userData);

                    // Check user data insert or update status 
                    if (!empty($userID)) {
                        $data['userData'] = $userData;

                        // Store the user profile info into session 
                        $this->session->set_userdata('userData', $userData);
                    } else {
                        $data['userData'] = array();
                    }

                    // Facebook logout URL 
                    $data['logoutURL'] = $this->facebook->logout_url();
                }
            } else {
                // Facebook authentication url 
                $data['authURL'] =  $this->facebook->login_url();
            }
            // Load login/profile view 
            $this->load->view('v_auth/index', $data);
        }
    }


    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Silahkan isi email dan password.</div>');
            redirect('auth');
        } else {
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $user = $this->db->get_where('users', ['email' => $email])->row_array();

            if ($user) {
                //jika usernya aktif
                $data = [
                    'email' => $user['email'],
                    'role_id' => $user['role_id']
                ];

                $this->session->set_userdata('userData', $data);
                if (password_verify($password, $user['password'])) {
                    if ($user['role_id'] == 1) {
                        redirect('admin/dashboard');
                    } else {
                        redirect('admin/personalitation');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password akun salah.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    email tidak terdaftar silahkan daftar menggunakan facebook terlebih dahulu.</div>');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        // Remove local Facebook session 
        $this->facebook->destroy_session();
        // Remove user data from session 
        $this->session->unset_userdata('userData');
        // Redirect to login page 
        redirect('auth');
    }
}
