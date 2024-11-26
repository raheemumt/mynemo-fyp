<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);


?>

<script>
$( document ).ready(function(){

	 $.ajax({
      type: "GET",
      url: "<?=base_url()?>mainpage/get_token",
      dataType: "json",
      success : function(data) {
            $("#texter").html(data);
            
      }
});
});
</script>
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT STARTS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

	<div class="container" id="texter"> 
		<div class="row">
				<div class="col-md-6 col-lg-3">
				  <div class="card">
					<div class="card-body">
					  <div class="d-flex align-items-start">
						<div class="
							bg-warning-subtle
							text-warning
							hstack justify-content-center
							px-4
							py-3
							rounded
							round-120
						  ">
							
						  <iconify-icon icon="solar:suitcase-tag-broken" class="aside-icon fs-12"></iconify-icon>
						</div>
						<?php 	if ($json->dispgunacuti_semasa=='tiada') {
						  			$totalcuti = 0;
							  	} else {
									$totalcuti=($json->dispgunacuti_semasa/$json->dispgunacuti_layak)*100;
								}
						  ?>
					  </div>
					  <div class="mt-4 pt-6">
						<h4 class="card-title text-muted mb-0"><?=lang('dashboard_ct')?></h4>
						<div class="progress bg-grey bg-opacity-05 w-100 rounded-3" style="height: 16px;">
                        <div class="progress-bar bg-warning rounded-3" role="progressbar" style="width: <?=$totalcuti?>%" aria-valuenow="<?=$json->dispgunacuti_semasa?>" aria-valuemin="0" aria-valuemax="<?=$json->dispgunacuti_layak?>"></div>
                      </div>
						<div class="d-flex align-items-center fs-3">
						  <span><?=$json->dispgunacuti_semasa?></span>
						  <div class="ms-auto">
							<span><?=$json->dispgunacuti_layak?></span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-md-6 col-lg-3">
				  <div class="card">
					<div class="card-body">
					  <div class="d-flex align-items-start">
						<div class="
							bg-info-subtle
							text-info
							hstack justify-content-center
							px-4
							py-3
							rounded
							round-120
						  ">
						<iconify-icon icon="solar:accessibility-broken" class="aside-icon fs-12"></iconify-icon>
						
						</div>
						
					  </div>
					  <div class="mt-4 pt-6">
						<h4 class="card-title text-muted mb-0"><?=lang('dashboard_lat')?></h4>
						<div class="progress bg-grey bg-opacity-05 w-100 rounded-3" style="height: 16px;">
							<?php 
						//$layak = 7;
						$totallat = ($json->disphadirlatihan_semasa/$json->disphadirlatihan_layak)*100;?>
                        <div class="progress-bar bg-primary rounded-3" role="progressbar" style="width: <?php echo $totallat=number_format($totallat, 2, '.', ',');?>%" aria-valuenow="<?=$json->disphadirlatihan_semasa?>" aria-valuemin="0" aria-valuemax="<?=$json->disphadirlatihan_layak?>"></div>
                      </div>
						<div class="d-flex align-items-center fs-3">
						  <span><?=$json->disphadirlatihan_semasa?></span>
						  <div class="ms-auto">
							<span><?=$json->disphadirlatihan_layak?></span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-md-6 col-lg-3">
				  <div class="card">
					<div class="card-body">
					  <div class="d-flex align-items-start">
						<div class="
							bg-secondary-subtle
							text-secondary
							hstack justify-content-center
							px-4
							py-3
							rounded
							round-120
						  ">
						 <iconify-icon icon="solar:heart-pulse-broken" class="aside-icon fs-12"></iconify-icon>
						</div>
						
					  </div>
					  <div class="mt-4 pt-6">
						<h4 class="card-title text-muted mb-0"><?=lang('dashboard_kpanel')?></h4>
						<div class="progress bg-grey bg-opacity-05 w-100 rounded-3" style="height: 16px;">
                        <div class="progress-bar bg-secondary rounded-3" role="progressbar" style="width: <?=$totalpanel=($json->displayakpanel_semasa/$json->displayakpanel_layak)*100?>%" aria-valuenow="<?=$json->displayakpanel_semasa?>" aria-valuemin="0" aria-valuemax="<?=$json->displayakpanel_layak?>"></div>
                      </div>
						<div class="d-flex align-items-center fs-3">
						  <span><?=$json->displayakpanel_semasa?></span>
						  <div class="ms-auto">
							<span><?=$json->displayakpanel_layak?></span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-md-6 col-lg-3">
				  <div class="card">
					<div class="card-body">
					  <div class="d-flex align-items-start">
						<div class="
							bg-danger-subtle
							text-danger
							hstack justify-content-center
							px-4
							py-3
							rounded
							round-120
						  ">
						 <iconify-icon icon="icon-park-outline:teeth" class="aside-icon fs-12"></iconify-icon>
						</div>
						
					  </div>
					  <div class="mt-4 pt-6">
						<h4 class="card-title text-muted mb-0"><?=lang('dashboard_gg')?></h4>
						<div class="progress bg-grey bg-opacity-05 w-100 rounded-3" style="height: 16px;">
                        <div class="progress-bar bg-danger rounded-3" role="progressbar" style="width: <?=$totalgg=($json->dispgunagg_web/$json->dispgunagg_web)*100?>%" aria-valuenow="<?=$json->dispgunagg_web?>" aria-valuemin="0" aria-valuemax="<?=$json->dispgunagg_web?>"></div>
                      </div>
						<div class="d-flex align-items-center fs-3">
						  <span><?=$json->jum_tuntutangg?></span>
						  <div class="ms-auto">
							<span><?=$json->dispgunagg_web?></span>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
		</div>
	

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT ENDS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->



    

  
