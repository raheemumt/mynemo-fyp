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
	<!-- Favicon icon-->
<link rel="shortcut icon" type="image/png" href="<?=base_url()?>assets/images/logos/icon.png" />
</head>  


  <!-- Preloader -->
  <body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="<?=base_url()?>assets/images/logos/icon.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <!--<div class="landingpage">-->
  <div id="main-wrapper">
    <!-- Sidebar Start -->
 			<aside class="left-sidebar with-vertical">
     			<div>
				<!-- ################################## -->
				<!-- Start Mobile View Menu -->
					<div class="brand-logo d-flex align-items-center justify-content-between">
					  <a href="<?=base_url()?>mainpage/main" class="text-nowrap logo-img">
						<img src="<?=base_url()?>assets/images/logos/mynemov3_white.png" width="180" alt="MyNEMO" />
					  </a>
					  <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-flex d-xl-none">
						<iconify-icon icon="solar:close-circle-outline"></iconify-icon>
					  </a>
					</div>
						<nav class="sidebar-nav scroll-sidebar" data-simplebar >
						  <ul id="sidebarnav">
							<li class="nav-small-cap">
							  <iconify-icon icon="solar:menu-dots-bold" class="nav-small-cap-icon fs-4"></iconify-icon>
							  <span class="hide-menu">MODULES</span>
							</li>
							  <!-- =================== -->
							  <!-- Menu -->
							  <?php echo $this->load->view("mainpage/main_menu"); ?>   
							  <!-- // Menu -->
							  <!-- ============================= -->
						  </ul>
						</nav>
							<div class="sidebar-footer hide-menu">
							  <!-- item-->
							  <a href="../horizontal/page-account-settings.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><iconify-icon
								  icon="solar:settings-linear"></iconify-icon></a>
							  <!-- item-->
							  <a href="../horizontal/app-email.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><iconify-icon
								  icon="solar:letter-linear"></iconify-icon></a>
							  <!-- item-->
							  <a href="../horizontal/authentication-login.html" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><iconify-icon
								  icon="solar:power-bold"></iconify-icon></a>
							</div>
							<!-- End Mobile View Menu -->
							<!-- ################################## -->

