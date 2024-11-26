	
<li class="sidebar-item">
		<a class="sidebar-link" href="<?=base_url()?>mainpage/main" aria-expanded="false">
		  <iconify-icon icon="solar:home-outline" class="aside-icon"></iconify-icon>
		  <span class="hide-menu">
		  <?=lang("but_home")?>
		  </span>
		</a>
	 </li>
<?php 
	  $t01 = $this->t01m->t01_group();
	  $i=0;
	  foreach ($t01->result() as $t01) 
	  {?>
      <li class="sidebar-item">
        <a class="sidebar-link" href="<?=base_url()?>mainpage/main_menupage/<?=$t01->T01_ID?>" aria-expanded="false">
          <iconify-icon icon="<?=$t01->T01_ICON?>" class="aside-icon"></iconify-icon>
          <span class="hide-menu">
          <?=lang("cate_".$i)?>
          </span>
        </a>
      </li> 
<?php $i++;
	  } ?>
	 <!-- <li class="sidebar-item">
		<a class="sidebar-link" href="<?=base_url()?>dashboard" aria-expanded="false">
		  <iconify-icon icon="solar:buildings-2-linear" class="aside-icon"></iconify-icon>
		  <span class="hide-menu">
		  Dashboard
		  </span>
		</a>
	 </li>-->
        