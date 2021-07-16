<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
        if ($this->facebook->is_authenticated()) {
            // Get user info from facebook 
            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');
            $useronline = $this->db->get_where('users', array('email' =>  $fbUser['email']))->row_array();

            if ($useronline['role_id'] == 1) {
                redirect(['admin/Dashboard']);
            } else {


                // Preparing data for database insertion 
                $userData['email']        = !empty($fbUser['email']) ? $fbUser['email'] : '';
                $userData['oauth_provider'] = 'facebook';
                $userData['oauth_uid']    = !empty($fbUser['id']) ? $fbUser['id'] : '';;
                $userData['first_name']    = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
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

    public function facebook()
    {
    }
    public function login()
    {
        // $gender = $this->input->post('gender');
        // $email = $this->input->post('emai$email');
        // $update = array(
        //     'phone' => '89799'
        //     // 'gender' => $gender
        // );

        // $where = array(
        //     'email' => 'bbintari13@gmail.com'
        // );
        // $this->user->update_kategori($where, $update);

        $phone = $this->input->post('phone');
        // $password = $this->input->post('password');

        // $user = $this->db->get_where('users', ['email' => $email])->row_array();
        //jika usernya ada
        var_dump($phone);
        die();
        // if ($user) {
        //     //jika usernya aktif
        //     if ($user['is_active'] == 1) {
        //         //cek password
        //         if (password_verify($password, $user['password'])) {
        //             $data = [
        //                 'email' => $user['email'],
        //                 'role_id' => $user['role_id']
        //             ];
        //             $this->session->set_userdata($data);
        //             if ($user['role_id'] == 1) {
        //                 redirect('admin');
        //             } else {
        //                 redirect('user');
        //             }
        //         } else {
        //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //             Wrong password.</div>');
        //             redirect('auth');
        //         }
        //     } else {
        //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //         This email has not been activated.</div>');
        //         redirect('auth');
        //     }
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        //     Email not registered</div>');
        //     redirect('auth');
        // }
    }
    public function logout()
    {
        // Remove local Facebook session 
        $this->facebook->destroy_session();
        // Remove user data from session 
        $this->session->unset_userdata('userData');
        // Redirect to login page 
        redirect('Auth');
    }
}
