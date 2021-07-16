<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_admin extends CI_Model
{
    public function penggunacount()
    {
        $this->db->select();
        $this->db->from('users');
        return $this->db->count_all_results();
    }

    public function penggunaphone()
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('phone is NOT NULL');
        return $this->db->count_all_results();
    }
    public function pertanyaan_dijawab()
    {
        $this->db->select();
        $this->db->from('rekap_hasilkonsultasi');
        return $this->db->count_all_results();
    }
}
