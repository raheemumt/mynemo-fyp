<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//die($_SESSION["todo"]);
?>


<script type="text/javascript">
/*function save(warna,idstaf, t02id) {
	var warna = warna;
	var idstaf = idstaf;
	var t02id = t02id;
	//alert(warna);
     //var s09id = $("#s09id").val();
//     var t02id = $("#t02id").val();
//     var s01id = $("#s01id").val();

     // Send AJAX request to fetch updated data
     $.ajax({
         url: '<?php echo base_url(); ?>mainpage/save_fav',
         type: 'POST',
         data: { warna: warna, idstaf:idstaf, t02id:t02id },
         success: function(response) {
             // Assuming response contains the updated HTML
             //$("#myuat_modal").html(response);
			  refresh_list_2(idstaf);
         }
     });
 }

	function refresh_list_2(idstaf) {
	var idstaf = idstaf;
	

     // Send AJAX request to fetch updated data
     $.ajax({
         url: '<?php echo base_url(); ?>mainpage/refreshlist',
         type: 'POST',
         data: { idstaf:idstaf },
         success: function(response) {
             // Assuming response contains the updated HTML
             //$("#myuat_modal").html(response);
			  //refresh_list_2(idstaf);
         }
     });
 }*/
	
function save(warna,idstaf, t02id){
	
	var idstaf2 = idstaf;
	
	if(idstaf2!=""){
	$.php('<?php echo base_url();?>mainpage/save_fav', {warna: warna, idstaf:idstaf, t02id:t02id});
	refresh_list_2(idstaf);
	} else {	
		document.location.href="<?=base_url()?>mainpage/main";
	}
}
function refresh_list_2(idstaf) {
        $.php('<?php echo base_url(); ?>mainpage/refreshlist', {idstaf:idstaf});//idstaf: $("#idstaf").val(), t02id: $("#t02id").val() });
}
</script>
 <!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="horizontal">

<head>
  <!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />



<!-- Core Css -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/styles.css" />
  <title>MyNemo - Home</title>
  <!-- Owl Carousel  -->
  <link rel="stylesheet" href="<?=base_url()?>assets/libs/owl.carousel/dist/assets/owl.carousel.min.css" />
</head>  
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
 
				<div id="tablemenu" class="icon-section space-sm pt-5">
					<div class="container">
						<div class="row">
						<div class="col-lg-7">

							<h3 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
							<iconify-icon icon="<?=$dt01->T01_ICON?>" class="fs-8"></iconify-icon><?=$dt01->T01_NAMA?>
							</h3>
							<!--span>You can manage your favourite apps by selecting/unselect the star icon</span-->
						</div>
						</div>

					<div class="row">
		<?php $data = $this->auth->userdata();
	  		  
				if ($t02)
				{
					foreach ($t02->result() as $dt02)
					{
						$f = $this->t02m->t04_count($dt02->T02_ID,$data->IDSTAF);

						if ($f->JUM>0){
							$c = "solar:star-bold";
						} else { $c = "solar:star-linear";

						}

            // Find the position of the first space
            $position = strpos($dt02->T02_ICON, ' ');
            // Extract the substring from the beginning to the first space
            $first_part = substr($dt02->T02_ICON, 0, $position);
		?>
						<div class="col-lg-4">
						  <div class="card">
              
							<div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="flex-shrink-0">
              <?php if ($first_part=='fa' || $first_part=='fas') {?>
                  <i class="<?=$dt02->T02_ICON?> text-<?=$dt01->T01_ICON_COLOUR?> display-6" aria-hidden="true"></i>
              <?php } else {?>
                <iconify-icon icon="<?=$dt02->T02_ICON?>" class="text-<?=$dt01->T01_ICON_COLOUR?> display-6" ></iconify-icon>	
              <?php } ?>
                </div>                  
                <div>
                  <h5 class="fw-semibold mb-0">
                <?php if ($dt02->T02_QUERYMENU=='Y') { 
                      echo "<a href='/cek_akseslevel.php?idapp=$dt02->T02_ID'>$dt02->T02_NAMA_APP</a>";?>
                  <?php } else { 
                      if ($dt02->T02_LOGIN=='Y') { ?>
                          <a href="<?=base_url()?>mainpage/redir/redirect/<?=$dt02->T02_ID?>" class="Menu_Capaian2"><?=$dt02->T02_NAMA_APP?></a>			  
                    <?php } else { ?>			
                        <?php if ($dt02->T02_PLATFORM=='8') { ?>
                          <a href="<?=base_url()?>mainpage/redir/redirect/<?=$dt02->T02_ID?>"><?=$dt02->T02_NAMA_APP?></a>
                      <?php } else { ?>
                          <a href="<?=base_url()?>mainpage/redir/opensys/<?=$dt02->T02_ID?>/<?=$dt02->T02_URL?>"><?=$dt02->T02_NAMA_APP?></a>
                <?php 			   } 
                      }
                  }?> 
                  </h5>
                  <span class="fs-2 d-flex align-items-center">
                  <?=$dt02->T02_KETERANGAN?>
                  <br>
                  Status: <?php if ($dt02->T02_STATUS=='A') echo "Active";
                        else echo "Not Active";?>
                  <br>
                  <?php 
                      // $t03_data = '';
                      // $t03_results = $this->t02m->get_t03($dt02->T02_ID);
                      // foreach ($t03_results->result() as $t03) {
                        
                        // $t03_data .= $t03->NAMA . " : " . $t03->T03_NOTEL . "\n";
                      // }
					  
					  $t03_data = $data->NAMA;
                      
                  ?>
                  </span>
                  </div>
                  <div class="card-body p-2 d-flex flex-column align-items-center" style="height: 100px;">
                    <a class="align-top"  id="love_<?=$dt02->T02_ID?>" href="javascript:save('<?=$c?>','<?=$data->IDSTAF?>','<?=$dt02->T02_ID?>')" >
                      <iconify-icon icon="<?=$c?>" id="tablefav" class="fs-8 text-warning py-1 px-2 ms-auto" ></iconify-icon>			 
                    </a>
                    <?php if (!empty($t03_data)) { ?>
                    <a class="mb-0 mt-auto"
                      tabindex="0"  
                      data-bs-toggle="popover" 
                      data-bs-trigger="focus" 
                      title="Pegawai Bertanggungjawab"
                      data-bs-content="<?= htmlentities($t03_data) ?>">
                      <iconify-icon icon="ri:customer-service-2-fill" class="fs-8 text-success py-1 px-2 ms-auto"></iconify-icon>
                    </a>
                  <?php } ?>
                  </div>
							</div>
						  </div>
						</div>

		<?php } } ?>

					  </div><!-- row -->  
					</div>
				</div>

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


    

  
