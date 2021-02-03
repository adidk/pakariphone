<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Expert extends CI_Controller
{

    public function iphone()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "iPhone Series";
        $data['url']            = "iphone";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_device', $data);
        $this->load->view('v_admin/v_a_footer');
    }

    public function add_dvc()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Add Device";
        $data['url']            = "add_dvc";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_adddevice', $data);
        $this->load->view('v_admin/v_a_footer');
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
    }

    public function rule()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Rule";
        $data['url']            = "rule";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_rule', $data);
        $this->load->view('v_admin/v_a_footer');
    }

    public function question()
    {
        $data['breadcrumtext']  = "Expert System";
        $data['tittle']         = "Question";
        $data['url']            = "question";

        $this->load->view('v_admin/v_a_header', $data);
        $this->load->view('v_admin/v_a_sidebar', $data);
        $this->load->view('v_admin/v_a_question', $data);
        $this->load->view('v_admin/v_a_footer');
    }
}
