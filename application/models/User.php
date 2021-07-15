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

    public function useronline($useronline)
    {
        // $useronline = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');   
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where('users', array('email' => $useronline['email']));
    }

    function update_kategori($where, $update)
    {
        $this->db->where($where);
        $this->db->update($this->tableName, $update);
    }
}
