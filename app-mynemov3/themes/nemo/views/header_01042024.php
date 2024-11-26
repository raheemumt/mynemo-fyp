<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MYNEMO | Version 3</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/mynemo.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/adminlte.css">
    
	<link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/animate.css">
	<script src="<?=base_url()?>assets/v3/plugins/jquery/jquery.min.js"></script>
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/jqvmap/jqvmap.min.css">
	<!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?=base_url()?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

	<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
	
</head>

<body class="hold-transition sidebar-collapse">
<div class="wrapper">

  <!-- Preloader -->
 
  <!-- Navbar -->
  <?php if (!empty($data->IDSTAF)) $idstaf = $data->IDSTAF; else $idstaf='';
	  if (!empty($data->NAMA)) $nama = $data->NAMA; else $nama='';		   
	?>	
	<nav class="main-header navbar navbar-expand bg-default navbar-light">
	<a href="<?=base_url()?>mainpage/main" class="brand-link">
      <img src="<?=base_url()?>assets/images/logo_circle_green.svg" alt="MyNemo Logo" class="brand-image img-circle" style="opacity: .8">
      <span class="border-left brand-text font-weight-light text-dark text-lg">&nbsp;&nbsp; <b><strong>MyNEMO</strong></b>&nbsp;&nbsp;<?php if (!empty($id)) echo $platform->T02_NAMA_APP;?></span>
  </a>
   
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
 <!--     <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
		  <div id="stage_count"></div>
		  </a>
		  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; overflow-y: scroll; max-height:80vh;">
			  <div id="stage_icon" ><span id="load1"></span></div>
			  
			<div class="dropdown-divider"></div>
			<a href="<?=base_url()?>mainpage/main" class="dropdown-item dropdown-footer">Lihat semua notifikasi</a>
		  </div>
      </li>-->
		
      <!--<li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>-->
		
		<li class="nav-item dropdown">
        <a class="btn btn-info btn-sm text-light" data-toggle="dropdown" href="#" role="button">
          
          <span class="text-sm d-none d-sm-inline-block font-weight-bold">Profil  [<?=$_SESSION['UID']?>] <i class="fas fa-user fa-fw"></i></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<div class="card-header bg-info"><h3 class="card-title">Profil</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				  <div class="rounded-portrait text-center">
				  <img src="/cencikutxxyyzz.php?kp=<?=$_SESSION['icno']?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
					  <i class="fas fa-paint-brush" style="color: red;"></i>
				  </div>
                <strong> Nama</strong>
             	 <p class="text-muted"><?=$nama?></p>
				 <hr>
				<strong> ID Staf</strong>
             	 <p class="text-muted"><?php echo "UMT".str_pad($idstaf,5, "0", STR_PAD_LEFT);?></p>
				 <hr>
				<strong> No.KP</strong>
             	 <p class="text-muted"><?=$_SESSION['icno']?></p>
				 <hr>
				<strong> Jawatan</strong>
             	 <p class="text-muted"><?php if (isset($data->JAWATAN)) echo $data->JAWATAN;?>-<?php if (isset($data->GRED)) echo $data->GRED;?></p>
				<hr>
				<strong> PTJ</strong>
             	 <p class="text-muted"><?php if (isset($data->PTJ)) echo $data->PTJ;?></p>
				<hr>
				<strong> Taraf</strong>
             	 <p class="text-muted"><?php if (isset($data->TARAF)) echo $data->TARAF;?></p>
              </div>
              <!-- /.card-body -->
          </a>
         
      
      </li>
	 <li class="nav-item pl-3">
            <a href="<?=site_url("logout")?>" class="btn btn-secondary btn-sm text-light" aria-label="Log Keluar" role="button"><span class="text-sm d-none d-sm-inline-block font-weight-bold"> Log Keluar Mynemo</span> <i class="fa-fw fa fa-sign-out-alt"></i> </a>
        </li>
    </ul>
  </nav>

 
	

