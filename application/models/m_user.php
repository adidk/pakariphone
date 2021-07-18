<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_user extends CI_Model
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
                $userData['role_id']   = 2;
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

        if ($user) {
            $isPasswordTrue = password_verify($post["password"], $user->password);
            // $isAdmin = $user->role == "admin";
            if ($isPasswordTrue) {
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

    public function get_user($email)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('email', $email);

        return $this->db->get()->row_array();
    }

    public function get_user_byid($id_user)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('oauth_uid', $id_user);

        return $this->db->get()->row_array();
    }



    public function userLogin($useronline)
    {
        $this->db->get_where($this->tableName, array('email' => $useronline));
    }

    function update_kategori($where, $update)
    {
        $this->db->where($where);
        $this->db->update($this->tableName, $update);
    }

    public function get_datatables_user()
    {
        $this->_get_datatablesuser_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function role()
    {
        $this->db->select();
        $this->db->from('user_role');
        return $this->db->get()->result_array();
    }

    public function getuser_by_id($id_user)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('oauth_uid', $id_user);
        return $this->db->get()->row_array();
    }

    private function _get_datatablesuser_query()
    {

        $column_order = array(
            'users.picture',
            'users.fist_name',
            'users.last_name',
            'users.email',
            'users.phone',
            'user_role.role_name',
            'users.oauth_uid',
            null
        );
        $column_search = array(
            'users.first_name',
            'users.last_name',
            'users.email',
            'users.phone'
        );
        $order = array('users.id' => 'asc');

        $this->db->from('users');
        $this->db->join('user_role', 'user_role.rold_id=users.role_id');

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all_user()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function riwayat_by_id($id_user)
    {
        $this->db->from('rekap_hasilkonsultasi');
        $this->db->where('id_userrhk', $id_user);
        return $this->db->count_all_results();
    }

    function count_filtered_user()
    {
        $this->_get_datatablesuser_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function update($where, $data)
    {
        $this->db->update('users', $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteuser_by_id($id_user)
    {
        $this->db->where('oauth_uid', $id_user);
        $this->db->delete('users');
    }

    public function get_datatables_riwayat($id_user)
    {
        $this->_get_datatables_riwayat($id_user);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_riwayat($id_user)
    {
        $column_order = array(
            'device_type.name_device',
            'device_type.image',
            'kerusakan_device.nama_kerusakan',
            'rekap_hasilkonsultasi.datetime_rhk',
            null
        );
        $column_search = array(
            'device_type.name_device',
            'kerusakan_device.nama_kerusakan',
        );
        $order = array('rekap_hasilkonsultasi.id_rekaphasilkonsultasi' => 'asc', 'device_type.name_device' => 'asc');

        $this->db->from('rekap_hasilkonsultasi');
        $this->db->join('device_type', 'device_type.id_device=rekap_hasilkonsultasi.id_devicerhk');
        $this->db->join('kerusakan_device', 'kerusakan_device.id_kerusakan=rekap_hasilkonsultasi.id_kerusakanrhk');
        $this->db->where('rekap_hasilkonsultasi.id_userrhk', $id_user);

        $i = 0;

        foreach ($column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $orderr = $order;
            $this->db->order_by(key($orderr), $order[key($orderr)]);
        }
    }

    function count_filtered_riwayat($id_user)
    {
        $this->_get_datatables_riwayat($id_user);
        $query = $this->db->get();
        return $query->num_rows();
    }
}
