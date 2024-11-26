
<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$testlink = '/mytime/index.php/mywbfapp/wbf_stafpunch';?>
<script>
	
function cekmytime() {
 $("#waitmytime").css("display","block");
	$.ajax({
		url: '<?=$testlink?>',
		type: 'post',
		data: { masa: '<?php echo date('dmy G:i:s')?>',language:'<?=$language?>' } ,
		success: function(data){
			//If the success function is execute,
			//then the Ajax request was successful.
			//Add the data we received in our Ajax
			//request to the "content" div.
			$('#btn_mytime').html(data);
			//$("#waitmytime").css("display","none");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			var errorMsg = 'Ajax request failed: ' + xhr.responseText;
			//$('#btn_mytime').html(errorMsg);
		  }
	});
 }

	// DIGITAL CLOCK //
	
</script>
<?php
/*$user_name = "Fatah Amin bin Muhammad";
$user_position = "Lecturer";
$user_email = "fatah@umt.edu.my";*/
?>
 <!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- Header Space Sizing : DO NOT TOUCH-->
<div class="text-bg-white py-5 d-none d-xl-block" style="padding-top: 75px !important;">
</div>
<div class="text-bg-white py-5 d-flex d-lg-none" style="padding-top: 20px !important;">
</div>
<!-- End Header Space Sizing : DO NOT TOUCH-->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT STARTS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
 <?php 
	// greeting ///
		if ( (strpos($data->NAMA,"BIN")) || (strpos($data->NAMA,"B.")) || (strpos($data->NAMA,"B")) || (strpos($data->NAMA,"BINTI")) 
			|| (strpos($data->NAMA,"BT.")) || (strpos($data->NAMA,"BT")) ) {
			$greet='Assalamualaikum wbt';
		} else {
			$greet='Salam sejahtera';
		}
	
	  		

		//echo "sini".$tkhwbf->WBF;
		$timestamp = time();
		$date = date("H:i:s", $timestamp);
		if ( (!empty($tkhwbf->MASUK)) && ($tkhwbf->KELUAR=='') ) $bg = 'primary'; else $bg = 'warning';
		//if ( $tkhwbf->MASUK=='') $bg = 'warning';
	?>
    <?php //if(isset($_GET["in"])) { ?>

      <!-- CLOCK IN/OUT -->
      <div class="text-bg-<?=$bg?> py-5">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-xl-6  mb-lg-0">
            <em class="fs-6 fw-bold"><?=$greet?> ,</em>
              <h2 class="fs-8 text-white text-lg-start fw-bold mb-7">
                <?=ucwords(strtolower($data->NAMA))?> 
                <p class="fs-5 mb-2 text-white fw-normal w-85" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                  <?php if ( (!empty($tkhwbf->MASUK)) && ($tkhwbf->KELUAR=='') ) { ?>
					<?=lang('welcome_clocked')?> <?php if (!empty($tkhwbf->MASUK)){ ?>
                                <?=date('h:i:sA', strtotime($tkhwbf->MASUK))?> 
								<?php if ($_SESSION['kategori']=='N') {?>
									<br><?=lang('welcome_clock_at')?> <?=$tkhwbf->WBF?> <?php } ?></strong>
							    <?php } ?>. <?=lang('welcome_tq')?>.
				 <?php } else {?>
					<?=lang('welcome')?>
				<?php } ?>
                </p>
              </h2>
              <div class="d-sm-flex align-items-center justify-content-start gap-3">
			<?php
				 if (isset($wfh->ID)){
					 echo " <div id='btn_mytime'></div>
						<script>cekmytime()</script>
						"; 
				  } else {	

				 if (!empty($ipmytime->T10_IP))
					  {
						echo " <div id='btn_mytime'></div>
						<script>cekmytime()</script>
						";
					  }
				 }
				  
			?>
                <!--<a href="index.php"
                  class="btn btn-white fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow px-3 py-2 text-danger">Clock Out</a>-->
              	<span id="clock" class="fw-bold fs-8 text-white" onload="currentTime()"><span>
				</div>
            </div>
            <div class="col-lg-5 col-xl-5 d-none d-xl-block">
              <div class="text-center text-lg-end">
				  <!-- <span id="clock" class="fw-bold fs-8 text-white" onload="currentTime()"><span>-->
                <?php if (!empty($tkhwbf->MASUK)) { 
				  		if ($data->JANTINA=='L') {?>
				  			<img src="<?=base_url()?>assets/images/landingpage/office-in.png" alt="" width="300" height="300" class="img-fluid" />
				<?php 	} if ($data->JANTINA=='P') { ?>
				  			<img src="<?=base_url()?>assets/images/landingpage/office-woman.png" alt="" width="300" height="300" class="img-fluid" />
				<?php 	}
					  } else { ?>
				   <img src="<?=base_url()?>assets/images/landingpage/office-out.png" alt="" width="300" height="300" class="img-fluid" />
				  <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end CLOCK IN/OUT -->      

      <?php //} else { ?>

      <!-- CLOCK IN/OUT -->
      <!--<div class="text-bg-warning py-5">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-lg-7 col-xl-5  mb-lg-0">
              <em class="fs-6 fw-bold"><?=$greet?>,</em>
              <h2 class="fs-8 text-white text-lg-start mb-7">                 
                <?=ucwords(strtolower($data->NAMA))?>
                <p class="fs-5 mb-2 text-white fw-normal w-85" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                  Welcome back to MyNemo. Please clock in to start your day. Thank you.
                </p>
              </h2>
              <div class="d-sm-flex align-items-center justify-content-start gap-3">
				  
                <a href="index.php?in"
                  class="btn btn-white fw-semibold d-block mb-3 mb-sm-0 btn-hover-shadow px-3 py-2">Clock In</a>
              </div>
            </div>
            <div class="col-lg-5 col-xl-5 d-none d-xl-block">
              <div class="text-center text-lg-end">
                <img src="<?=base_url()?>assets/images/landingpage/office-out.png" alt="" width="300" height="300"
                  class="img-fluid" />
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <!-- end CLOCK IN/OUT -->  

      <?php //} ?>

      <div class="icon-section space-sm pt-5">
        <div class="container">  
          <div class="row mb-3">
            <h3 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
              <i class="ti ti-star fs-8"></i> <?=lang('fav')?>
            </h3>            
            <span><?=lang('fav_sub')?></span>
          </div>
          <div class="row">
            <?php echo $this->load->view("mainpage/main_fav"); ?>
          </div>
        
				<!--	
		
				<h3 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
				 <iconify-icon icon="solar:buildings-2-linear" class="aside-icon"></iconify-icon> <?=lang('dashboard')?>
				</h3>  -->
				<?php //echo $this->load->view("mainpage/main_dashboard"); ?>
			</div> 
		</div>
            <!-- ---------------------------------------------- -->
            <!-- 1. Accordian INFO UMUM-->
            <!-- ---------------------------------------------- -->
             <?php ///echo $this->load->view("mainpage/info_app"); ?>        

      <!-- suggestion box -->
      <div class="space-sm bg-light-subtle pt-5 pb-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <div class="card c2a-box">
                <div class="card-body text-center p-4 pt-7">
                  <h3 class="fs-7 fw-semibold pt-6" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    <?=lang('suggestion')?>
                  </h3>
                  <p class="mb-7 pb-2">
                    <?=lang('suggestion_sub')?>
                  </p>
                  <div class="d-sm-flex align-items-center justify-content-center gap-3 mb-4">
                    <a href="/index.php?module=support&app=PTC" target="_blank"
                      class="btn btn-primary d-block mb-3 mb-sm-0 btn-hover-shadow px-7 py-6" type="button"> <?=lang('suggestion_button')?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end suggestion box -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT ENDS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->


<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- Page Style Setting = DO NOT TOUCH -->
<div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
  aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-body h-n80" data-simplebar>
    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="light-layout">
        <iconify-icon icon="solar:sun-2-bold" class="icon fs-7 me-2"></iconify-icon>Light</label>

      <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="dark-layout"><iconify-icon icon="solar:moon-linear"
          class="icon fs-7 me-2"></iconify-icon>Dark</label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="ltr-layout">
        <iconify-icon icon="solar:align-left-linear" class="icon fs-7 me-2"></iconify-icon>LTR</label>

      <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="rtl-layout"><iconify-icon icon="solar:align-right-linear"
          class="icon fs-7 me-2"></iconify-icon>RTL</label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
      <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="BLUE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="AQUA_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="PURPLE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="GREEN_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="CYAN_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="ORANGE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <div>
        <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="vertical-layout"><iconify-icon
            icon="solar:sidebar-minimalistic-linear" class="icon fs-7 me-2"></iconify-icon>Vertical</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="horizontal-layout"><iconify-icon
            icon="solar:airbuds-case-minimalistic-linear" class="icon fs-7 me-2"></iconify-icon>Horizontal</label>
      </div>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="boxed-layout"><iconify-icon
          icon="solar:align-horizonta-spacing-linear" class="icon fs-7 me-2"></iconify-icon>Boxed</label>

      <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="full-layout"><iconify-icon
          icon="solar:align-vertical-spacing-linear" class="icon fs-7 me-2"></iconify-icon>Full</label>
    </div>

    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <a href="javascript:void(0)" class="fullsidebar">
        <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="full-sidebar"><iconify-icon icon="solar:mirror-left-linear"
            class="icon fs-7 me-2"></iconify-icon>Full</label>
      </a>
      <div>
        <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="mini-sidebar"><iconify-icon icon="solar:mirror-right-linear"
            class="icon fs-7 me-2"></iconify-icon>Collapse</label>
      </div>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="card-with-border"><iconify-icon
          icon="solar:quit-full-screen-square-linear" class="icon fs-7 me-2"></iconify-icon>Border</label>

      <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="card-without-border"><iconify-icon
          icon="solar:minimize-square-2-linear" class="icon fs-7 me-2"></iconify-icon>Shadow</label>
    </div>
  </div>
</div>
<!-- End of Page Style Setting = DO NOT TOUCH -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<script type="text/javascript">
	var ctoday = <?php echo time() * 1000 ?>;
	setInterval(function() {ctoday += 1000;},1000);
    function currentTime() {
		let date = new Date(ctoday);
		/*
		let date = new Date(<?php //$now = getdate();
          //echo $now['year']  . ',' . ($now['mon'] - 1) . ',' . $now['mday'] . ',' .
               //$now['hours'] . ',' . $now['minutes']   . ',' . $now['seconds'];
		?>);*/
      let hh = date.getHours();
      let mm = date.getMinutes();
      let ss = date.getSeconds();
      let session = "AM";

		if(hh == 0){
          hh = 12;
      }
      if(date.getHours() < 12){
          //hh = 12;
          session = "AM";
       }
	   else if(hh == 12){
          //hh = hh-12;
          session = "PM";
       }else if(hh > 12){
          hh = date.getHours()-12;
          session = "PM";
       } else { }
		

       hh = (hh < 10) ? "0" + hh : hh;
       mm = (mm < 10) ? "0" + mm : mm;
       ss = (ss < 10) ? "0" + ss : ss;

       var time = hh + ":" + mm + ":" + ss + " " + session;

      document.getElementById("clock").innerText = time;
      let t = setTimeout(function(){ currentTime() }, 1000);
    }

    currentTime();

    </script>

    

  
