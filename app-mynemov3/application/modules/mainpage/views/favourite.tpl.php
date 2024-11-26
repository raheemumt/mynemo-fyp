<div class="row">
 <?php if ($t0204):
		foreach ($t0204->result() as $t0204):?>
	<br>
	<?php if ($t0204->T02_PLATFORM=='8') { ?>

			<a class="btn btn-app shadow-sm p-2 font-weight-bold text-info" href="<?=base_url()?>mainpage/redirect/<?=$t0204->T02_ID?>"><i class="<?=$t0204->T02_ICON?>"></i><?=$t0204->T02_SHORTNAME?></a>
		<?php } else { ?>

			<a href="<?=base_url()?>mainpage/opensys/<?=$t0204->T02_ID?>/<?=$t0204->T02_URL?>" class="btn btn-app shadow-sm p-2 font-weight-bold text-info" >
			<i class="<?=$t0204->T02_ICON?>"></i> <?=$t0204->T02_SHORTNAME?></a>
		<?php } ?>

<?php   
  endforeach; endif;?>
</div>