<!-- ################################## -->
<!-- Start Mobile View Header -->
<!-- ################################## --> 
				</div>
			</aside>
			 <!--  Sidebar End -->
				<div class="page-wrapper">
				  <!--  Header Start -->
				  <header class="topbar" style="background: linear-gradient(to right, #773ebd 0%, #a878e3 100%);">
					<div class="with-vertical">
					<nav class="navbar navbar-expand-lg p-0">
					<!-- ---------------------------------- -->
					<!-- 3 Lines Menu for Mobile -->
					  <ul class="navbar-nav">
						<li class="nav-item">
						  <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
							<iconify-icon icon="solar:hamburger-menu-linear"></iconify-icon>
						  </a>
						</li>
					  </ul>
					<!-- end 3 Lines Menu for Mobile -->
					<!-- ---------------------------------- -->          

					<!-- ---------------------------------- -->
					<!-- MyNEMO Logo Mobile View -->
					  <div class="d-block d-lg-none">
						<a href="<?=base_url()?>mainpage/main">
						<img src="<?=base_url()?>assets/images/logos/mynemov3_white.png" class="" width="180" alt="" />
						</a>
					  </div>
					<!-- end MyNEMO Logo Mobile View -->
					<!-- ---------------------------------- -->

					<!-- ---------------------------------- -->
					<!-- 3 dots menu for Mobile View -->
					<a class="navbar-toggler border-0 text-white nav-icon-hover" href="javascript:void(0)" data-bs-toggle="collapse"
						data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<iconify-icon icon="solar:menu-dots-bold" class="fs-7"></iconify-icon>
					  </a>
					<!-- end 3 dots menu for Mobile View -->
					<!-- ---------------------------------- -->

					  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
						<div class="d-flex align-items-center justify-content-between">

						  <ul class="navbar-nav d-flex d-lg-none flex-row">
							<!-- ---------------------------------- -->
							<!-- Sub System Name -->      
							<li class="nav-item text-white fs-6 d-md-flex align-items-center">
							<?php //echo $subsystem_name; ?>
							</li>
							<!-- Sub System Name -->      
							<!-- ---------------------------------- -->  
						  </ul>

						  <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">                
							<!-- ------------------------------- -->
							<!-- start home Link -->
							<li class="nav-item hover-dd dropdown">
							  <a class="nav-link nav-icon-hover" href="index.php" id="drop2" aria-expanded="false">
								<iconify-icon icon="solar:home-linear"></iconify-icon>
							  </a>
							</li>
							<!-- end home Mobile View -->
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start notification Dropdown Mobile View -->
							<li class="nav-item hover-dd dropdown">
							  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
								<iconify-icon icon="solar:checklist-minimalistic-outline"></iconify-icon>
								<div class="notify">
								  <span class="heartbit"></span> <span class="point"></span>
								</div>
							  </a>
							  <div class="dropdown-menu dropdown-menu-start content-dd dropdown-menu-animate-up mailbox" aria-labelledby="drop2">
								  <div class="d-flex border-bottom align-items-center justify-content-between py-3 px-4">
								    <div class="mb-0 fs-4 text-dark">To-do List</div>
								  </div>
								  <div class="message-body" data-simplebar>  
								    <?php echo $this->load->view("todo/main_todo"); ?>   

								  </div>
								  <div>
								    <a class="d-flex align-items-center pt-3 pb-2 justify-content-center text-dark" href="javascript:void(0);">
									  <span class="fw-semibold">Reload to-do list</span>
									  <iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
								    </a>
								  </div>
							  </div>
							</li>
							<!-- end notification Dropdown Mobile View -->
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start mailbox Link -->
							<li class="nav-item hover-dd dropdown">
							  <a class="nav-link nav-icon-hover" href="https://mail.google.com" id="drop2" aria-expanded="false" target="_blank">
								<iconify-icon icon="solar:letter-linear"></iconify-icon>
							  </a>
							</li>
							<!-- end mailbox Mobile View -->
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start dark/light mode Mobile View -->                
							<li class="nav-item">
							  <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
								<iconify-icon icon="solar:moon-line-duotone" class="moon"></iconify-icon>
							  </a>
							  <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
								<iconify-icon icon="solar:sun-2-line-duotone" class="sun"></iconify-icon>
							  </a>
							</li>
							<!-- end dark/light mode Mobile View -->                
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start language Dropdown Mobile View -->
							<li class="nav-item hover-dd dropdown"> 
							  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
								<img src="<?=base_url()?>assets/images/svgs/icon-flag-en.svg" alt="" width="20px" height="20px"
								  class="rounded-circle object-fit-cover round-20" />
							  </a>
							  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
								<div class="message-body" id="languages">
								  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
									<div class="position-relative">
									  <img src="<?=base_url()?>assets/images/svgs/icon-flag-en.svg" alt="" width="20px" height="20px"
										class="rounded-circle object-fit-cover round-20" />
									</div>
									<p class="mb-0 fs-3">Englishx (UK)</p>
								  </a>
								  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item">
									<div class="position-relative">
									  <img src="<?=base_url()?>assets/images/svgs/icon-flag-my.png" alt="" width="20px" height="20px"
										class="rounded-circle object-fit-cover round-20" />
									</div>
									<p class="mb-0 fs-3">Bahasa Melayu (Malay)</p>
								  </a>              
								</div>
							  </div>
							</li>
							
		
							<!-- end language Dropdown Mobile View -->
							<!-- ------------------------------- -->

							<!-- ------------------------------- -->
							<!-- start profile Dropdown Mobile View -->
							<li class="nav-item hover-dd dropdown">
								<!-- START PROFILE-->
							<?php echo $this->load->view("mainpage/main_userprofile"); ?>
								<!-- END PROFILE -->
							</li>
							<!-- end profile Dropdown Mobile View -->
							<!-- ------------------------------- -->
						  </ul>
						</div>
					  </div>
					</nav>
					<!-- ---------------------------------- -->
					<!-- End Vertical Layout Header -->
					<!-- ---------------------------------- -->

					<!-- ------------------------------- -->
					<!-- apps Dropdown in  Mobile View -->
				  <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="mobilenavbar"
					  aria-labelledby="offcanvasWithBothOptionsLabel">
					  <nav class="sidebar-nav scroll-sidebar">
						  <div class="offcanvas-body h-n80" data-simplebar>
							  <ul id="sidebarnav">
								  <li class="sidebar-item">
									  <a class="sidebar-link px-1" href="#" aria-expanded="false">
										  <span class="d-flex">
											  <iconify-icon icon="solar:shield-plus-outline" class="fs-6"></iconify-icon>
										  </span>
										  <span class="hide-menu">Apps X</span>
									  </a>                   
								  </li>
								  <li class="sidebar-item">
									  <a class="sidebar-link px-1" href="../horizontal/app-chat.html" aria-expanded="false">
										  <span class="d-flex">
											  <iconify-icon icon="solar:chat-unread-outline" class="fs-6"></iconify-icon>
										  </span>
										  <span class="hide-menu">Chat</span>
									  </a>
								  </li>
								  <li class="sidebar-item">
									  <a class="sidebar-link px-1" href="../horizontal/app-calendar.html" aria-expanded="false">
										  <span class="d-flex">
											  <iconify-icon icon="solar:calendar-minimalistic-outline" class="fs-6"></iconify-icon>
										  </span>
										  <span class="hide-menu">Calendar</span>
									  </a>
								  </li>
								  <li class="sidebar-item">
									  <a class="sidebar-link px-1" href="../horizontal/app-email.html" aria-expanded="false">
										  <span class="d-flex">
											  <iconify-icon icon="solar:inbox-unread-outline" class="fs-6"></iconify-icon>
										  </span>
										  <span class="hide-menu">Email</span>
									  </a>
								  </li>
							  </ul>
						  </div>
					  </nav>
				  </div>
					<!-- End apps Dropdown in Mobile View -->
					<!-- ------------------------------- -->
			</div>
			<!-- ################################## -->
			<!-- End Mobile View Header -->
			<!-- ################################## -->        


			<!-- ################################## -->
			<!-- Start Horizontal Header -->
			<!-- ################################## -->
			<div class="app-header with-horizontal">
			  <nav class="navbar navbar-expand-xl container-fluid p-0">  

				<!-- ---------------------------------- -->
				<!-- MyNEMO Logo for Horizontal View -->      
				<ul class="navbar-nav">
				  <li class="nav-item ">
					<a class="nav-link sidebartoggler ms-n3" id="sidebarCollapse" href="javascript:void(0)">

					</a>
				  </li>      
				  <li class="nav-item d-none d-xl-block">
					<a href="<?=base_url()?>mainpage/main" class="text-nowrap nav-link">
					  <img src="<?=base_url()?>assets/images/logos/mynemov3_white.png" class="" width="180" alt="" />
					</a>
				  </li>
				</ul>
				<!-- end MyNEMO Logo for Horizontal View -->      
				<!-- ---------------------------------- -->


			  <ul class="navbar-nav quick-links d-none d-xl-flex">
				<!-- ---------------------------------- -->
				<!-- Sub System Name -->      
				<li class="nav-item search-box d-none text-white fs-6 d-md-flex align-items-center">
				  <?php //echo $subsystem_name; ?>
				</li>
				<!-- Sub System Name -->      
				<!-- ---------------------------------- -->    

					<!-- ------------------------------- -->
					<!-- start notification Dropdown for Horizontal View -->
					<li class="nav-item hover-dd dropdown" id="todopanel" style="display:none">
					  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
						  <iconify-icon icon="solar:checklist-minimalistic-outline"></iconify-icon>
						  <div class="notify">
						    <span class="heartbit"></span> <span class="point"></span>
						  </div>
					  </a>
					  <div class="dropdown-menu dropdown-menu-start content-dd dropdown-menu-animate-up mailbox" ria-labelledby="drop2">
						  <div class="d-flex border-bottom align-items-center justify-content-between py-3 px-4">
						    <div class="mb-0 fs-4 text-dark">To-do List</div>
						  </div>
						  <div id="id-simplebar" class="message-body" data-simplebar>  
						    <?php echo $this->load->view("todo/main_todo"); ?> 
						  </div>
						  <div>
						    <a class="d-flex align-items-center pt-3 pb-2 justify-content-center text-dark" href="javascript:void(0);">
							  <span class="fw-semibold">Reload to-do list</span>
							  <iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon>
						    </a>
						  </div>
					  </div>
					</li>
					<!-- end notification Dropdown for Horizontal View -->
					<!-- ------------------------------- -->

					<!-- ------------------------------- -->
					<li class="nav-item hover-dd dropdown" id="todoloader">
					  <a class="nav-link nav-icon-hover" href="#" id="drop2" aria-expanded="false">
						<iconify-icon icon="eos-icons:loading"></iconify-icon>
					  </a>
					</li>
				    <!-- start mailbox Link for Horizontal View -->
					<li class="nav-item hover-dd dropdown">
					  <a class="nav-link nav-icon-hover" href="https://mail.google.com" id="drop2" aria-expanded="false">
						<iconify-icon icon="solar:letter-linear"></iconify-icon>
					  </a>
					</li>
				  
					<!-- end mailbox Dropdown for Horizontal View -->
					<!-- ------------------------------- -->

					<!-- ------------------------------- -->
					<!-- start mega-dropdown Dropdown for Horizontal View -->
					<li class="nav-item hover-dd dropdown mega-dropdown">
					  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
						data-bs-auto-close="outside" aria-expanded="false">
						<iconify-icon icon="solar:widget-linear"></iconify-icon>
					  </a>
					  <div class="dropdown-menu dropdown-menu-nav dropdown-menu-animate-up" aria-labelledby="drop2">
						<div class="row">
						  <div class="col-12">
							  <div class="ps-3 pt-3">
							  <h5 class="fs-5 mb-9 fw-semibold">Favourite Apps</h5>
									  <div class="row">                

											  <?php //include("inc_fav_apps_topmenu.php"); ?>
										   <?php echo $this->load->view("mainpage/fav_apps_topmenu"); ?>   

									  </div>
							  </div>
						  </div>
						</div>
					  </div>
					</li>
					<!-- end mega-dropdown Dropdown for Horizontal View -->
					<!-- ------------------------------- -->    
			  </ul>


			  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
				<div class="d-flex align-items-center justify-content-between px-0 px-xl-8">

				  <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
					<!-- ------------------------------- -->
					<!-- start Search for Horizontal View -->
					<li class="nav-item search-box d-none text-white d-md-flex align-items-center">
					  <div class="nav-link">
						<form name="searching" id="searching" class="app-search position-relative" action="<?=base_url()?>app" method="post">
						  <input type="text" name="nama" class="form-control rounded-pill border-0 shadow-none" placeholder="Search for Apps..." />
						  <a href="javascript:;" onclick="document.getElementById('searching').submit();" class="srh-btn"><iconify-icon icon="solar:magnifer-linear"
							  class="position-absolute top-50 end-0 translate-middle-y me-2"></iconify-icon></a>
						</form>
					  </div>
					</li>
					<!-- end Search for Horizontal View -->
					<!-- ------------------------------- -->

					<!-- ------------------------------- -->
					<!-- start Dark/Light mode for Horizontal View -->
					<li class="nav-item">
					  <a class="nav-link nav-icon-hover moon dark-layout" href="javascript:void(0)">
						<iconify-icon icon="solar:moon-line-duotone" class="moon"></iconify-icon>
					  </a>
					  <a class="nav-link nav-icon-hover sun light-layout" href="javascript:void(0)">
						<iconify-icon icon="solar:sun-2-line-duotone" class="sun"></iconify-icon>
					  </a>
					</li>
					<!-- end Dark/Light mode for Horizontal View -->
					<!-- ------------------------------- -->

					<!-- ------------------------------- -->
					<!-- start language Dropdown for Horizontal View -->
          <?php
          $session_lang = get_lang_sis();
          ?>
					<li class="nav-item hover-dd dropdown">
					  <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" aria-expanded="false">
						<img src="<?=base_url()?>assets/images/svgs/icon-flag-en.svg" alt="" width="20px" height="20px"
						  class="rounded-circle object-fit-cover round-20" />
					  </a>
					  <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
						<div class="message-body" id="languages">
						  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item lang" data-lang="EN">
							<div class="position-relative">
							  <img src="<?=base_url()?>assets/images/svgs/icon-flag-en.svg" alt="" width="20px" height="20px"
								class="rounded-circle object-fit-cover round-20" />
							</div>
							<p class="mb-0 fs-3">English (UK)</p>
						  </a>
						  <a href="javascript:void(0)" class="d-flex align-items-center gap-2 py-3 px-4 dropdown-item lang" data-lang="MY">
							<div class="position-relative">
							  <img src="<?=base_url()?>assets/images/svgs/icon-flag-my.png" alt="" width="20px" height="20px"
								class="rounded-circle object-fit-cover round-20" />
							</div>
							<p class="mb-0 fs-3">Bahasa Melayu (Malay)</p>
						  </a>              
						</div>
					  </div>
					</li>
				
	 
							<script>
              $( document ).ready( function() {
                  $( '.lang' ).on( 'click', function( ev ) {
                      ev.stopPropagation();
                      var dataLang = $( this ).attr( 'data-lang' );
                      
                      setLanguage( dataLang );
                  })
                  
                
                  function setLanguage( language )
                  {
                      $.ajax({
                          url: "<?=site_url("mainpage/lang_pick")?>",  // define here controller then function name
                          method: 'POST',
                          data: { dataLang: language },    // pass here your date variable into controller
                          success:function(data) {
                              alert(data); // alert your date variable value here
                              location.reload();
                          }
                      });
                  }
              })
              
              
	            (function() {
                  var language_select = document.getElementById("languages");
									var result = document.getElementById("selected-language");
                  //alert(language_select);
									language_select.addEventListener('change', function (event) {
                      var selected_value = this.value;
										  var selected_text = this.options[this.selectedIndex].text;
										  result.innerText = selected_value;

									    //alert(selected_value);
									    //var base_url = "<?=site_url("mainpage/lang_pick")?>";
									    //alert(base_url);
                  
									    $.ajax({
										    url: "<?=site_url("mainpage/lang_pick")?>",  // define here controller then function name
										    method: 'POST',
										    data: { dataLang: selected_value },    // pass here your date variable into controller
										    success:function(data) {
											    //alert(data); // alert your date variable value here
											    location.reload();
										    }
									    });
									});
								})();	
						</script>
					<!-- end language Dropdown for Horizontal View -->
					<!-- ------------------------------- -->

					<!-- ------------------------------- -->
					<!-- start profile Dropdown for Horizontal View -->
					<!-- ------------------------------- -->
					<li class="nav-item hover-dd dropdown">
					  <?php echo $this->load->view("mainpage/main_userprofile"); ?>
					</li>
					<!-- ------------------------------- -->
					<!-- end profile Dropdown for Horizontal View -->
					<!-- ------------------------------- -->

				  </ul>
				</div>
			  </div>
			</nav>
			</div>
			<!-- ################################## -->
			<!-- End Horizontal Header -->
			<!-- ################################## -->
			</header>
			<!--  Header End -->

			<aside class="left-sidebar with-horizontal">
			<!-- Sidebar scroll-->
			<div>
			  <!-- ################################## -->
			  <!-- Start Horizontal View Menu -->
			  <nav class="sidebar-nav scroll-sidebar container-fluid">
				<ul id="sidebarnav">
				  <?php echo $this->load->view("mainpage/main_menu"); ?>
				</ul>
			  </nav>


			  <!-- Start Horizontal View Menu -->
			  <!-- ################################## -->
			</div>
			<!-- End Sidebar scroll-->
			</aside>
