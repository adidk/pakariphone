<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // Load user model 
        $this->load->model('m_user', 'user');
    }


    public function index()
    {

        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Users Data";
                $data['url']            = "user";

                $data['role']           = $this->user->role();

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_cuser', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function facebook_user()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Facebook Users";
                $data['url']            = "facebook_user";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_userfacebook', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function phone_user()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Users";
                $data['tittle']         = "Phone Number Users";
                $data['url']            = "phone_user";

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_user', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_userphone', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function ajax_list_users()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $list = $this->user->get_datatables_user();
                $data_uid = $data['user']['oauth_uid'];
                $data = array();
                $no = $_POST['start'];
                foreach ($list as $list) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = '<img src="' . $list->picture . '" class="img-fluid" alt="' . $list->picture . '" style="height: 40px;">';
                    $row[] = $list->first_name . ' ' . $list->last_name;
                    $row[] = $list->email;
                    $row[] = $list->phone;
                    $row[] = $list->role_name;

                    if ($list->oauth_uid == $data_uid) {
                        $row[] = '<a class="btn btn-sm btn-rounded btn-success" href="' . base_url() . 'admin/user/riwayat/' . $list->oauth_uid . '" title="Riwayat"><i class="fas fa-history"></i></a>';
                    } else {
                        $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user(' . "'" . $list->oauth_uid . "'" . ')"><i class="icon-pencil"></i></a>
                   <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_user(' . "'" . $list->oauth_uid . "'" . ')"><i class="icon-trash"></i></a>
                   <a class="btn btn-sm btn-rounded btn-success" href="' . base_url() . 'admin/user/riwayat/' . $list->oauth_uid . '" title="Riwayat"><i class="fas fa-history"></i></a>';
                    }

                    $data[] = $row;
                }

                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->user->count_all_user(),
                    "recordsFiltered" => $this->user->count_filtered_user(),
                    "data" => $data,
                );
                //output to json format
                echo json_encode($output);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function edit_user($id_user)
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data = $this->user->getuser_by_id($id_user);
                echo json_encode($data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function update_user()
    {
        $this->_validate();

        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data = array(
                    "role_id"   => $this->input->post('role'),
                );

                $this->user->update(array('oauth_uid' => $this->input->post('oauth_id')), $data);
                echo json_encode(array("status" => TRUE));
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function delete_user($id_user)
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $this->user->deleteuser_by_id($id_user);
                echo json_encode(array("status" => TRUE));
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    private function _validate()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data = array();
                $data['error_string'] = array();
                $data['inputerror'] = array();
                $data['status'] = TRUE;

                if ($this->input->post('role') == '') {
                    $data['inputerror'][] = 'role';
                    $data['error_string'][] = 'Role perulu diisi';
                    $data['status'] = FALSE;
                }
                if ($this->input->post('oauth_id') == '') {
                    $data['inputerror'][] = 'oauth_id';
                    $data['error_string'][] = 'Oauth tidak boleh kosong';
                    $data['status'] = FALSE;
                }

                if ($data['status'] === FALSE) {
                    echo json_encode($data);
                    exit();
                }
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function riwayat($id_user)
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if ($data['user']['role_id'] == 1) {
                $data['breadcrumtext']  = "Riwayat Bertanya";
                $data['tittle']         = "Riwayat Bertanya";
                $data['url']            = "riwayat/" . $id_user;

                $data['id_user']            = $id_user;
                $data['riwayat']            = $this->user->riwayat_by_id($id_user);
                $data['user_konsultasi']    = $this->user->get_user_byid($id_user);

                $this->load->view('v_admin/v_a_header', $data);
                $this->load->view('v_admin/v_a_sidebar', $data);
                $this->load->view('v_admin/v_a_riwayat', $data);
                $this->load->view('v_admin/v_a_footer');
                $this->load->view('j_admin/j_userriwayat', $data);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }

    public function ajax_list_riwayat($id_user)
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {

            if ($data['user']['role_id'] == 1) {
                $list = $this->user->get_datatables_riwayat($id_user);
                $data = array();
                $no = $_POST['start'];

                foreach ($list as $list) {
                    $no++;
                    $row = array();
                    $row[] = $no;
                    $row[] = $list->name_device;
                    $row[] = '<img src="' . base_url() . 'assets/images/product/' . $list->image . '" class="img-fluid" alt="' . $list->image . '" style="height: 40px;">';
                    $row[] = $list->nama_kerusakan;
                    $row[] = $list->datetime_rhk;

                    $data[] = $row;
                }

                $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->user->riwayat_by_id($id_user),
                    "recordsFiltered" => $this->user->count_filtered_riwayat($id_user),
                    "data" => $data,
                );
                //output to json format
                echo json_encode($output);
            } else {
                redirect('admin/presonalitation');
            }
        } else {
            redirect('auth');
        }
    }
}
