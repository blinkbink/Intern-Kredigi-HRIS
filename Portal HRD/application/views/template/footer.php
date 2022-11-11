</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="sesi-bawah pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://kredigi.co.id">Kredigi</a>.</strong> All rights reserved.
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/fastclick/fastclick.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/dist/js/app.min.js') ?>"></script>
<script type="text/javascript">
	function checkSession() {
					$.ajax({
						url: '<?=site_url()?>/json/session',
						type: 'post',
						dataType: 'json',
						data: {},
						success: function(data){
							var minute = data.status > 1 ? "menit" : "menit";
							if(!$.isNumeric(data.status)){
								window.location.reload();
							}else
								$(".sesi-bawah").html('<b class="text-danger">'+data.status+' '+minute+' </b> Menuju logout otomatis');
						},
						error: function(){

						}
					});
				}

				checkSession();

				// Fungsi ajax untuk cek waktu server
				function checkWaktu() {
					$.ajax({
						url: '<?=site_url()?>/json/waktu',
						type: 'post',
						dataType: 'json',
						data: {},
						success: function(data){
							//console.log(data.waktu);
							$(".waktu-atas").html(data.waktu);
						},
						error: function(){

						}
					});
				}

				checkWaktu();

				// Ajax untuk mengecek timer di backend apakah udah saatnya logout otomatis atau belum
				setInterval(function(){
					checkSession();
					checkWaktu();
				}, 60000);


</script>