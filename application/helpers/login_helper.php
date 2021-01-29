<?php
function is_log_in()
{
    $ci = get_instance();

        // Load facebook oauth library 
        $ci->load->library('facebook');

        // Load user model 
        $ci->load->model('user');

        $userData = array();

        // Authenticate user with facebook 
        if ($ci->facebook->is_authenticated()) {

            // Insert or update user data to the database 
            $userID = $ci->user->checkUser($userData);

            // Check user data insert or update status 
            if (!empty($userID)) {
                $data['userData'] = $userData;

                // Store the user profile info into session 
                $ci->session->set_userdata('userData', $userData);
            } else {
                $data['userData'] = array();
            }

            // Facebook logout URL 
            $data['logoutURL'] = $ci->facebook->logout_url();
        } else {
            // Facebook authentication url 
            $data['authURL'] =  $ci->facebook->login_url();
        }

}
