<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_ask extends CI_Model
{
    var $damage = "kerusakan_device";
    var $device = "device_type";

    public function getdamage()
    {
        $this->db->from($this->damage);
        return $this->db->get()->result_array();
    }
    public function getdevice()
    {
        $this->db->from($this->device);
        return $this->db->get()->result_array();
    }
}
