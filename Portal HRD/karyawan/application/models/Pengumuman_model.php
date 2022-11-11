<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:19
 */

class pengumuman_model extends CI_Model
{
    public function getPengumuman($like)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('pengumuman a');
            $this->db->like('judul', $like);
            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
    }

    public function getDetailPengumuman($id)
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('pengumuman');
            $this->db->where('idpengumuman', $id);
            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else
            {
                return false;
            }
        }
    }
}