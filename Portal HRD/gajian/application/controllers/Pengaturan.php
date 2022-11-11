<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends MY_Controller {
  
  public function __construct(){
    parent::__construct();    
    $this->load->model(array('Data_model', 'Slip_gaji_model'));
    $this->load->helper(array('form', 'security' ,'cookie','tgl_indo_helper'));
    $this->load->library(array('form_validation'));
  }

	public function index(){
		redirect('pengaturan/perusahaan');
	}
        
	public function perusahaan($action=''){
    $data['perusahaan']=$this->Perusahaan_model->get(get_user_info('perusahaan_ID'));
    
    if(empty($action)){
      $this->load->view('pengaturan/perusahaan',$data);
    }
    elseif($action=='form'){
      $this->load->view('pengaturan/form_perusahaan',$data); 
    }
    elseif($action=='update'){
      $post=$this->input->post(NULL,TRUE);
      $this->site->create_dir();
      $this->load->library('upload', $this->site->media_upload_config());

      if ($this->upload->do_upload('logo_perusahaan')){
        $upload_data = $this->upload->data();
        $filefullpath = '/uploads/'.get_user_info('perusahaan_ID').'/'.$upload_data['file_name'];
        $this->Perusahaan_model->update(array("logo_perusahaan"=>$filefullpath), array('perusahaan_ID' => get_user_info('perusahaan_ID')));
        $this->site->activity_log('Mengubah Logo Perusahaan', 'perusahaan',serialize($upload_data),'');
      }

      $this->Perusahaan_model->update($post, array('perusahaan_ID' => get_user_info('perusahaan_ID')));
      
      $this->site->activity_log('Merubah Data Perusahaan', 'perusahaan',serialize($post),'');

      redirect(site_url('pengaturan/Perusahaan'));
    }
    elseif($action=='gagal' || $action=='success'){
      if($action=='gagal'){
        $title_error='Maaf, Password Gagal Diubah';
        $pesan_error='Silahkan Ulangi atau Hubungi Administrator';
        $class='alert-danger';
      }
      else{
        $title_error='Selamat, Password Berhasil Diubah';
        $pesan_error='';
        $class='alert-success';
      }
      $data['error']='<div class="alert '.$class.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> '.$title_error.' </h4>'.$pesan_error.'</div>';
       $this->load->view('pengaturan/perusahaan',$data);
     }
	}
        
  public function data($param='',$action='',$id=""){
    if($param=='') redirect('pengaturan/data/divisi');
		if($action=='tambah' || $action=="update"){
      $rules = $this->Data_model->rules;
      $this->form_validation->set_rules($rules);

      $pesan_error='<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Maaf, Proses Gagal</h4>
                  %s '.$param.' wajib disi
                </div>';

      $this->form_validation->set_message('required', $pesan_error);

      if ($this->form_validation->run() == TRUE) {
        $post = $this->input->post(NULL, TRUE);
        $data=array(
                'perusahaan_ID' => get_user_info('perusahaan_ID'),
                'kategori_data' => $param,
                'nama_data' => $post['nama_data'],
                'status_data' => '1'
              );
    	  if($action=='tambah'){
           $getID = $this->Data_model->insert($data);
           $this->site->activity_log('Menambahkan Data '.$param,'data_perusahaan',serialize($data),''.$id.'');
        }
        elseif($action=='update'){
          $this->Data_model->update($data, array('data_ID' => $post['id_data']));
          $getID = $post['id_data'];
          $this->site->activity_log('Merubah Data '.$param,'data_perusahaan',serialize($data),''.$id.'');
        }

        if(!empty($getID))
          redirect('pengaturan/data/'.$param);

      }
      
      $data['error']='';
      $data[$param]=$this->Data_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'kategori_data' => $param));
      $this->load->view('pengaturan/'.$param,$data);
    }
    elseif($action=='stat'){
        if($id !=NULL){
          $status_data=$this->Data_model->get_data_detail($id,'status_data');
          if($status_data==1){
            $stat_id='0';
            $stat_act="Menonaktifkan Data ".$param;
          }
          else{
            $stat_id='1';
            $stat_act="Mengaktifkan Data ".$param;
          }

          $this->Data_model->update(array('status_data' => $stat_id), array('data_ID' => $id));
          $this->site->activity_log($stat_act,'data_perusahaan',serialize($data),''.$id.'');
        
        }
        redirect('pengaturan/data/'.$param);
    }
    elseif($action=='hapus'){
        $post = $this->input->post(NULL, TRUE);
        
        if(!empty($post['id_data'])){     
          $use=$this->Data_model->data_use(array($param.'_ID'=>$post['id_data']));
          if($use==0)  
            $this->Data_model->delete($post['id_data']);
          else
            redirect('pengaturan/data/'.$param.'/error/gagal-hapus');
        }
        redirect('pengaturan/data/'.$param);
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
      
      $data['error']='';
      $data[$param]=$this->Data_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'kategori_data' => $param));
      $this->load->view('pengaturan/'.$param,$data);
    }
    
	}

   public function komponen($param='',$action='',$id="")
  {
    if($param=='') redirect('pengaturan/data/divisi');
    elseif($param=='pendapatan') $data['utama']=$this->Data_model->pendapatan_utama();

    $data['error']='';
    $data[$param]=$this->Data_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID'), 'kategori_data' => $param));

    if($action=='tambah' || $action=="update"){
      $rules = $this->Data_model->rules;
      $this->form_validation->set_rules($rules);

      $pesan_error='<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Maaf, Proses Gagal</h4>
                  %s '.$param.' wajib disi
                </div>';

      $this->form_validation->set_message('required', $pesan_error);

      if ($this->form_validation->run() == TRUE) {
        $post = $this->input->post(NULL, TRUE);
        $post_data=array(
                'perusahaan_ID' => get_user_info('perusahaan_ID'),
                'kategori_data' => $param,
                'nama_data' => $post['nama_data'],
                'option_data' => $post['option_data'],
                'status_data' => '1'
              );
        if($action=='tambah'){
           $getID = $this->Data_model->insert($post_data);
           $this->site->activity_log('Menambahkan Komponen '.$param,'data_perusahaan',serialize($post_data),''.$id.'');
        }
        elseif($action=='update'){
          $this->Data_model->update($post_data, array('data_ID' => $post['id_data']));
          $getID = $post['id_data'];
          $this->site->activity_log('Merubah Komponen '.$param,'data_perusahaan',serialize($post_data),''.$id.'');
        }

        if(!empty($getID))
          redirect('pengaturan/komponen/'.$param);

      }

      $this->load->view('pengaturan/'.$param,$data);
    }
    elseif($action=='stat'){
        if($id !=NULL){
          $status_data=$this->Data_model->get_data_detail($id,'status_data');
          if($status_data==1){
            $stat_id='0';
            $stat_act="Menonaktifkan Komponen ".$param;
          }
          else{
            $stat_id='1';
            $stat_act="Mengaktifkan Komponen ".$param;
          }

          $this->Data_model->update(array('status_data' => $stat_id), array('data_ID' => $id));
          $this->site->activity_log($stat_act,'data_perusahaan',serialize($data),''.$id.'');
        
        }
        redirect('pengaturan/komponen/'.$param);
    }
    elseif($action=='hapus'){
        $post = $this->input->post(NULL, TRUE);
        
        if(!empty($post['id_data'])){     
          //$use=$this->Data_model->data_use(array($param.'_ID'=>$post['id_data']));
          //if($use==0)  
            $this->Data_model->delete($post['id_data']);
          //else
            //redirect('pengaturan/komponen/'.$param.'/error/gagal-hapus');
        }
        redirect('pengaturan/komponen/'.$param);
    }
    elseif($action=='error'){
      if(!empty($id)){        
        if($id=='gagal-hapus'){
            $title_error='Maaf, Komponen Tidak Bisa dihapus';
            $pesan_error='komponen sudah digunakan';
        }          
        else
          redirect('pengaturan/komponen/'.$param);
          
      
        $data['error']='<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> '.$title_error.' </h4>'.$pesan_error.'</div>';
        
        $this->load->view('pengaturan/'.$param,$data);
      }
      else{
        redirect('pengaturan/komponen/'.$param);
      }
     
    }
    else{
      
      
      $this->load->view('pengaturan/'.$param,$data);
    }
    
  }
	
	public function gaji($param='',$action='',$id='')
	{
		
    if($param=='slip'){
      if($action=='edit'){
        $data['error']='';
        $count_data=$this->Slip_gaji_model->count(array('master_gaji_ID' => $id,'perusahaan_ID' => get_user_info('perusahaan_ID')));
        if($count_data>0){
          $data['slip']=$this->Slip_gaji_model->get($id);
          $data['item_pendapatan']=$this->Slip_gaji_model->get_data_detail($id,'pendapatan');
          $data['item_potongan']=$this->Slip_gaji_model->get_data_detail($id,'potongan');
          $data['option_pendapatan']=$this->Slip_gaji_model->get_data_param($id,'pendapatan');          
          $data['option_potongan']=$this->Slip_gaji_model->get_data_param($id,'potongan');
          $this->load->view('pengaturan/form_gaji',$data);
        }
        else{
           redirect('pengaturan/gaji/slip');
        }
        
      }
      elseif($action=='tambah' || $action=='update'){
        $rules = $this->Slip_gaji_model->rules;
        $this->form_validation->set_rules($rules);

        $pesan_error='<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Maaf, Proses Gagal</h4>
                  %s '.$param.' wajib disi
                </div>';

        $this->form_validation->set_message('required', $pesan_error);

        if ($this->form_validation->run() == TRUE) {
          $post = $this->input->post(NULL, TRUE);
          $data_post=array(
                'perusahaan_ID' => get_user_info('perusahaan_ID'),
                'master_gaji_nama' => $post['nama'],
                'master_gaji_tipe' => $post['tipe'],
                'master_gaji_jangka' => $post['jangka'],
                'master_gaji_tglCutOff1' => $post['tglCutOff1'],
                'master_gaji_hariCutOff' => $post['hariCutOff'],
                'master_gaji_jumlahHari' => $post['jumlahHari'],
                'master_gaji_tglAbsensi' => $post['tglAbsensi'],
                'master_gaji_tglCutOff2' => date('Y-m-d',strtotime($post['tglCutOff2']))
          );

          //print_r($post);

          if($action=='tambah'){
            $getID = $this->Slip_gaji_model->insert($data_post);
            $this->site->activity_log('Menambahkan Slip Gaji','master_gaji',serialize($data_post),''.$getID.''); 

          }
          elseif($action=='update'){
            $this->Slip_gaji_model->update($data_post, array('master_gaji_ID' => $post['id_data']));
            $getID = $post['id_data'];
            $this->site->activity_log('Merubah Slip Gaji','master_gaji',serialize($data_post),''.$getID.''); 
          }

          if(!empty($getID))
            redirect('pengaturan/gaji/slip/edit/'.$getID);
          else{
            redirect('pengaturan/gaji/slip');
          }
        }
        else
          redirect('pengaturan/gaji/slip/error/gagal-proses');       
      }
      elseif($action=='hapus'){        
        if(!$id==''){     
         echo $use=$this->Slip_gaji_model->data_use("group_gaji LIKE '%\"".$id."\"%'");
        
          if($use==0)  
            $this->Slip_gaji_model->delete($id);
          else
            redirect('pengaturan/gaji/slip/error/gagal-hapus');
        }
        redirect('pengaturan/gaji/slip');
      }
      elseif($action=='error'){
        if(!empty($id)){        
          if($id=='gagal-hapus'){
              $title_error='Maaf, Data Tidak Bisa dihapus';
              $pesan_error='data sudah digunakan';
          }          
          elseif($id=='gagal-proses'){
              $title_error='Maaf, Data Gagal Diproses';
              $pesan_error='Silahkan Ulangi Kembali atau Hubungi Administrator';
          }          
          else
            redirect('pengaturan/gaji/slip');
            
        
          $data['error']='<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> '.$title_error.' </h4>'.$pesan_error.'</div>';
          $data['slip']=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID')));
          $this->load->view('pengaturan/gaji',$data);
        }
        else{
          redirect('pengaturan/gaji/'.$param);
        }
       
      }
      
      else{
        $data['error']='';
        $data['slip']=$this->Slip_gaji_model->get_by(array('perusahaan_ID' => get_user_info('perusahaan_ID')));
        $this->load->view('pengaturan/gaji',$data);
      }
    }
    elseif($param=='item'){
      $post = $this->input->post(NULL, TRUE);
      if($action=='potongan' || $action=='pendapatan'){
         $data_post=array(
          'master_gaji_ID'=>$post['id_slip'],
          'data_ID'=>$post['id_'.$action]
        );
       //  print_r($data_post);
        $this->db->set($data_post);
        $this->db->insert('master_gaji_item');
        $getID = $this->db->insert_id();
        $this->site->activity_log('Menambahkan Item Komponen','master_gaji_item',serialize($data_post),''.$getID.'');
      }
      elseif($action=='hapus'){
        $this->db->where('data_ID',$post['id_data']);
        $this->db->limit(1);
        $this->db->delete('master_gaji_item');
        $this->site->activity_log('Menghapus Item Komponen','master_gaji_item',serialize($post),''.$post['id_data'].'');
      }
      redirect('pengaturan/gaji/slip/edit/'.$post['id_slip']);        
    }
    else
      redirect('pengaturan/gaji/slip');
	}
}
