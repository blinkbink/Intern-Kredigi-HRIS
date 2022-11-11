<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 31/07/2017
 * Time: 10:45
 */

class tim extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }


}