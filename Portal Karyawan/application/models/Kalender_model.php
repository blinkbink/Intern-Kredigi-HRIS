<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 27/07/2017
 * Time: 11:12
 */

class kalender_model extends CI_Model
{
    //var $conf;
    public function __construct() {
        parent::__construct();
    }

    public function getKalender()
    {
        $this->db->select('tanggalLibur, Keterangan');
        $this->db->from('tanggal_libur');
        $query = $this->db->get();
        if ($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
}
?>