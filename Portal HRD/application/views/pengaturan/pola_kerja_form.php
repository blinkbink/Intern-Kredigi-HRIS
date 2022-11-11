<?php
get_template('header');
?>
<!--tambahkan custom css disini-->

<?php
get_template('topbar');
get_template('sidebar');
?>



  <div id="page-content" class="single_panel">

    <script type="text/javascript">
      console.log("");
    </script>
<style type="text/css">
  .libur  {
    background: #fa8072 !important;
  }
  .selectlibur {
    background: url(../assets/images/caretDown2.png) right 5px center no-repeat #fa8072 !important;
    background-size: 30px 30px !important;
    -moz-appearance: none;
    -webkit-appearance: none;
    -ms-appearance: none;
    -o-appearance: none;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panelGadjian">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-12">
              <h3 class="panel-title">Tambah Pola dan Jadwal Kerja Baru</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <ol class='breadcrumb'><li><a href="/depan">Beranda</a></li><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Pengaturan <span class="caret"></span></a><ul class="dropdown-menu"><li ><a href="/Pengaturanbagian">Bagian & Pekerjaan</a></li><li ><a href="/Pengaturankalender">Kalender </a></li><li ><a href="/Pengaturangaji">Gaji & LTHR</a></li><li ><a href="/Penggajian">Penggajian</a></li><li ><a href="/Pengaturancuti">Cuti</a></li><li ><a href="/Pengaturanizin">Izin</a></li><li ><a href="/Pengaturanpph">PPh 21</a></li><li ><a href="/Pengaturanbpjs">BPJS</a></li><li class="active"><a href="/pengaturanpolker">Pola & Jadwal Kerja</a></li></li></ul><li class="active">Pola & Jadwal Kerja</li></ol>          </div>
        </div>
        <div class="panel-body single_panel p-t-lg">
          <div class="row">
            <div class="col-xs-12">
              <form class="form-horizontal" method="post" action="<?=site_url('pengaturan/pola_kerja/list/tambah')?>" id="pengaturanpolker" novalidate>
                <div class="form-group">
                  <label class="col-md-2 col-xs-4 control-label">Nama Pola Kerja</label>
                  <div class="col-md-6 col-xs-8">
                    <input type="text" class="form-control" name="pola_kerja" id="polakerja" required data-validation-required-message="Nama pola kerja tidak boleh kosong">
                    <p class="help-block"></p>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3 col-xs-12 col-md-offset-2">
                    <div class="checkbox">
                      <label><input type="checkbox" id="pengaturantoleransi" checked> Terapkan toleransi keterlambatan</label>
                    </div>
                  </div>
                </div>

                <div class="form-group" id="toleransiketerlambatan">
                  <label class="control-label col-xs-4 col-md-2">Toleransi Keterlambatan</label>
                  <div class="col-xs-6 col-md-8">
                    <div class="row">
                      <div class="col-md-2 col-xs-6">
                        <input type="number" name="toleransi" class="form-control" value="0" min="0" data-validation-min-message="Lama keterlambatan tidak bisa lebih kecil daripada 0 menit">
                      </div>
                      <div class="col-md-2 col-xs-3" style="padding: 0">
                        <label class="control-label">Menit</label>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 col-xs-12">
                        <p class="help-block"></p>
                      </div>
                    </div>
                  </div>
                </div>

<div id="dynamicInput" class="form-group polahari" style="margin-top: 2%">
  <input class="center-right" type="button" value="Tambahkan hari" onClick="addInput('dynamicInput');">
  <div class="col-md-offset-2 col-md-10">
    <div class="checkbox col-md-2">
      <label><input type='hidden'  id="haricheck1" name='hari[]' value='1'> Hari 1</label>
    </div>
    <div class="col-md-3">
      <select name="status_hari[]" class="form-control hariselect" id="hariselect1'">
        <option value="Hari Kerja">Hari Kerja</option>
        <option value="Hari Libur">Hari Libur</option>
      </select>
    </div>
    <div class="col-md-3 col-xs-12">
      <div style="width: auto" id="harimasuk1" class="timepicker-masuk bfh-timepicker" data-time="08:00" data-toggle="tooltip" title data-original-title="Jam masuk berformat 24 jam">
        <input type="text" class="form-control" name="jam_masuk[]" id="polakerja" required data-validation-required-message="Nama pola kerja tidak boleh kosong">
      </div>
    </div>
    <h5 class="col-md-1" style="text-align: center;">s/d</h5>
    <div class="col-md-3 col-xs-12">
      <div style="width: auto" id="haripulang1" class="timepicker-pulang bfh-timepicker" data-time="17:00" data-toggle="tooltip" title data-original-title="Jam masuk berformat 24 jam">
        <input type="text" class="form-control" name="jam_pulang[]" id="polakerja" required data-validation-required-message="Nama pola kerja tidak boleh kosong">
      </div>
    </div>
  </div>  
</div>

                <div id="polahari" style="margin-top: 2%"></div>

                <input type='hidden' name='konci' value='305868476543564b6f42504d4a624c3343614146544c667a4e59773949655a51'>
                <div class="form-group">
                  <div class="col-md-12">
                    <div class="pull-right">
                      <button type="submit" class="btn btn-warning btn-gadjian" id="submit">Simpan</button>
                      <button type="button" class="btn btn-danger btn-gadjian" onclick="back()">Batal</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/assets/js/BootstrapFormHelpers-master/dist/js/bootstrap-formhelpers.min.js" type="text/javascript"></script>
<script src="/assets/js/jqBootstrapValidation-master/dist/jqBootstrapValidation-1.3.7.min.js" type="text/javascript"></script>

<script type="text/javascript">
  $("#pengaturantoleransi").click(function(){
    if ($(this).is(':checked')) {
      $("#toleransiketerlambatan").show();
    } else {
      $("#toleransiketerlambatan").hide();
    }
  });
</script>

<script type="text/javascript">
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>

<script type="text/javascript">
  var jumlahHariLama = 0;
  $("#jumlahhari").on('input', function(){
    var jumlahHari = parseInt($("#jumlahhari").val()) || 0;

    if (jumlahHari > 0) {
      $("#btnsetting").removeAttr("data-toggle");
      $("#btnsetting").removeAttr("disabled");
      $("#btnsetting").removeAttr("data-placement");
      $("#btnsetting").removeAttr("data-original-title");

      $("#btnsetting").attr("data-toggle", "modal");
      $("#btnsetting").attr("data-target", "#modalsetting");
    } else {
      $("#btnsetting").removeAttr("data-toggle");
      $("#btnsetting").removeAttr("data-target");

      $("#btnsetting").attr("data-toggle", "tooltip");
      $("#btnsetting").attr("disabled", true);
      $("#btnsetting").attr("data-placement", "top");
      $("#btnsetting").attr("data-original-title", "Harap masukkan jumlah hari pola kerja terlebih dahulu");
    }

    var banyakIterasi = 0;
    var hari = 0;
    if (jumlahHari < jumlahHariLama) {
      $(".polahari").remove();
      banyakIterasi = jumlahHari;
      hari = 0;
    } else {
      banyakIterasi = jumlahHari - jumlahHariLama;
      hari = jumlahHariLama;
    }

    for(i = 0; i < banyakIterasi; i++){
      $("#polahari").append('<div class="form-group polahari" style="margin-top: 2%">\
                    <div class="col-md-offset-2 col-md-10">\
                      <div class="checkbox col-md-2">\
                        <label><input id="haricheck'+(hari + 1)+'" type="checkbox" class="checkboxes" name="hari" value="'+(hari + 1)+'"> Hari '+(hari + 1)+'</label>\
                      </div>\
                      <div class="col-md-3">\
                        <select name="status_hari[]" class="form-control hariselect" id="hariselect'+(hari + 1)+'">\
                          <option value="Hari Kerja">Hari Kerja</option>\
                          <option value="Hari Libur">Hari Libur</option>\
                        </select>\
                      </div>\
                      <div class="col-md-3 col-xs-12">\
                        <div style="width: auto" id="harimasuk'+(hari + 1)+'" class="timepicker-masuk bfh-timepicker" data-time="08:00" data-toggle="tooltip" data-placement="top" title data-original-title="Jam masuk berformat 24 jam">\
                        </div>\
                      </div>\
                      <h5 class="col-md-1" style="text-align: center;">s/d</h5>\
                      <div class="col-md-3 col-xs-12">\
                        <div style="width: auto" id="haripulang'+(hari + 1)+'" class="timepicker-pulang bfh-timepicker" data-time="17:00" data-toggle="tooltip" data-placement="top" title data-original-title="Jam masuk berformat 24 jam">\
                        </div>\
                      </div>\
                    </div>\
                  </div>');

      hari++;

      $(".timepicker-masuk").bfhtimepicker({name: 'jam_masuk[]', time: '08:00', icon: ''});
      $(".timepicker-pulang").bfhtimepicker({name: 'jam_pulang[]', time: '17:00', icon: ''});
    }

    jumlahHariLama = jumlahHari;

    //fungsi shift: select multiple checkbox with shift key pressed
    var lastChecked = null; 
      var $chkboxes = $('.checkboxes');

      $chkboxes.click(function(e) {
          if(!lastChecked) {
              lastChecked = this;
              return;
          }

          if(e.shiftKey) {
              var start = $chkboxes.index(this);
              var end = $chkboxes.index(lastChecked);

              $chkboxes.slice(Math.min(start,end), Math.max(start,end)+ 1).prop('checked', lastChecked.checked);

          }

          lastChecked = this;
      });

      $(".hariselect").change(function(){
      var selected = $(this).val();

      if (selected == 'Hari Libur') {
        $(this).addClass('selectlibur');
        $(this).parent().parent().addClass('libur');
        $(this).parent().next().children().addClass('libur');
        $(this).parent().next().next().next().children().addClass('libur');
      } else {
        $(this).removeClass('selectlibur');
        $(this).parent().parent().removeClass('libur');
        $(this).parent().next().children().removeClass('libur');
        $(this).parent().next().next().next().children().removeClass('libur');
      }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    var jamMasuk = $("input[name=modal_jam_kerja]").val();
    var jamKeluar = $("input[name=modal_jam_keluar").val();

    jamMasuk = new Date("2017-07-28 " + jamMasuk + ":00");
    jamKeluar = new Date("2017-07-28 " + jamKeluar + ":00");

    $("#lamabekerja").val(Math.abs(jamKeluar - jamMasuk) / 36e5);
    
    $(".jammasuk, .jamkeluar").on("change.bfhtimepicker", function() {
      var jamMasuk = $("input[name=modal_jam_kerja]").val();
      var jamKeluar = $("input[name=modal_jam_keluar").val();

      jamMasuk = new Date("2017-07-28 " + jamMasuk + ":00");
      jamKeluar = new Date("2017-07-28 " + jamKeluar + ":00");

      if (jamKeluar <= jamMasuk) {
        jamKeluar.setDate(jamKeluar.getDate() + 1);
      }

      $("#lamabekerja").val(Math.abs(jamKeluar - jamMasuk) / 36e5);
    });
  });
</script>

<script type="text/javascript">
  $("#setjadwal").click(function(){
    var jamMasuk = $("input[name=modal_jam_kerja]").val();
    var jamKeluar = $("input[name=modal_jam_keluar]").val();
    var statusHari = $("#statushari").val();
    console.log("status hari: "+statusHari);

    var checkedDay = [];
    var selector = [];

    $("input:checkbox[name=hari]:checked").each(function(){
        checkedDay.push($(this).val());
        selector.push($(this));
    });

    for (var i=0; i < checkedDay.length; i++){
      $("#hariselect"+checkedDay[i]).val(statusHari);
      $("#harimasuk"+checkedDay[i]).val(jamMasuk);
      $("#haripulang"+checkedDay[i]).val(jamKeluar);

      if (statusHari == 'Hari Libur') {
        selector[i].parent().parent().parent().addClass('libur');
        selector[i].parent().parent().next().children().addClass('selectlibur');
        selector[i].parent().parent().next().next().children().addClass('libur');
        selector[i].parent().parent().next().next().next().next().children().addClass('libur');
      } else {
        selector[i].parent().parent().parent().removeClass('libur');
        selector[i].parent().parent().next().children().removeClass('selectlibur');
        selector[i].parent().parent().next().next().children().removeClass('libur');
        selector[i].parent().parent().next().next().next().next().children().removeClass('libur');
      }
    }

    if (checkedDay.length == 0) {
      $("#jengkiError").find("div").html("Tidak ada baris yang terpengaruh dikarenakan tidak ada hari yang dipilih !");

      $('#jengkiError').css({"display":"block","opacity":"0","left":"30px","bottom":"-50px"}).animate({opacity: 1,bottom : "10px"}, 1313);
      $('#jengkiError').click(function(){
        $(this).animate({opacity: 0,left : "-40px"}, 313, function(){
          $(this).css({"display":"none"});

          $("#jengkiError").find("div").html("Ada inputan yang salah/belum diisi.");
        });
      });
    }
  });
</script>

<script type="text/javascript">
  function checkAll(){
    $("input:checkbox[name=hari]").prop('checked', true);
    return false;
  }
</script>

<script type="text/javascript">
  function uncheckAll(){
    $("input:checkbox[name=hari]").prop('checked', false);
    return false;
  }
</script>

<script type="text/javascript">
  function resetjadwal(){
    checkAll();

    var checkedDay = [];
    var selector = [];

    $("input:checkbox[name=hari]:checked").each(function(){
        checkedDay.push($(this).val());
        selector.push($(this));
    });

    for (var i=0; i < checkedDay.length; i++){
      $("#hariselect"+checkedDay[i]).val('Hari Kerja');
      $("#harimasuk"+checkedDay[i]).val('08:00');
      $("#haripulang"+checkedDay[i]).val('17:00');

      selector[i].parent().parent().parent().removeClass('libur');
      selector[i].parent().parent().next().children().removeClass('selectlibur');
      selector[i].parent().parent().next().next().children().removeClass('libur');
      selector[i].parent().parent().next().next().next().next().children().removeClass('libur');
    }

    uncheckAll();
  }
</script>

<script type="text/javascript">
  $("#submit").click(function(){
    $("#pengaturanpolker").submit();
  });
</script>

<script type="text/javascript">
  function back(){
    window.location.href = "<?=site_url('pengaturan/pola_kerja/list')?>";

    return false;
  }
</script>

<script type="text/javascript">
  
  
</script> </div>
</div>

    <a href="#" class="scrollToTop" title="Scroll Ke Atas"><i class="fa fa-chevron-up icon-white"></i></a>
    <script src="/assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/assets/js/DataTables-1.10.15/media/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/plugin/footable_v3/js/footable.js"></script>
    <script>
      $("#btnWl").click(function(){
        $("#modalWl").modal("show");
      });
      $(document).ready(function(){

        var t={".chosen-select":{},".chosen-select-deselect":{allow_single_deselect:!0},".chosen-select-no-single":{disable_search_threshold:10},".chosen-select-no-results":{no_results_text:"Oops, nothing found!"},".chosen-select-width":{width:"95%"}};for(var e in t)$(e).chosen(t[e]);

                  $('a').click(function() {
                ga('send','event','Button',$(this).prop('href'),null);
          });

        $(".breadcrumb .dropdown-menu > li > a.trigger").on("click",function(e){
          var current=$(this).next();
          var grandparent=$(this).parent().parent();
          if($(this).hasClass('left-caret')||$(this).hasClass('right-caret')){
            $(this).toggleClass('right-caret left-caret');
          }
          else if($(this).hasClass('up-caret')||$(this).hasClass('down-caret')){
            $(this).toggleClass('down-caret up-caret');
          }
          grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
          grandparent.find('.up-caret').not(this).toggleClass('down-caret up-caret');
          grandparent.find(".sub-menu:visible").not(current).hide();
          current.toggle();
          e.stopPropagation();
        });
        $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
          var root=$(this).closest('.dropdown');
          root.find('.left-caret').toggleClass('right-caret left-caret');
          root.find('.sub-menu:visible').hide();
        });

        $(".btn-informasi").click(function(){
          $("#myModal p").text($(this).find(".infoBagian").text());
        });
          $('.footableTable').footable({
            "empty": "Data tidak ditemukan"
          });
          // Memasukkan pengatur jumlah baris ke dalam tiap tabel yang meiliki class "footableTable"
          $(".footableTable thead .form-inline").prepend('<div class="form-group">\
              <label class="sr-only" for="tableRows">Jumlah Baris</label>\
              <select name="" class="tableRows form-control">\
              <option data-page-size="10">10</option>\
              <option data-page-size="20">20</option>\
              <option data-page-size="50">50</option>\
              <option data-page-size="100">100</option>\
              <option data-page-size="200">200</option>\
            </select>\
          </div>');
          // Footable row size using select option
            $(".tableRows").on("change",function(e){
              e.preventDefault();
              var jmlRow = $(this).find(':selected').data('page-size');
              FooTable.get($(this).closest('.footableTable')).pageSize(jmlRow);
            });

        // DataTable initialisation
          $('.dataTable').DataTable();
            // Admin Menu
            waktu = "";
            // Event di adminMenu
            $("#adminMenu").mouseleave(function() { // Masih ada bug di sini. Mouseleave kena juga ke childrennya!
                waktu = setTimeout(function(){
                $("#adminMenu").removeClass("adminMenuMuncul");
              },2000);
            }).mouseenter(function(){
              clearTimeout(waktu); // Agar ketika mouse dikeluarkan namun belum 2 detik masuk lagi, adminMenu tidak bersembunyi lagi
            });
            // Event di AdminMenuCtl
            $("#adminMenuCtrl").mouseenter(function(){
              setTimeOut = setTimeout(function(){
                if($("#adminMenu").hasClass("adminMenuMuncul")){
                  $("#adminMenu").removeClass("adminMenuMuncul");
                }
                else{
                  $("#adminMenu").addClass("adminMenuMuncul");
                }
              },500);
              clearTimeout(waktu);
            }).mouseleave(function() { // Alasan kenapa ditambahkan ketka mouseleave dihapus timeoutnya, karena kalo gak, event2 bisa otomatis dieksekusi setelah waktunya habis setelah kita melakukan aksi dalam hal ini mouseenter.
              clearTimeout(setTimeOut);
              clearTimeout(waktu); // Ternyata bug yang sebelumnya ada ketika adminMenu dimouseleave bisa diselesaikan dengan mendestroynya di sini
            });
          // Event di tombol close adminMenu (adminMenuTutup)
            $("#adminMenuTutup").click(function(){
              $("#adminMenu").removeClass("adminMenuMuncul");
            });

      });

              mixpanel.identify("170600335");


        $(".btn-informasi").click(function(){
          mixpanel.track("Klik Tombol Help", {"Penjelasan": $(this).find(".infoBagian").text()});
        });

        $(".btnMixUser").click(function(){
          // var penjelasan = "Klik tombol "+$(this).text();
          var penjelasan = $(this).attr('data-mix-port')+" - "+$(this).attr('data-mix-name')+" - "+$(this).attr('data-mix-function');
          mixpanel.track(penjelasan);
        });
      

    </script>

    
    <script type="text/javascript">
      var token = "305868476543564b6f42504d4a624c3343614146544c667a4e59773949655a51";

      jQuery(document).bind('ajaxSend', function(event, xhr, params) {
        xhr.setRequestHeader('CSRF-Token', token);

        //console.log(params);
        console.log(xhr);
      });
    </script>

    <script type="text/javascript">
      $( document ).ajaxError(function( event, request, settings ) {
        var responseText = jQuery.parseJSON(request.responseText);
        $("#jengkiError").find("div").html(responseText.msg);

        $('#jengkiError').css({"display":"block","opacity":"0","left":"30px","bottom":"-50px"}).animate({opacity: 1,bottom : "10px"}, 1313);
        $('#jengkiError').click(function(){
          $(this).animate({opacity: 0,left : "-40px"}, 313, function(){
            $(this).css({"display":"none"});

            $("#jengkiError").find("div").html("Ada inputan yang salah/belum diisi.");
          });
        });
      });
    </script>

    <script type="text/javascript">
      
      // remove class
      $(document).ready(function(){
        var seminggu = false;
        if (seminggu) {
          $('.new-menu').removeClass('new-menu');
            $('.label-new-menu').remove();
        }
      });
    </script>
    <!-- add new input form -->
    <script type="text/javascript">
    var counter = 1;
    var limit = 7;
    function addInput(divName){
         if (counter == limit)  {
              alert("Maksimum 7 hari yang bisa ditambahkan");
         }
         else {
              var newdiv = document.createElement('div');
              //newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
              newdiv.innerHTML = '<div class="col-md-offset-2 col-md-10 polahari'+(counter + 1)+'">\
    <div class="checkbox col-md-2">\
      <label><input type="hidden"  id="haricheck1" name="hari[]" value="'+(counter + 1)+'"> Hari '+(counter + 1)+'</label>\
    </div>\
    <div class="col-md-3">\
      <select name="status_hari[]" class="form-control hariselect" id="hariselect'+(counter + 1)+'">\
        <option value="Hari Kerja">Hari Kerja</option>\
        <option value="Hari Libur">Hari Libur</option>\
      </select>\
    </div>\
    <div class="col-md-3 col-xs-12">\
      <div style="width: auto" id="harimasuk'+(counter + 1)+'" class="timepicker-masuk bfh-timepicker" data-time="08:00" data-toggle="tooltip" title data-original-title="Jam masuk berformat 24 jam">\
        <input type="text" class="form-control" name="jam_masuk[]" id="polakerja" required data-validation-required-message="Nama pola kerja tidak boleh kosong">\
      </div>\
    </div>\
    <h5 class="col-md-1" style="text-align: center;">s/d</h5>\
    <div class="col-md-3 col-xs-12">\
      <div style="width: auto" id="haripulang'+(counter + 1)+'" class="timepicker-pulang bfh-timepicker" data-time="17:00" data-toggle="tooltip" title data-original-title="Jam masuk berformat 24 jam">\
        <input type="text" class="form-control" name="jam_pulang[]" id="polakerja" required data-validation-required-message="Nama pola kerja tidak boleh kosong">\
      </div>\
    </div>\
  </div>';
              document.getElementById(divName).appendChild(newdiv);
              counter++;
         }
    }
    </script>
    <script type="text/javascript">
    function delDiv(divName){
      $('.'+divName).remove();
    }
    </script>
<?php
get_template('footer');
?>
