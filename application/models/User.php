<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{
    function __construct()
    {
        $this->tableName = 'users';
        $this->primaryKey = 'id';
    }

    /*
     * Insert / Update facebook profile data into the database
     * @param array the data for inserting into the table
     */
    public function checkUser($userData = array())
    {
        if (!empty($userData)) {
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->primaryKey);
            $this->db->from($this->tableName);
            $this->db->where(array('oauth_provider' => $userData['oauth_provider'], 'oauth_uid' => $userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();

            if ($prevCheck > 0) {
                $prevResult = $prevQuery->row_array();

                //update user data
                $userData['modified'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->tableName, $userData, array('id' => $prevResult['id']));

                //get user ID
                $userID = $prevResult['id'];
            } else {
                //insert user data
                $userData['created']  = date("Y-m-d H:i:s");
                $userData['modified'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->tableName, $userData);

                //get user ID
                $userID = $this->db->insert_id();
            }
        }

        //return user ID
        return $userID ? $userID : FALSE;
    }

    public function doLogin()
    {
        $post = $this->input->post();

        $this->db->where('email', $post["email"]);
        $user = $this->db->get($this->_table)->row();

        if($user){
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // $isAdmin = $user->role == "admin";
            if($isPasswordTrue){ 
                $this->session->set_userdata(['user_logged' => $user]);
                // $this->_updateLastLogin($user->user_id);
                return true;
            }
		}
		return false;
    }


    private function _updateLastLogin($user_id)
    {
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }



    public function userLogin($useronline)
    {
        $this->db->get_where(  $this->tableName, array('email' =>$useronline));
    }

    function update_kategori($where, $update)
    {
        $this->db->where($where);
        $this->db->update($this->tableName, $update);
    }
}
