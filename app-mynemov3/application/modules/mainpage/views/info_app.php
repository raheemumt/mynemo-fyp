<div class="icon-section">
	<div class="container">
	   <h3 class="section-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
	 <iconify-icon icon="solar:clipboard-linear" class="aside-icon"></iconify-icon> <?=lang('info')?>
	</h3>
<?php 
	  $j=0;
	  foreach ($sent07->result() as $sent07)
	  {
		  $gt08=$this->t02m->get_t08($sent07->T07_ID);
		  if ($j==0) $show = "show"; else $show="";
?>
	  <div class="accordion" id="accordionExample">
			<div class="accordion-item">
			  <h2 class="accordion-header" id="headingOne_<?=$j?>">
				<button class="accordion-button" type="button" data-bs-toggle="collapse"
				  data-bs-target="#collapseOne_<?=$j?>" aria-expanded="true" aria-controls="collapseOne_<?=$j?>">
				 <?=$sent07->T07_PERIHAL?>
				</button>
			  </h2>
			  <div id="collapseOne_<?=$j?>" class="accordion-collapse collapse <?=$show?>" aria-labelledby="headingOne_<?=$j?>"
				data-bs-parent="#accordionExample">
				  <div class="accordion-body">
				<?php foreach ($gt08->result() as $gt08)
	  				  { 
				  		$gt09=$this->t02m->get_t09($gt08->T08_ID);
				  ?>
							  <p><strong><?=$gt08->T08_KETERANGAN?></strong>
							  <br>
						<?php foreach ($gt09->result() as $gt09)
				  			  {
					    ?>
								  <a class="link-primary link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover" href="<?=$gt09->T09_LINK?>"><?=$gt09->T09_TAJUKLINK?></a>
							                      
						<?php } ?>			  
							  </p>						 
						
			   <?php } ?>
				  </div>
			  </div>
			</div>
		</div>
<?php 
	$j++;
	  } 
?>
	</div>
</div>