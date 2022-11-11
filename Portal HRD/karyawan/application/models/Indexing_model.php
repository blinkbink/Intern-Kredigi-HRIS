<?php
class indexing_model extends CI_Model
{
    function integrity_login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query  = $this->db->get('user');

        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getProfile()
    {
        if(isset($_SESSION['username']) != null)
        {
            $this->db->select('*');
            $this->db->from('customer a');
            $this->db->join('users b', 'b.email=a.email', 'left');
            $this->db->where('a.email', $_SESSION['username']);
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

?>