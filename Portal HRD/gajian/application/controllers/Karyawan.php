<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller {

  public function __construct(){
    parent::__construct();    
    $this->load->model(array('Karyawan_model','Data_model','Karir_model','Master_model','Slip_gaji_model'));
    $this->load->helper(array('form', 'security' ,'tgl_indo_helper'));
    $this->load->library(array('form_validation'));
  }

	public function index(){
    $data['karyawan']=$this->Karyawan_model->get_by(array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
    $this->load->view('karyawan/data',$data);
  }

  public function tambah(){
    $this->load->view('karyawan/form_tambah');
  }
  public function action($action=NULL,$id=NULL){
    if($action=='tambah' || $action=="update"){
      $rules = $this->Karyawan_model->rules;
      $this->form_validation->set_rules($rules);

      $pesan_error='<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Maaf, Proses Gagal</h4>
                  %s  wajib disi
                </div>';

      $this->form_validation->set_message('required', $pesan_error);

      if ($this->form_validation->run() == TRUE) {
        $data_post = $this->input->post(NULL, TRUE);
       
        unset($data_post['nama_sama']);


        $data_post['mulai_kerja']=date('Y-m-d',strtotime($data_post['mulai_kerja']));
        $data_post['tgl_berlaku']=date('Y-m-d',strtotime($data_post['tgl_berlaku']));
        $data_post['tgl_lahir']=date('Y-m-d',strtotime($data_post['tgl_berlaku']));

         print_r($data_post);
        if($action=='tambah'){

           $getID = $this->Karyawan_model->insert($data_post);
           $this->site->activity_log('Menambahkan Data karyawan','karyawan',serialize($data_post),''.$getID.'');
        }
        elseif($action=='update'){
          $this->Karyawan_model->update($data_post, array('karyawan_ID' => $data_post['karyawan_ID']));
          $getID = $data_post['karyawan_ID'];
         // $this->site->activity_log('Merubah Data Karyawan','karyawan',serialize($data),''.$id.'');
        }

        if(!empty($getID))
          redirect(site_url().'karyawan/detail/'.$getID);

     }
    }
     elseif($action=='hapus'){
        $post = $this->input->post(NULL, TRUE);

        
        if(!empty($post['id_data'])){     
          echo $use=$this->Karyawan_model->get_karir($post['id_data']);
          if(empty($use))  
            $this->Karyawan_model->delete($post['id_data']);
          else
            redirect('karyawan');
        }
        redirect('karyawan');
        //print_r($use);
    }
    elseif($action=='error'){
      if(!empty($id)){        
        if($id=='gagal-hapus'){
            $title_error='Maaf, Data Tidak Bisa dihapus';
            $pesan_error='data sudah digunakan';
        }          
        else
          redirect('pengaturan/data/'.$param);
          
      
        $data['error']='<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> '.$title_error.' </h4>'.$pesan_error.'</div>';
        $data[$param]=$this->Data_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'kategori_data' => $param));
        $this->load->view('pengaturan/'.$param,$data);
      }
      else{
        redirect('pengaturan/data/'.$param);
      }
     
    }
    else{
      
     redirect(site_url().'karyawan');
    }
    
  }
  public function edit($id){
     if(!empty($id)){
        $data['karyawan']=$this->Karyawan_model->get_karyawan_detail($id);
        if(!empty($data['karyawan']))
          $this->load->view('karyawan/form_edit',$data);
        else
          redirect(site_url('karyawan'));
      }
      else
          redirect(site_url('karyawan'));
  }

  public function detail($id){
     if(!empty($id)){
        $data['karir']=$this->Karir_model->get_data_karir();
        $data['karyawan']=$this->Karyawan_model->get_karyawan_detail($id);
        if(!empty($data['karyawan']))
          $this->load->view('karyawan/detail',$data);
        else
          redirect(site_url('karyawan'));
      }
      else
          redirect(site_url('karyawan'));
  }

    
  public function karir($param=NULL,$id=NULL){
    if($param=='tambah'){
      if(!empty($id)){
        $data['karyawan']=$this->Karyawan_model->get_karyawan_detail($id);
        $data['karir']=$this->Karir_model->get_by(array('perusahaan_ID'=>get_user_info('perusahaan_ID'),'karyawan_ID' => $id));
        if(!empty($data['karyawan']))
          $this->load->view('karyawan/tambah_karir',$data);
        else
          redirect(site_url('karyawan/karir'));
      }
      else
          redirect(site_url('karyawan/karir'));
    }
    elseif($param=='detail'){
      if(!empty($id)){
        $data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
        $data['karir']    = $this->Karir_model->get_by(array('karyawan_ID' => $id));
        if(!empty($data['karyawan']))
          $this->load->view('karyawan/detail_karir',$data);
        else
          redirect(site_url('karyawan/karir'));
      }
      else
        redirect(site_url('karyawan/karir'));
    }
    elseif($param=='action'){
      $post = $this->input->post(NULL, TRUE);

      $post_gaji= array(

        );

      $post_data = array(
              'perusahaan_ID' => get_user_info('perusahaan_ID'),
              'karyawan_ID' => $post['id_karyawan'],
              'divisi_ID' => @$post['bagian'] ,
              'jabatan_ID' => @$post['jobtitle'],
              'grade' => @$post['grade'],
              'status_ID' => @$post['status'],
              'tipe_ID' => $post['tipe'],
              'tgl_efektif' => date('Y-m-d',strtotime($post['tgl_efektif'])),
              'stat_efektif' => '1',
              'group_gaji' => json_encode(@$post['gg']),  
              'gaji_detail' => json_encode(@$post['inc']),             
            );
      //print_r($post_data);
      if($id=='tambah' || $id=="update"){
        $this->Karir_model->update(array('tgl_stop'=>date('Y-m-d',strtotime($post['tgl_efektif'])),'stat_efektif'=>'0'),array('stat_efektif'=>'1','karyawan_ID'=>$post['id_karyawan']));
        //$this->Karir_model->update(array('stat_efektif'=>'0'),array('karyawan_ID'=>$post['id_karyawan']));
        $getID = $this->Karir_model->insert($post_data);
        if(!empty($getID))
          redirect(site_url('karyawan/karir/detail/'.$getID));
        else
          redirect(site_url('karyawan/karir/detail/'.$post['karyawan_ID']));
      }
    }
    elseif($param=='ajax'){
      $post = $this->input->post(NULL, TRUE);
      //print_r($data_post);
       //$data['karyawan'=$this->Karyawan_model->get_karyawan_detail($post['grupGaji'],);
       $html='
         <div class="col-md-6">
            <h4 class="line-t-b">Income</h4>';
            $pendapatan= $this->Slip_gaji_model->get_data_detail($post['grupGaji'],'pendapatan');
            //print_r($pendapatan);
            if(count($pendapatan)>0){
            foreach ($pendapatan as $key => $value) { 
              if($value->option_data=='Tergantung Kehadiran') $rate='Rate'; else $rate='Nilai';
              if($value->option_data=='Uang Lembur'){
                $html.='
                <div class="form-group">
                  <label for="" class="control-title col-md-4 col-xs-12 ">'.$value->nama_data.'</label>
                  <label for="" class="control-title col-md-2 col-xs-4">Rate</label>
                  <div class="col-md-6 col-xs-8">
                    <div class="input-group">
                      <div class="input-group-addon">Rp</div>
                      <input type="text" class="form-control text-right mataUang" placeholder="Amount" value="25000" name="inc['.$value->master_gaji_ID.']['.$value->data_ID.']" required="" readonly>
                    </div>
                    <div></div>
                    <p class="help-block text-right"></p>
                  </div>
                </div>
              ';

              }else{
              $html.='
                <div class="form-group">
                  <label for="" class="control-title col-md-4 col-xs-12">'.$value->nama_data.'</label>
                  <label for="" class="control-title col-md-2 col-xs-4">'.$rate.'</label>';
                     if($value->option_data=='Manual'){
                        $html.='
                    <div class="col-md-6 col-xs-8 text-right"><label class="control-label"><em>Nilai dimasukkan di slip gaji</em></label></div>';
                     }
                     else{
                       $html.='
                  <div class="col-md-6 col-xs-8">
                      <div class="input-group">
                      <div class="input-group-addon">Rp</div>
                      <input type="text" class="form-control text-right mataUang" placeholder="Amount" value="" name="inc['.$value->master_gaji_ID.']['.$value->data_ID.']" required="" >

                    </div>';
                  }
                   $html.='
                    <div></div>
                    <p class="help-block text-right"></p>
                  </div>
                </div>
              ';
            }
           }
         }
         else{
          $html.=' <label for="" class="control-title col-md-12 col-xs-12">Tidak Ada Pendapatan</label>';
         }
            $html.='
          </div>
          <div class="col-md-6">
            <h4 class="line-t-b">Deduction</h4>';
            $potongan= $this->Slip_gaji_model->get_data_detail($post['grupGaji'],'potongan');
            if(count($potongan)>0){
            foreach ($potongan as $key => $value) { 
            
                $html.='
                <div class="form-group">
                  <label for="" class="control-title col-md-4 col-xs-12">'.$value->nama_data.'</label>
                  <label for="" class="control-title col-md-2 col-xs-4">Nilai</label>
                  <div class="col-md-6 col-xs-8 text-right"><label class="control-label"><em>Nilai dimasukkan di slip gaji</em></label></div>
                </div>
              ';

              }
           }
           else{
             $html.=' <label for="" class="control-title col-md-12 col-xs-12">Tidak Ada Potongan</label>';
           }
          $html.='</div>';
            echo json_encode(array('item'=>$html));
    }
    elseif($param=='view'){
      if(!empty($id)){
        $karir=$data['karir']=$this->Karir_model->get_karir($id);
        $data['karyawan']=$this->Karyawan_model->get_karyawan_detail($karir->karyawan_ID);
        if(!empty($data['karir']) && !empty($data['karyawan']))
          //print_r($data);
          $this->load->view('karyawan/view_karir',$data);
        else
          redirect(site_url('karyawan/karir'));
      }
      else
        redirect(site_url('karyawan/karir'));
    }
    else{
      $data['karir']=$this->Karir_model->get_data_karir();
      $this->load->view('karyawan/karir',$data);
    }
  }
  
}
