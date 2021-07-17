<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_ask extends CI_Model
{
    var $damage = "kerusakan_device";
    var $device = "device_type";
    var $riwayat = "riwayat_jawaban";
    var $pertanyaan = "pertanyaan_kerusakan";
    var $rule   = "rule_kerusakan";

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

    public function getdeviid($id)
    {
        $this->db->from($this->device);
        $this->db->where('id_device', $id);
        return $this->db->get()->row_array();
    }

    public function getdamageid($id)
    {
        $this->db->from($this->damage);
        $this->db->where('id_kerusakan', $id);
        return $this->db->get()->row_array();
    }

    public function pertanyaan()
    {
        $this->db->select();
        $this->db->from($this->pertanyaan);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function caripertanyaan($id_konsultasi)
    {
        $this->db->select('jawaban');
        $this->db->from('riwayat_jawaban');
        $this->db->where('jawaban', 0);
        $this->db->where('id_konsultasirj', $id_konsultasi);
        $query = $this->db->get();
        $num = $query->num_rows();

        if ($num > 0) {

            $riwayat = $this->db->query("SELECT id_pertanyaanrj from riwayat_jawaban where jawaban ='0' and id_konsultasirj = '$id_konsultasi' ");

            $x = '';
            foreach ($riwayat->result() as $row) {
                $a = $row->id_pertanyaanrj;
                $vpNo[] = $a;
                $b[] = "id_pertanyaankerusakan not like '%$a%'";
                $x .= "$a,";
            }

            $kodeNo = $this->db->query("SELECT id_pertanyaankerusakan from rule_kerusakan where " . implode(" AND ", $b));
            $kodeNo = $kodeNo->result_array();

            if (!empty($kodeNo)) {
                foreach ($kodeNo as $data) {
                    $datx[] = $data;
                }

                foreach ($datx as $da) {
                    $p[] = $da['id_pertanyaankerusakan'];
                }

                $dtNo = implode(",", $p);
                $dtNo = explode(",", $dtNo);


                $removeNo = array_diff($p, $vpNo);

                $removeNo = implode(",", $removeNo);

                $removeNo = explode(",", $removeNo);

                foreach ($removeNo as $daata) {
                    $hasildataNo[] = "id_pertanyaankerusakan like '%$daata%'";
                }

                $this->db->select('jawaban');
                $this->db->from('riwayat_jawaban');
                $this->db->where('jawaban', 1);
                $this->db->where('id_konsultasirj', $id_konsultasi);
                $query2 = $this->db->get();
                $num2 = $query2->num_rows();
            } else {
                redirect('admin/ask/noresult');
            }

            if ($num2 > 0) {
                $qriwayat = $this->db->query("SELECT id_pertanyaanrj from riwayat_jawaban where jawaban ='1' and id_konsultasirj='$id_konsultasi' ORDER BY id_riwayatjawaban asc ");
                $qriwayat = $qriwayat->result_array();

                $b = '';


                foreach ($qriwayat as $k) {
                    $vpvpvp[] = $k['id_pertanyaanrj'];
                    $c = $k['id_pertanyaanrj'];
                    $b .= "%$c%";
                }

                foreach ($vpNo as $dataNo) {
                    $hasilNo[] = "id_pertanyaankerusakan Not like '%$dataNo%'";
                }

                foreach ($vpvpvp as $dataYa) {
                    $hasilYa[] = "id_pertanyaankerusakan Like '%$dataYa%'";
                }

                $query3 = $this->db->query("SELECT id_pertanyaankerusakan from rule_kerusakan  where " . implode(" AND ", $hasilYa) . " AND " . implode(" AND ", $hasilNo));
                $query3 = $query3->result_array();

                if (!empty($query3)) {
                    foreach ($query3 as $key) {
                        $hasilseluruh[] = $key['id_pertanyaankerusakan'];
                    }

                    $query4 = $this->db->query("SELECT id_pertanyaanrj from riwayat_jawaban where id_konsultasirj='$id_konsultasi' ");
                    $query4 = $query4->result_array();

                    foreach ($query4 as $key) {
                        $jawaban[] = $key['id_pertanyaanrj'];
                    }

                    $hasilseluruh = implode(",", $hasilseluruh);
                    $hasilseluruh = explode(",", $hasilseluruh);

                    $hasilFix = array_diff($hasilseluruh, $jawaban);

                    foreach ($hasilFix as $data) {
                        $resultdata[] = "id_pertanyaankerusakan like '%$data%'";
                    }
                    $query5 = $this->db->query("SELECT * from pertanyaan_kerusakan  where " . implode(" OR ", $resultdata) . "LIMIT 1");
                    $query5 = $query5->result_array();
                    return $query5;
                } else {
                    redirect('admin/ask/noresult');
                    // redirect('Halaman/noresult');
                }
            } else {
                $queryNosaja = $this->db->query("SELECT * from pertanyaan_kerusakan  where " . implode(" OR ", $hasildataNo) . "LIMIT 1");
                $queryNosaja = $queryNosaja->result_array();
                return $queryNosaja;
            }
        } else {

            $qRiwayat = $this->db->query("SELECT id_pertanyaanrj from riwayat_jawaban where jawaban ='1' and id_konsultasirj='$id_konsultasi' ORDER BY id_riwayatjawaban asc ");
            $qRiwayat = $qRiwayat->result_array();

            $b = '';
            foreach ($qRiwayat as $k) {
                $vpvpvp[] = $k['id_pertanyaanrj'];
                $c = $k['id_pertanyaanrj'];
                $b .= "%$c%";
            }

            $query2 = $this->db->query("SELECT id_pertanyaankerusakan from rule_kerusakan where id_pertanyaankerusakan like ('$b')");
            $query2 = $query2->result_array();

            if (empty($query2)) {
                redirect('admin/ask/noresult');
                var_dump('kosong if 3');
            }

            foreach ($query2 as $as) {
                $cca[] = $as['id_pertanyaankerusakan'];
            }

            foreach ($cca as $s) {
                $ba[] = $s;
            }

            $ba = implode(",", $ba);
            $ba = explode(",", $ba);

            $remove = array_diff($ba, $vpvpvp);

            foreach ($remove as $daata) {
                $cxxx = "$daata";
                $zzz[] = "id_pertanyaankerusakan LIKE '%$cxxx%'";
            }

            $queryAkhir = $this->db->query("SELECT * from pertanyaan_kerusakan  where " . implode(" OR ", $zzz) . "LIMIT 1");

            return $queryAkhir->result_array();
        }
    }


    private function _get_datatablesask_query($id_konsultasi)
    {

        $column_order = array('pertanyaan_kerusakan.pertanyaan', 'riwayat_jawaban.jawaban', null);
        $column_search = array('pertanyaan_kerusakan.pertanyaan');
        $order = array('riwayat_jawaban.id_riwayatjawaban' => 'asc');

        $this->db->from('riwayat_jawaban');
        $this->db->join('pertanyaan_kerusakan', 'pertanyaan_kerusakan.id_pertanyaankerusakan=riwayat_jawaban.id_pertanyaanrj');
        $this->db->where('riwayat_jawaban.id_konsultasirj', $id_konsultasi);

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

    public function get_datatables_ask($id_konsultasi)
    {
        $this->_get_datatablesask_query($id_konsultasi);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_jawaban($id_konsultasi)
    {
        $this->db->from('riwayat_jawaban');
        $this->db->where('id_konsultasirj', $id_konsultasi);
        return $this->db->count_all_results();
    }

    public function count_filtered_jawaban($id_konsultasi)
    {
        $this->_get_datatablesask_query($id_konsultasi);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function insertrekap($id_konsultasi, $id_user, $id_device, $queryHasilKerusakan2)
    {

        $time = date('Y-m-d H:i:s', time());
        $data = array(
            'id_konsultasirhk'      => $id_konsultasi,
            'id_kerusakanrhk'       => $queryHasilKerusakan2,
            'id_userrhk'            => $id_user,
            'id_devicerhk'          => $id_device,
            'datetime_rhk'          => $time,
        );

        $this->db->insert('rekap_hasilkonsultasi', $data);
    }
}
