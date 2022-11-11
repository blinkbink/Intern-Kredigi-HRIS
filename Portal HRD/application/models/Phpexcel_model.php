<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Phpexcel_model extends CI_Model {

    public function upload_data($filename){
        ini_set('memory_limit', '-1');
        //$inputFileName = './assets/uploads/'.$filename;
        $inputFileName = './gambar/'.$filename;
        try {
        	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        } catch(Exception $e) {
        	die('Error loading file :' . $e->getMessage());
        }

        $worksheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        $numRows = count($worksheet);
        //$nr = count($xls_data); //number of rows
        //$html_tb = implode(';', $xls_data[1]);
        $tgl_today = date("Y-m-d h:i:s");

        for ($i=2; $i < ($numRows+1) ; $i++) { 
            /*
            $tgl_asli = str_replace('/', '-', $worksheet[$i]['B']);
            $exp_tgl_asli = explode('-', $tgl_asli);
            $exp_tahun = explode(' ', $exp_tgl_asli[2]);
            $tgl_sql = $exp_tahun[0].'-'.$exp_tgl_asli[0].'-'.$exp_tgl_asli[1].' '.$exp_tahun[1];
            //*/
	    //$dateymd = DateTime::createFromFormat('d/m/Y', $worksheet[$i]["F"])->format('Y-m-d');
	    $pisahtgl = explode('/', $worksheet[$i]["F"]);
	    $dateymd = $pisahtgl[2].'-'.$pisahtgl[1].'-'.$pisahtgl[0];
            $ins = array(
                    "kode_absensi"  => $worksheet[$i]["A"],
                    "name"          => $worksheet[$i]["D"],
                    //"date"          => $worksheet[$i]["F"],
                    "date"          => $dateymd,
                    "timetabel"     => $worksheet[$i]["G"],
                    "on_duty"       => $worksheet[$i]["H"],
                    "off_duty"      => $worksheet[$i]["I"],
                    "clock_in"      => $worksheet[$i]["J"],
                    "clock_out"     => $worksheet[$i]["K"],
                    "late"          => $worksheet[$i]["N"],
                    "early"         => $worksheet[$i]["O"],
                    "absent"        => $worksheet[$i]["P"],
                    "ot_time"       => $worksheet[$i]["Q"],
                    "work_time"     => $worksheet[$i]["R"],
                    "att_time"      => $worksheet[$i]["Z"],
                    "tgl_input"     => $tgl_today,
                    "filename"      => $filename
                   );

            $this->db->insert('absensi', $ins);
        }
    }

    function tampil_data(){
        return $this->db->get('absensi');
    }

    function get_users() {
        $query = $this->db->get('usertable');
        return $query->result_array();
    }

}

/* End of file Phpexcel_model.php */
/* Location: ./application/models/Phpexcel_model.php */
