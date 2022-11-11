<?php
get_template('header');
?>

<?php
get_template('topbar');
get_template('sidebar');

//membuat referal go back nanti
$this->session->set_userdata('laman_slip_gaji', current_url());

$bulan= isset($bulan) ? $bulan : date('m');
$tahun= isset($tahun) ? $tahun : date('Y');
$jenis= isset($jenis) ? $jenis : '';
$backBulan= ($bulan!=1) ? ($bulan-1) : '12';
$backTahun= ($bulan!=1) ? ($tahun) : ($tahun-1);
$nextBulan= ($bulan!=12) ? ($bulan+1) : '1';
$nextTahun= ($bulan!=12) ? ($tahun) : ($tahun+1);
$this->Slip_gaji_model->get_gaji_available($jenis,$bulan,$tahun);

function getNamaBulan($bulan){
    switch ($bulan) {
        case '1': $bulan = 'Jan'; break;
        case '2': $bulan = 'Feb'; break;
        case '3': $bulan = 'Mar'; break;
        case '4': $bulan = 'Apr'; break;
        case '5': $bulan = 'Mei'; break;
        case '6': $bulan = 'Jun'; break;
        case '7': $bulan = 'Jul'; break;
        case '8': $bulan = 'Agu'; break;
        case '9': $bulan = 'Sep'; break;
        case '10': $bulan = 'Okt'; break;
        case '11': $bulan = 'Nov'; break;
        case '12': $bulan = 'Des'; break;
        default: break;
    }
    return $bulan;
}

//mengambil value dari url
$masterGajiID = $this->uri->segment('3');
$periodeName = $this->uri->segment('4');
$periodeName = str_replace("%20", " ", $periodeName); //menghilangkan karakter "%20"
$periodeAwalDate = $this->uri->segment('5');
$periodeAkhirDate = $this->uri->segment('6');
//$num = $this->uri->segment('7');

//tanggal before
$awalb4 ='';
$akhirb4='';

//tanggal sesudahnya
$awalaf ='';
$akhiraf ='';

//mengubah format yyyy-mm-dd menjadi format Indonesia dd MM yyyy
$tglAwalPisah = explode("-", $periodeAwalDate);
$tgl_awal = $tglAwalPisah[2];
$bln_awal = $tglAwalPisah[1];
$thn_awal = $tglAwalPisah[0];

$tglAkhirPisah = explode("-", $periodeAkhirDate);
$tgl_akhir = $tglAkhirPisah[2];
$bln_akhir = $tglAkhirPisah[1];
$thn_akhir = $tglAkhirPisah[0];

$bln_awal = getNamaBulan($bln_awal);
$bln_akhir = getNamaBulan($bln_akhir);

$tanggal_awal = $tgl_awal.' '.$bln_awal.' '.$thn_awal;
$tanggal_akhir = $tgl_akhir.' '.$bln_akhir.' '.$thn_akhir;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blank page
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Gaji</a></li>
        <li class="active">Periode Gaji</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
 <!-- Default box -->
    <div class="box">

<div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
</div>

<div class="box-body">
<div class="panel-body rad-b-n single_panel">
<!-- panel bar atas-->
<div class="row">
                            <div class="col-md-9">
                                <form class="form-inline" action="<?=site_url('gaji/optionperiode/'.$masterGajiID)?>" method="GET" id="opsi_gaji">
                                    <!-- Tombol back periode -->
<?php
//$list = $this->Slip_gaji_model->get_list_date_periodegaji($masterGajiID);
  //                                      var_dump($list);
//					echo "apaan ini: ".$list[2]['num'];
$before = $this->Slip_gaji_model->get_list_date_periodegaji($masterGajiID, $periodeAkhirDate, "<");
$num_b4 = count($before);

//echo "num: ".$num." numb4=".$num_b4;
//$numin = $num - 1;
$numb4 = $num_b4 - 1;
if($numb4 >= 0){
//$num = $num - 1;
//if($numin < 0){
//$numb4 = $num_b4 - 1;
?>
				    <div class="form-group">
                                        <button type="button" class="btn btn-default form-control gaji_option" onclick="document.location='<?=site_url('gaji/gajiperiode/'.$masterGajiID.'/'.$periodeName.'/'.$before[$numb4]['periode_awal'].'/'.$before[$numb4]['periode_akhir'])?>'" title="Ke Periode <?=$before[$numb4]['periode_awal'].' s.d. '.$before[$numb4]['periode_akhir']?>"><i class="fa fa-chevron-left"></i></button>
                                    </div> <!-- tombol back periode end -->
<?php } ?>
				    <!-- pilihan select periode bulan -->
                                    <div class="form-group">
                                        <select name="periode" class="form-control gaji_option" onchange="this.form.submit()">
                                        <?php
					//	$periodeDate = $this->Slip_gaji_model->getPeriodeDate($masterGajiID);
					//	foreach($data as $u => $value){
                			//	echo '<option value="hai">'.$periodeName.' '.$value['periode_awal'].'-'.$value['periode_akhir'].'</option>';
