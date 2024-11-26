<!--<script src="../assets/v3/dist/js/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/v3/plugins/bootstrap/js/bootstrap.js"></script>
<script src="<?=base_url()?>assets/js/jquery.form.js"></script>
<script src="<?=base_url()?>assets/v3/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery.php.js"></script>
<script src="<?=base_url()?>assets/v3/dist/js/adminlte.min.js"></script>

	<script src="<?=base_url()?>assets/v3/plugins/jquery-ui/jquery-ui.js"></script>
 <?=$this->load->view('mainpage/main_menu') ?>
 </div>
    <script type="text/javascript">
    function currentTime() {
      let date = new Date();
      let hh = date.getHours();
      let mm = date.getMinutes();
      let ss = date.getSeconds();
      let session = "AM";

      if(hh === 0){
          hh = 12;
      }
      if(hh > 12){
          hh = hh - 12;
          session = "PM";
       }

       hh = (hh < 10) ? "0" + hh : hh;
       mm = (mm < 10) ? "0" + mm : mm;
       ss = (ss < 10) ? "0" + ss : ss;

       let time = hh + ":" + mm + ":" + ss + " " + session;

      document.getElementById("clock").innerText = time;
      let t = setTimeout(function(){ currentTime() }, 1000);
    }

    currentTime();

    </script>

	
    <!-- AdminLTE App -->
</body>