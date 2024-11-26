<?php
 if (!empty($data->IDSTAF)) $idstaf = $data->IDSTAF; else $idstaf='';
 if (!empty($data->NAMA)) $nama = $data->NAMA; else $nama='';		   
	
?> 
<a class="nav-link" href="javascript:void(0)" id="drop1" aria-expanded="false">
	<div class="d-flex align-items-center">
	  <div class="user-profile-img">
		<img src="/cencikutxxyyzz.php?kp=<?=$_SESSION['icno']?>" class="rounded-circle" width="30" height="30"
		  alt="" />
	  </div>
	</div>
</a>
	  <div class="dropdown-menu dropdown-menu-end content-dd dropdown-menu-animate-up user-dd animated flipInY"
		aria-labelledby="drop1">
		<div class="profile-dropdown position-relative" data-simplebar>
	  <div class="py-3 px-7 pb-0">
		<h5 class="mb-0 fs-5">User Profile</h5>
	  </div>
	  <div class="d-flex align-items-center py-9 mx-7 border-bottom">
		<img src="/cencikutxxyyzz.php?kp=<?=$_SESSION['icno']?>" class="rounded-circle" width="80" height="80" alt="" />
		<div class="ms-3">
		  <h5 class="mb-1 fs-4"><?php echo $nama; ?></h5>
		  <span class="mb-1 d-block"><?php if (isset($data->JAWATAN)) echo $data->JAWATAN;?>-<?php if (isset($data->GRED)) echo $data->GRED;?></span>
		  <p class="mb-0 d-flex align-items-center gap-2">
			<i class="ti ti-mail fs-4"></i> <?php if (isset($data->EMAIL)) echo $data->EMAIL;?></p>
		</div>
	  </div>
	  <div class="message-body">
		<a href="https://mail.google.com" class="py-8 px-7 d-flex align-items-center" target="_blank">
		  <span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
			<iconify-icon icon="solar:letter-linear"></iconify-icon>
		  </span>
		  <div class="w-75 d-inline-block v-middle ps-3">
			<h6 class="mb-1 fs-3 lh-base">My Inbox</h6>
			<span class="fs-2 d-block text-body-secondary">Messages & Emails</span>
		  </div>
		</a>
		<!--<a href="#" class="py-8 px-7 d-flex align-items-center">
		  <span class="d-flex align-items-center justify-content-center bg-info-subtle rounded p-6 fs-7 text-info">
			<iconify-icon icon="solar:checklist-minimalistic-line-duotone"></iconify-icon>
		  </span>
		  <div class="w-75 d-inline-block v-middle ps-3">
			<h6 class="mb-1 fs-3 lh-base">To-do List</h6>
			<span class="fs-2 d-block text-body-secondary">Tasks waiting for your actions</span>
		  </div>-->
		</a>
	  </div>
	  <div class="d-grid py-4 px-7 pt-8">
		<a href="<?=site_url("logout")?>" class="btn btn-info">Log Out</a>
	  </div>
	</div>
</div>