<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 27/07/2017
 * Time: 11:12
 */

class karyawan_model extends CI_Model
{
    var $conf;
    public function getProfile()
    {
            $this->db->select('*');
            $this->db->from('karyawan a');
            $this->db->join('user b', 'b.karyawan_ID = a.karyawan_ID', 'left');
            $this->db->where('b.username', $_SESSION['username']);
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

    public function getPerubahan()
    {

            $this->db->select('*');
            $this->db->from('user a');
            $this->db->join('perubahan b', 'b.id_karyawan = a.karyawan_ID', 'left');
            $this->db->where('a.username', $_SESSION['username']);
            $this->db->order_by("idperubahan", "DESC");
            $this->db->limit(1);
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

    public function getTIM($tim)
{

        $this->db->select('*');
        $this->db->from('TIM a');
        $this->db->join('karyawan b', 'b.karyawan_ID = a.id_karyawan', 'left');
        $this->db->where('a.nama_tim', $tim);
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

    public function getKodeTIM($id_karyawan)
    {

            $this->db->select('*');
            $this->db->from('TIM a');
            $this->db->where('a.id_karyawan', $id_karyawan);
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

    public function getNotifikasi($id_karyawan)
    {

            $this->db->select('judul, tanggal_notifikasi');
            $this->db->from('notifikasi a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.karyawan_ID', 'left');
            $this->db->where('a.id_karyawan', $id_karyawan);
            $this->db->order_by('a.tanggal_notifikasi', "ASC");
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

    public function getCountNotifikasi($id_karyawan)
    {

            $this->db->select('COUNT(tanggal_notifikasi) as total');
            $this->db->from('notifikasi a');
            $this->db->join('karyawan b', 'a.id_karyawan = b.karyawan_ID', 'left');
            $this->db->where('timestampdiff(day,now(), tanggal_notifikasi) <= 2');
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

    public function getKalender($year, $month)
    {
        $query = $this->db->select('date, title')->from('kalender')->like('date', "$year-$month", 'after')->get();

        $data = array();

        foreach($query->result() as $row)
        {
            $data[substr($row->date,9,2)] = $row->title;
        }
        return $data;
    }

    public function generate($year, $month)
    {
        $this->conf = array(
            'start_day' => 'monday',
            'show_next_prev' => true,
            'next_prev_url' => base_url()."karyawan/kalender"
        );

        $this->conf['template'] =
            '
        {table_open}<table align="center" border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}"><h1 align="center"><br>{heading}</h1></th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days" >{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}
        <div class="day_num">{day}</div>
        <div class="content">{content}</div>
        {/cal_cell_content}
        {cal_cell_content_today}
        <div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>
        {/cal_cell_content_today}

        {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';

        $this->load->library("calendar", $this->conf);

        $data = $this->getKalender($year, $month);
        //$data = array(15 => "data");

        return $this->calendar->generate($year, $month, $data);
    }
}

?>