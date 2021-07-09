<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expert extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('m_expert', 'expert');
    }


    public function iphone()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "iPhone Series";
        $data['url']            = "iphone";
        $data['device'] = $this->expert->get_alldvc();


        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_device', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_adddevice', $data);
    }

    public function ajax_list_dvc()
    {
        $list = $this->expert->get_datatables_dvc();
        $data = array();
        $no = $_POST['start'];
        $number = 1;
        foreach ($list as $device) {
            $no++;
            $row = array();
            $row[] = $number++;
            $row[] = $device->id_device;
            $row[] = $device->name_device;
            $row[] = '<img src="' . base_url() . 'assets/images/product/' . $device->image . '" class="img-fluid" alt="' . $device->image . '" style="height: 40px;">';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dvc(' . "'" . $device->id_device . "'" . ')"><i class="icon-pencil"></i></a>
                  <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dvc(' . "'" . $device->id_device . "'" . ')"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expert->count_all_dvc(),
            "recordsFiltered" => $this->expert->count_filtered_dvc(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function count_dvc()
    {
        $idlast = $this->expert->dvc_lastid();
        $subid = substr($idlast['id_device'], 2);
        $idnum = $subid + 1;
        if ($idnum < 10) {
            $number = "000" . $idnum;
        } else if ($idnum >= 10) {
            $number = "00" . $idnum;
        } else if ($idnum >= 100) {
            $number = "0" . $idnum;
        } else {
            $number = $idnum;
        }
        $row[] = "IP" . $number;
        $data[] = $row;
        $output = array(
            "id_dvc"    => $data
        );

        echo json_encode($output);
    }

    public function edit_dvc($id)
    {
        $data = $this->expert->getdvc_by_id($id);
        echo json_encode($data);
    }

    public function add_dvc()
    {
        $this->_validate();

        $data = array(
            "id_device"     => $this->input->post('id_dvc'),
            "name_device"   => $this->input->post('name_dvc'),
        );

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();
            $data['image'] = $upload;
        } else {
            $data['image'] = 'default.png';
        }

        $insert = $this->expert->savedvc($data);

        echo json_encode(array("status" => TRUE));
    }

    public function update_dvc()
    {
        $this->_validate();
        $data = array(
            "id_device"     => $this->input->post('id_dvc'),
            "name_device"   => $this->input->post('name_dvc'),
        );

        if ($this->input->post('remove_photo')) // if remove photo checked
        {
            $device = $this->expert->getdvc_by_id($this->input->post('id_dvc'));
            $old_image = $device->image;
            if ($old_image != 'default.png') {
                unlink('./assets/images/product/' . $this->input->post('remove_photo'));
            }
            $data['image'] = 'default.png';
        }

        if (!empty($_FILES['photo']['name'])) {
            $upload = $this->_do_upload();

            //delete file
            $device = $this->expert->getdvc_by_id($this->input->post('id_dvc'));
            $old_image = $device->image;
            if ($old_image != 'default.png') {
                unlink('./assets/images/product/' . $device->image);
            }
            $data['image'] = $upload;
        }

        $this->expert->update(array('id_device' => $this->input->post('id_dvc')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_dvc($iddevice)
    {
        //delete file
        $device = $this->expert->getdvc_by_id($iddevice);
        $old_image = $device->image;
        if ($old_image != 'default.png') {
            unlink('./assets/images/product/' . $device->image);
        }

        $this->expert->deletedvc_by_id($iddevice);
        echo json_encode(array("status" => TRUE));
    }

    public function damage()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Damage";
        $data['url']            = "damage";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_damage', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_damage', $data);
    }

    public function symtoms()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Symtoms";
        $data['url']            = "symtoms";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_symtoms', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_symtoms', $data);
    }

    public function rule()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Rule";
        $data['url']            = "rule";

        $data['pertanyaan']         = $this->expert->getpertanyaan();
        $data['kerusakan']         = $this->expert->getkerusakan();


        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_rule', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_rule', $data);
    }

    public function question()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Question";
        $data['url']            = "question";

        $data['gejala']         = $this->expert->getgejala();

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_question', $data);
        $this->load->view('v_admin/v_a_footer');
        $this->load->view('j_admin/j_question', $data);
    }

    private function _do_upload()
    {
        $config['upload_path']          = './assets/images/product';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_dvc') == '') {
            $data['inputerror'][] = 'id_dvc';
            $data['error_string'][] = 'Id Device is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('name_dvc') == '') {
            $data['inputerror'][] = 'name_dvc';
            $data['error_string'][] = 'Device name is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    //Gejala  

    public function ajax_list_gjl()
    {
        $list = $this->expert->get_datatables_gejala();
        $data = array();
        $no = $_POST['start'];
        $number = 1;
        foreach ($list as $gjl) {
            $no++;
            $row = array();
            $row[] = $number++;
            $row[] = $gjl->id_gejala;
            $row[] = $gjl->nama_gejala;
            $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_gjl(' . "'" . $gjl->id_gejala . "'" . ')"><i class="icon-pencil"></i></a>
                  <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_gjl(' . "'" . $gjl->id_gejala . "'" . ')"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expert->count_all_gjl(),
            "recordsFiltered" => $this->expert->count_filtered_gjl(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_gjl()
    {
        $this->_validategejala();

        $data = array(
            "id_gejala"     => $this->input->post('id_gjl'),
            "nama_gejala"   => $this->input->post('nama_gjl'),
        );

        $insert = $this->expert->savegjl($data);

        echo json_encode(array("status" => TRUE));
    }

    public function update_gjl()
    {
        $this->_validategejala();
        $data = array(
            "id_gejala"     => $this->input->post('id_gjl'),
            "nama_gejala"   => $this->input->post('nama_gjl'),
        );

        $this->expert->updategjl(array('id_gejala' => $this->input->post('id_gjl')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit_gjl($id)
    {
        $data = $this->expert->getgjl_by_id($id);
        echo json_encode($data);
    }

    public function delete_gjl($id)
    {
        $this->expert->deletegjl_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function count_gjl()
    {
        $idlast = $this->expert->gjl_lastid();
        $subid = substr($idlast['id_gejala'], 3);
        $idnum = $subid + 1;
        if ($idnum < 10) {
            $number = "000" . $idnum;
        } else if ($idnum >= 10) {
            $number = "00" . $idnum;
        } else if ($idnum >= 100) {
            $number = "0" . $idnum;
        } else {
            $number = $idnum;
        }
        $row[] = "GJL" . $number;
        $data[] = $row;
        $output = array(
            "id_gjl"    => $data
        );

        echo json_encode($output);
    }

    private function _validategejala()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_gjl') == '') {
            $data['inputerror'][] = 'id_gjl';
            $data['error_string'][] = 'Id Gejala is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama_gjl') == '') {
            $data['inputerror'][] = 'nama_gjl';
            $data['error_string'][] = 'Gejala is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    // Damage / Kerusakan
    public function ajax_list_dmg()
    {
        $list = $this->expert->get_datatables_damage();
        $data = array();
        $no = $_POST['start'];
        $number = 1;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $number++;
            $row[] = $item->id_kerusakan;
            $row[] = $item->nama_kerusakan;
            $row[] = $item->deskripsi_kerusakan;
            $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_dmg(' . "'" . $item->id_kerusakan . "'" . ')"><i class="icon-pencil"></i></a>
                  <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_dmg(' . "'" . $item->id_kerusakan . "'" . ')"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expert->count_all_dmg(),
            "recordsFiltered" => $this->expert->count_filtered_dmg(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    private function _validatedamage()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_dmg') == '') {
            $data['inputerror'][] = 'id_dmg';
            $data['error_string'][] = 'Id Kerusakan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('nama_dmg') == '') {
            $data['inputerror'][] = 'nama_dmg';
            $data['error_string'][] = 'Nama Kerusakan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('keterangan_dmg') == '') {
            $data['inputerror'][] = 'keterangan_dmg';
            $data['error_string'][] = 'Keterangan diperlukan';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function count_dmg()
    {
        $idlast = $this->expert->dmg_lastid();
        $subid = substr($idlast['id_kerusakan'], 2);
        $idnum = $subid + 1;
        if ($idnum < 10) {
            $number = "000" . $idnum;
        } else if ($idnum >= 10) {
            $number = "00" . $idnum;
        } else if ($idnum >= 100) {
            $number = "0" . $idnum;
        } else {
            $number = $idnum;
        }
        $row[] = "KR" . $number;
        $data[] = $row;
        $output = array(
            "id_dmg"    => $data
        );
        // var_dump($output);
        echo json_encode($output);
    }


    public function add_dmg()
    {
        $this->_validatedamage();

        $data = array(
            "id_kerusakan"          => $this->input->post('id_dmg'),
            "nama_kerusakan"        => $this->input->post('nama_dmg'),
            "deskripsi_kerusakan"   => $this->input->post('keterangan_dmg'),
        );

        $insert = $this->expert->savedmg($data);

        echo json_encode(array("status" => TRUE));
    }

    public function edit_dmg($id)
    {
        $data = $this->expert->getdmg_by_id($id);
        echo json_encode($data);
    }

    public function update_dmg()
    {
        $this->_validatedamage();
        $data = array(
            "id_kerusakan"          => $this->input->post('id_dmg'),
            "nama_kerusakan"        => $this->input->post('nama_dmg'),
            "deskripsi_kerusakan"   => $this->input->post('keterangan_dmg'),
        );

        $this->expert->updatedmg(array('id_kerusakan' => $this->input->post('id_dmg')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_dmg($id)
    {
        $this->expert->deletedmg_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    // Pertanyaan

    public function ajax_list_q()
    {
        $list = $this->expert->get_datatables_q();
        $data = array();
        $no = $_POST['start'];
        $number = 1;

        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $number++;
            $row[] = $item->id_pertanyaankerusakan;
            $row[] = $item->id_gejala;
            $row[] = $item->nama_gejala;
            $row[] = $item->pertanyaan;
            $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_q(' . "'" . $item->id_pertanyaankerusakan . "'" . ')"><i class="icon-pencil"></i></a>
                  <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_q(' . "'" . $item->id_pertanyaankerusakan . "'" . ')"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expert->count_all_q(),
            "recordsFiltered" => $this->expert->count_filtered_q(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function count_q()
    {
        $idlast = $this->expert->q_lastid();
        $subid = substr($idlast['id_pertanyaankerusakan'], 2);
        $idnum = $subid + 1;
        if ($idnum < 10) {
            $number = "000" . $idnum;
        } else if ($idnum >= 10) {
            $number = "00" . $idnum;
        } else if ($idnum >= 100) {
            $number = "0" . $idnum;
        } else {
            $number = $idnum;
        }
        $row[] = "PK" . $number;
        $data[] = $row;
        $output = array(
            "id_q"    => $data
        );
        // var_dump($output);
        echo json_encode($output);
    }

    public function add_q()
    {
        $this->_validateq();

        $data = array(
            "id_pertanyaankerusakan"    => $this->input->post('id_q'),
            "id_gejala"                 => $this->input->post('id_g'),
            "pertanyaan"                => $this->input->post('pertanyaan'),
        );

        $insert = $this->expert->saveq($data);

        echo json_encode(array("status" => TRUE));
    }

    public function edit_q($id)
    {
        $data = $this->expert->getq_by_id($id);
        echo json_encode($data);
    }

    public function update_q()
    {
        $this->_validateq();
        $data = array(
            "id_pertanyaankerusakan"    => $this->input->post('id_q'),
            "id_gejala"                 => $this->input->post('id_g'),
            "pertanyaan"                => $this->input->post('pertanyaan'),
        );

        $this->expert->updateq(array('id_pertanyaankerusakan' => $this->input->post('id_q')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_q($id)
    {
        $this->expert->deleteq_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validateq()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_q') == '') {
            $data['inputerror'][] = 'id_q';
            $data['error_string'][] = 'Id Pertanyaan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_g') == '') {
            $data['inputerror'][] = 'id_g';
            $data['error_string'][] = 'Gejala Kerusakan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('pertanyaan') == '') {
            $data['inputerror'][] = 'pertanyaan';
            $data['error_string'][] = 'Pertanyaan diperlukan';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    //Rule / aturan
    public function ajax_list_r()
    {
        $list = $this->expert->get_datatables_r();
        $data = array();
        $no = $_POST['start'];
        $number = 1;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $number++;
            $row[] = $item->id_rule;
            $row[] = $item->id_pertanyaankerusakan;
            $row[] = $item->nama_kerusakan;
            $row[] = '<a class="btn btn-sm btn-rounded btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_r(' . "'" . $item->id_rule . "'" . ')"><i class="icon-pencil"></i></a>
                  <a class="btn btn-sm btn-rounded btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_r(' . "'" . $item->id_rule . "'" . ')"><i class="icon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expert->count_all_r(),
            "recordsFiltered" => $this->expert->count_filtered_r(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function count_r()
    {
        $idlast = $this->expert->r_lastid();
        $subid = substr($idlast['id_rule'], 2);
        $idnum = $subid + 1;
        if ($idnum < 10) {
            $number = "000" . $idnum;
        } else if ($idnum >= 10) {
            $number = "00" . $idnum;
        } else if ($idnum >= 100) {
            $number = "0" . $idnum;
        } else {
            $number = $idnum;
        }
        $row[] = "RU" . $number;
        $data[] = $row;
        $output = array(
            "id_r"    => $data
        );

        echo json_encode($output);
    }

    public function add_r()
    {
        $this->_validater();
        $id_pk = $this->input->post('id_pk[]');
        $pertanyaan = implode(", ", $id_pk);
        $data = array(
            "id_rule"                   => $this->input->post('id_r'),
            "id_pertanyaankerusakan"    => ($pertanyaan),
            "id_kerusakan"              => $this->input->post('id_kr'),
        );

        $insert = $this->expert->saver($data);

        echo json_encode(array("status" => TRUE));
    }

    public function edit_r($id)
    {
        $data = $this->expert->getr_by_id($id);
        $pertanyaan = explode(", ", $data['id_pertanyaankerusakan']);
        $data = array(
            'id_rule' => $data['id_rule'],
            'id_pertanyaan' => $pertanyaan,
            'id_kerusakan' => $data['id_kerusakan']
        );
        echo json_encode($data);
    }

    public function update_r()
    {
        $this->_validater();
        $id_pk = $this->input->post('id_pk[]');
        $pertanyaan = implode(", ", $id_pk);
        $data = array(
            "id_rule"                   => $this->input->post('id_r'),
            "id_pertanyaankerusakan"    => $pertanyaan,
            "id_kerusakan"              => $this->input->post('id_kr'),
        );

        $this->expert->updater(array('id_rule' => $this->input->post('id_r')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function delete_r($id)
    {
        $this->expert->deleter_by_id($id);
        echo json_encode(array("status" => TRUE));
    }


    private function _validater()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('id_r') == '') {
            $data['inputerror'][] = 'id_r';
            $data['error_string'][] = 'Id Aturan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_pk[]') == '') {
            $data['inputerror'][] = 'id_pk[]';
            $data['error_string'][] = 'Pertanyaan Kerusakan diperlukan';
            $data['status'] = FALSE;
        }

        if ($this->input->post('id_kr') == ' ') {
            $data['inputerror'][] = 'id_kr';
            $data['error_string'][] = 'Kerusakan diperlukan';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
