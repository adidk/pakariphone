<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ask', 'ask');
    }

    public function index()
    {
        $data['breadcrumtext']  = "Ask Question";
        $data['tittle']         = "Ask";
        $data['url']            = "Ask";

        $data['cekkerusakan'] = $this->ask->getdamage();
        $data['device'] = $this->ask->getdevice();

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_ask', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_ask', $data);
    }

    public function save_device()
    {
        $this->_validatesavedvc();
        delete_cookie('ask');
        $datacookie = $this->input->post('id_dvc') . ', ' . $this->input->post('id_kemungkinan') . ', ' . time();
        $cookie = array(
            'name'              => 'ask',
            'value'             => $datacookie,
            'expire'            => 18000,
            'domain'            => 'localhost',
            'path'              => '/',
        );
        $this->input->set_cookie($cookie);

        echo json_encode(array("status" => TRUE));
    }

    public function load_ask()
    {
        echo $this->_tampilaskcookie();
    }

    private function _tampilaskcookie()
    {
        if (get_cookie('ask') != NULL) {
            $cookie = get_cookie('ask');

            $data_cookie_ask = explode(", ", $cookie);

            $data['deviceid'] = $this->ask->getdeviid($data_cookie_ask[0]);
            $data['kemungkinanid'] = $this->ask->getdamageid($data_cookie_ask[1]);
            $output = '';
            $output .= '<h5>Kemungkinan Kendala : ' .  $data['kemungkinanid']['nama_konsultasi'] . '</h5>
            <h5>Tipe Device : ' . $data['deviceid']['name_device']  . '</h5>';
            return $output;
        } else {
            $output = '';
            $output .= '<h5>Kemungkinan Kendala : - </h5>
        <h5>Tipe Device : - </h5>';
            return $output;
        }
    }

    private function _validatesavedvc()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_dvc') == '') {
            $data['inputerror'][] = 'id_dvc';
            $data['error_string'][] = 'Pilih device tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_kemungkinan') == '') {
            $data['inputerror'][] = '';
            $data['error_string'][] = 'Pilih device tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