//}
 					$list = $this->Slip_gaji_model->get_list_date_periodegaji($masterGajiID);
					var_dump($list);
			                foreach($list as $u => $value){
					?>
					<option <?php if($periodeAkhirDate == $value['periode_akhir']){ ?>selected="selected"<?php }?> value="<?php echo $value['nama'].'/'.$value['periode_awal'].'/'.$value['periode_akhir'];?>">
					<?php 
						//mengubah format yyyy-mm-dd menjadi format Indonesia dd MM yyyy
						$tglAwPisah = explode("-", $value['periode_awal']);
						$tglawal = $tglAwPisah[2];
						$blnawal = $tglAwPisah[1];
						$thnawal = $tglAwPisah[0];

						$tglAkPisah = explode("-", $value['periode_akhir']);
						$tglakhir = $tglAkPisah[2];
						$blnakhir = $tglAkPisah[1];
						$thnakhir = $tglAkPisah[0];

						$blnawal = getNamaBulan($blnawal);
						$blnakhir = getNamaBulan($blnakhir);

						$tanggalawal = $tglawal.' '.$blnawal.' '.$thnawal;
						$tanggalakhir = $tglakhir.' '.$blnakhir.' '.$thnakhir;
						echo $value['nama']." Periode ".$tanggalawal." - ".$tanggalakhir; 
					?>
					</option>
					<?php } ?>
			<?php /*
                                            for ($i=1; $i <= 12; $i++) { 
                                                echo '<option '.is_selected($i,$bulan).' value="'.$i.'">'.bulan($i).'</option>';
                                            }//*/
                                            ?>
                                        </select>				  
                                    </div> <!-- pilihan select periode bulan end -->
				    <!-- Tombol next periode -->
<?php
$after = $this->Slip_gaji_model->get_list_date_periodegaji($masterGajiID, $periodeAkhirDate, ">");
$num_4f = count($after);

//echo "num_4f=".$num_4f;
//$numin = $num - 1;
//$numb4 = $num_b4 - 1;
$num4f = 0;
//echo " num4f: ".$num4f;
//echo " name= ".$periodeName;
//echo " tglawal: ".$after[$num4f]['periode_awal'];
if($num_4f > 0){
//$num = $num - 1;
//if($numin < 0){
//$numb4 = $num_b4 - 1;
?>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default form-control gaji_option" onclick="document.location='<?=site_url('gaji/gajiperiode/'.$masterGajiID.'/'.$periodeName.'/'.$after[$num4f]['periode_awal'].'/'.$after[$num4f]['periode_akhir'])?>'" title="Ke Periode <?=$after[$num4f]['periode_awal'].' s.d. '.$after[$num4f]['periode_akhir']?>"><i class="fa fa-chevron-right"></i></button>
                                    </div> <!-- Tombol next periode end -->
<?php } ?>
                                </form>
                            </div> <!-- </div><div class="row"> -->
                            <div class="col-md-3 pull-right">
                                <button class="btn btn-sm btn-success pull-right m-b-sm" id="buatSlipGaji">List Transfer Bank </button>
                           <!-- </div>
			    <div class="col-md-3 pull-right"> -->
                                <button class="btn btn-sm btn-success pull-right m-b-sm" id="buatSlipGaji" onclick="document.location='<?=site_url('gaji/rekap_excel/'.$masterGajiID.'/'.$periodeName.'/'.$periodeAwalDate.'/'.$periodeAkhirDate)?>'" >Rekap Gaji </button>
                            </div>
</div> <!-- panel bar atas end-->

<h3>
<?php
//$periodeName = str_replace("%20", " ", $periodeName);
	echo $periodeName.' Periode '.$tanggal_awal.'-'.$tanggal_akhir;
?>
</h3>		
<table class="table table-hover table-striped" >
<thead>
                                    <tr class="success">
			<th>Karyawan</th>
			<th>Status Absensi</th>
			<th>Status Pembayaran</th>
			<th>Aksi</th>
		</tr>
		 </thead>
                                    <tbody>
		<?php 
		//$masterGajiID = $this->uri->segment('3');
                //$periodeAkhirDate = $this->uri->segment('5');
                //echo $masterGajiID." dan ";
                //echo $periodeAkhirDate;
		$data = $this->Slip_gaji_model->get_periodegaji_list($masterGajiID, $periodeAkhirDate);	
		foreach($data as $u => $value){ 
		?>
		<tr>
        <?php 
        if($value['status_pembayaran']==="Belum"){ 
            $warna = "color:red";
        } else {
            $warna = "color:green";
        }
        ?>
			<td><a href=""><?=$value['nama_lengkap'] ?></a><br><?=$value['id_karyawan'] ?></td>
			<td><?=$value['status_absensi'] ?></td>
			<td><span style="<?=$warna?>"><?php echo anchor('gaji/changestatus/'.$value['periode_gaji_id'].'/'.$value['status_pembayaran'], $value['status_pembayaran']); ?></span></td>
			<td><?php echo anchor('gaji/slipgaji/'.$masterGajiID.'/'.$value['id_karyawan'].'/'.$value['periode_awal'].'/'.$value['periode_akhir'],'Lihat Slip');?></td>
<!--			<td><?php //echo anchor('gaji/slipgaji/?idmaster='.$masterGajiID.'&idkaryawan='.$value['id_karyawan'].'&dateawal='.$value['periode_awal'].'&dateakhir='.$value['periode_akhir'],'Lihat Slip');?></td> -->
		</tr>
		<?php } ?>



</tbody>
              </table>
                            </div>
                        </div>
                    </div>
</div><!-- /.box-body -->
<div class="box-footer">
            Footer
</div><!-- /.box-footer-->
</div><!-- /.box -->
</section><!-- /.content -->
<?php
get_template('footer');
?>
