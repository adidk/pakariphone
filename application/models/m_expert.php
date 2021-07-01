<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_expert extends CI_Model
{
    var $device = 'device_type';
    var $column_order = array('id_device', 'name_device', 'image', null);
    var $column_search = array('name_device');
    var $order = array('id_device' => 'asc');

    var $devicegjl = 'gejala_device';
    var $column_ordergjl = array('id_gejala', 'nama_gejala',  null);
    var $column_searchgjl = array('nama_gejala');
    var $ordergjl = array('id_gejala' => 'asc');

    var $devicedmg = 'kerusakan_device';
    var $column_orderdmg = array('id_kerusakan', 'nama_kerusakan', 'deskripsi_kerusakan',  null);
    var $column_searchdmg = array('nama_kerusakan', 'id_kerusakan');
    var $orderdmg = array('id_kerusakan' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatablesdvc_query()
    {
        $this->db->from($this->device);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
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

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _get_datatablesgejala_query()
    {
        $this->db->from($this->devicegjl);

        $i = 0;

        foreach ($this->column_searchgjl as $item) // loop column 
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

                if (count($this->column_searchgjl) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_ordergjl[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->ordergjl)) {
            $ordergjl = $this->ordergjl;
            $this->db->order_by(key($ordergjl), $ordergjl[key($ordergjl)]);
        }
    }

    private function _get_datatablesdamage_query()
    {
        $this->db->from($this->devicedmg);

        $i = 0;

        foreach ($this->column_searchdmg as $item) // loop column 
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

                if (count($this->column_searchgjl) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_orderdmg[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->orderdmg)) {
            $orderdmg = $this->orderdmg;
            $this->db->order_by(key($orderdmg), $orderdmg[key($orderdmg)]);
        }
    }

    public function count_all_dvc()
    {
        $this->db->from($this->device);
        return $this->db->count_all_results();
    }

    public function count_all_gjl()
    {
        $this->db->from($this->devicegjl);
        return $this->db->count_all_results();
    }

    public function count_all_dmg()
    {
        $this->db->from($this->devicedmg);
        return $this->db->count_all_results();
    }

    public function dmg_lastid()
    {
        $this->db->from($this->devicedmg);
        return $this->db->order_by('id_kerusakan', 'desc')->limit(1)->get()->row_array();
    }

    function count_filtered_dvc()
    {
        $this->_get_datatablesdvc_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered_gjl()
    {
        $this->_get_datatablesgejala_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_filtered_dmg()
    {
        $this->_get_datatablesdamage_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function savedvc($data)
    {
        $this->db->insert($this->device, $data);
        return $this->db->insert_id();
    }

    function savegjl($data)
    {
        $this->db->insert($this->devicegjl, $data);
        return $this->db->insert_id();
    }

    function savedmg($data)
    {
        $this->db->insert($this->devicedmg, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->device, $data, $where);
        return $this->db->affected_rows();
    }

    public function updategjl($where, $data)
    {
        $this->db->update($this->devicegjl, $data, $where);
        return $this->db->affected_rows();
    }
    public function updatedmg($where, $data)
    {
        $this->db->update($this->devicedmg, $data, $where);
        return $this->db->affected_rows();
    }

    public function deletedvc_by_id($id)
    {
        $this->db->where('id_device', $id);
        $this->db->delete($this->device);
    }

    public function deletegjl_by_id($id)
    {
        $this->db->where('id_gejala', $id);
        $this->db->delete($this->devicegjl);
    }
    public function deletedmg_by_id($id)
    {
        $this->db->where('id_kerusakan', $id);
        $this->db->delete($this->devicedmg);
    }


    function get_datatables_dvc()
    {
        $this->_get_datatablesdvc_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getdvc_by_id($id)
    {
        $this->db->from($this->device);
        $this->db->where('id_device', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getgjl_by_id($id)
    {
        $this->db->from($this->devicegjl);
        $this->db->where('id_gejala', $id);
        $query = $this->db->get();

        return $query->row();
    }
    public function getdmg_by_id($id)
    {
        $this->db->from($this->devicedmg);
        $this->db->where('id_kerusakan', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_alldvc()
    {
        $this->db->select();
        $this->db->from('device_type');
        return $this->db->get()->result_array();
    }

    function get_datatables_gejala()
    {
        $this->_get_datatablesgejala_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function get_datatables_damage()
    {
        $this->_get_datatablesdamage_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
}
