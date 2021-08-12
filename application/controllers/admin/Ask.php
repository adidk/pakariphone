<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ask extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_ask', 'ask');
        $this->load->model('m_user', 'user');
    }


    public function ajax_list_ask()
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            if (get_cookie('ask') != NULL) {
                $cookie = get_cookie('ask');
                $data_cookie_ask = explode(", ", $cookie);
                $id_konsultasi = $data_cookie_ask[3];
            } else {
                $id_konsultasi = "";
            }
            $list = $this->ask->get_datatables_ask($id_konsultasi);
            $data = array();
            $no = $_POST['start'];

            foreach ($list as $item) {
                $no++;
                $row = array();
                $pertanyaan = $item->pertanyaan;
                $row[] = $pertanyaan;
                if ($item->jawaban == 1) {
                    $row[] = "Ya";
                } else {
                    $row[] = "Tidak";
                }

                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->ask->count_all_jawaban($id_konsultasi),
                "recordsFiltered" => $this->ask->count_filtered_jawaban($id_konsultasi),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('auth');
        }
    }

    public function index()
    {
        $useronline = $this->session->userdata('userData');
        $data['user'] = $this->user->get_user($useronline['email']);

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            delete_cookie('ask');

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
        } else {
            redirect('auth');
        }
    }

    public function save_device()
    {
        $this->_validatesavedvc();

        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            $u_id =  uniqid();
            $get_6 = substr($u_id, 7, 13);
            $id_konsultasi = strtoupper($get_6);
            $datacookie = $this->input->post('id_dvc') . ', ' . $this->input->post('id_kemungkinan') . ', ' . time() . ', ' . $id_konsultasi;
            $cookie = array(
                'name'              => 'ask',
                'value'             => $datacookie,
                'expire'            => 18000,
                'domain'            => 'localhost',
                'path'              => '/',
            );
            $this->input->set_cookie($cookie);

            echo json_encode(array("status" => TRUE));
        } else {
            redirect('auth');
        }
    }

    public function load_ask()
    {
        echo $this->_tampilaskcookie();
    }

    private function _tampilaskcookie()
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
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
        } else {
            redirect('auth');
        }
    }

    public function pertanyaan()
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
            $cookie = get_cookie('ask');
            $data_cookie_ask = explode(", ", $cookie);


            $id_konsultasi = $data_cookie_ask[3];
            $kemungkinan = $data_cookie_ask[1];
            $datetime = $data_cookie_ask[2];

            $data['pertanyaan'] = $this->ask->pertanyaan();

            $output = '';
            $output .= '
        <div class="card-body">
        <form action="#" id="form_q">
        <input type="hidden" name="id_pertanyaan" value="' . $data['pertanyaan']['id_pertanyaankerusakan'] . '">
        <input type="hidden" name="id_konsultasi" value="' . $id_konsultasi . '">
        <input type="hidden" name="datetimetj" value="' . $datetime . '">
        
        <h3 class="card-title">' . $data['pertanyaan']['pertanyaan'] . '</h3>
        </form>
        <button id="#btnSave" class="btn btn-sm btn-rounded btn-primary" onclick="save(1)"><i class="fa fa-check"></i> Iya</button>
        <button id="#btnSave" class="btn btn-sm btn-rounded btn-danger" onclick="save(0)"><i class="fa fa-times"></i> Tidak</button>
        </div>     
        ';
            echo $output;
            return $output;
        } else {
            redirect('auth');
        }
    }


    public function save_jawaban($jawaban)
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {

            $useronline = $this->session->userdata('userData');
            $data['user'] = $this->user->get_user($useronline['email']);
            $id_konsultasi =  $this->input->post('id_konsultasi');

            $data = array(
                "id_konsultasirj"   => $this->input->post('id_konsultasi'),
                "id_pertanyaanrj"   => $this->input->post('id_pertanyaan'),
                "id_userrj"         => $data['user']['oauth_uid'],
                "datetime_rj"       => date('Y-m-d H:i:s', time()),
                "jawaban"           => $jawaban
            );

            $this->db->insert('riwayat_jawaban', $data);
            echo json_encode(array("status" => TRUE, "id_konsultasi" => $id_konsultasi));
        } else {
            redirect('auth');
        }
    }

    public function reload_ask($id_konsultasi)
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {

            $cookie = get_cookie('ask');

            $cookie = explode(',', $cookie);

            $useronline = $this->session->userdata('userData');
            $data['user'] = $this->user->get_user($useronline['email']);
            $id_user        = $data['user']['oauth_uid'];
            $id_device      = $cookie[0];

            $this->db->select('jawaban');
            $this->db->from('riwayat_jawaban');
            $this->db->where('jawaban', 1);
            $this->db->where('id_konsultasirj', $id_konsultasi);
            $qCek = $this->db->get();
            if ($qCek->num_rows() > 0) {

                $query1 = $this->db->query("SELECT id_pertanyaanrj from riwayat_jawaban where jawaban =1 and id_konsultasirj='$id_konsultasi'");
                foreach ($query1->result() as $row) {
                    $a = $row->id_pertanyaanrj;
                    $b[] = $a;
                }
                $bca = implode(",", $b);
                $bca = "$bca";

                $this->db->select('*');
                $this->db->from('rule_kerusakan');
                $this->db->where('id_pertanyaankerusakan', $bca);
                $queryHasil = $this->db->get();
                $queryHasil2 = $queryHasil->result_array();

                if ($queryHasil->num_rows() > 0) {
                    foreach ($queryHasil2 as $kode_kerusakan) {
                        $data = $kode_kerusakan['id_kerusakan'];
                    }

                    $this->db->select('*');
                    $this->db->from('kerusakan_device');
                    $this->db->where('id_kerusakan', $data);
                    $queryHasilKerusakan = $this->db->get();
                    $queryHasilKerusakan2['kerusakan_device'] = $queryHasilKerusakan->row_array();

                    $this->ask->insertrekap(
                        $id_konsultasi,
                        $id_user,
                        $id_device,
                        $queryHasilKerusakan2['kerusakan_device']['id_kerusakan']
                    );
                    $hasil_kerusakan =  $queryHasilKerusakan2['kerusakan_device']['nama_kerusakan'];

                    $output = '';
                    $output .= '
                <div class="card-body">
                    <h3 class="card-title">' . $queryHasilKerusakan2['kerusakan_device']['nama_kerusakan'] . '</h3>
                    <p>' . $queryHasilKerusakan2['kerusakan_device']['deskripsi_kerusakan'] . '</p>
                    <a class="btn btn-rounded btn-success" href="https://wa.me/6281575403733?text=Saya%20telah%20melakukan%20pengecekan%20di%20Sistem%20pakar%20dengan%20kendala%20' . $hasil_kerusakan . '"><i class="fab fa-whatsapp"> Hubungi Kami Untuk Booking Servis</i></a>
                </div>   
                ';

                    echo $output;
                    return $output;
                } else {
                    $data['backward'] = $this->ask->caripertanyaan($id_konsultasi);

                    $output = '';
                    foreach ($data['backward'] as $item) {
                        $output .= '
                <div class="card-body">
                    <form action="#" id="form_q">
                        <input type="hidden" name="id_pertanyaan" value="' . $item['id_pertanyaankerusakan'] . '">
                        <input type="hidden" name="id_konsultasi" value="' . $id_konsultasi . '">
        
                        <h3 class="card-title">' . $item['pertanyaan'] . '</h3>
                    </form>
                    <button id="#btnSave" class="btn btn-sm btn-rounded btn-primary" onclick="save(1)"><i class="fa fa-check"></i> Iya</button>
                    <button id="#btnSave" class="btn btn-sm btn-rounded btn-danger" onclick="save(0)"><i class="fa fa-times"></i> Tidak</button>
                </div>     
                ';
                    }
                    echo $output;
                    return $output;
                }
            } else {
                $data['backward'] = $this->ask->caripertanyaan($id_konsultasi);

                $output = '';
                foreach ($data['backward'] as $item) {
                    $output .= '
                    <div class="card-body">
                        <form action="#" id="form_q">
                            <input type="hidden" name="id_pertanyaan" value="' . $item['id_pertanyaankerusakan'] . '">
                            <input type="hidden" name="id_konsultasi" value="' . $id_konsultasi . '">
            
                            <h3 class="card-title">' . $item['pertanyaan'] . '</h3>
                        </form>
                        <button id="#btnSave" class="btn btn-sm btn-rounded btn-primary" onclick="save(1)"><i class="fa fa-check"></i> Iya</button>
                        <button id="#btnSave" class="btn btn-sm btn-rounded btn-danger" onclick="save(0)"><i class="fa fa-times"></i> Tidak</button>
                    </div>     
                    ';
                }
                echo $output;
                return $output;
            }
        } else {
            redirect('auth');
        }
    }

    public function noresult()
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {

            $output = '';
            $output .= '
        <div class="card-body">
            <h3 class="card-title">Mohon maaf hasil tidak ditemukan.</h3>
            <p> Silakan hubungi kami di kontak whatsapp berikut untuk menanyakan pertanyaan yang belum ada jawaban di dalam sistem pakar kami, terimakasih.</p>
            <a class="btn btn-rounded btn-success" href="https://wa.me/6281575403733?text=Saya%20telah%20melakukan%20pengecekan%20di%20Sistem%20pakar%20namun%20tidak%20mendapatkan%20jawaban"><i class="fab fa-whatsapp"> Hubungi Kami</i></a>
        </div>   
        ';
            echo $output;
            return $output;
        } else {
            redirect('auth');
        }
    }

    public function vardump()
    {
    }

    private function _validatesavedvc()
    {
        if ($this->facebook->is_authenticated() || $this->session->userdata('userData')) {
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
        } else {
            redirect('auth');
        }
    }
}
