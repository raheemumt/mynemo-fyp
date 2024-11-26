<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MYNEMO | Version 4</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/mynemo.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/adminlte.css">
    
	<link rel="stylesheet" href="<?=base_url()?>assets/v3/dist/css/animate.css">
	<script src="<?=base_url()?>assets/v3/plugins/jquery/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
	
</head>
<body class="hold-transition  sidebar-collapse">
   <div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <a href="<?=base_url()?>mainpage/main" class="brand-link">
      <img src="<?=base_url()?>assets/images/logo_circle_green.svg" alt="MyNemo Logo" class="brand-image img-circle" style="opacity: .8">
      <span class="border-left brand-text font-weight-light text-dark text-lg">&nbsp;&nbsp; <b><strong>MyNEMO</strong></b></span>
  </a>
    <!-- Left navbar links -->



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item pr-3">
            <a href="<?=site_url("logout")?>" class="nav-link btn btn-default btn-sm" aria-label="Log Keluar" role="button"><span class="text-sm d-none d-sm-inline-block font-weight-bold"> LOG KELUAR MyNEMO</span> <i class="fa-fw fa fa-sign-out-alt"></i> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link btn btn-info btn-sm text-light" data-widget="control-sidebar" data-slide="true" href="#" role="button"><span class="text-sm d-none d-sm-inline-block font-weight-bold"> PROFIL</span> <i class="fas fa-user fa-fw"></i></a>
        </li>
    </ul>
</nav>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark text-xs">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <div class="row mb-4 mt-0 text-xs">
            <span class="col-sm-7 text-xs p-2">
                PROFIL
            </span>
            <hr>
<!--
            <span class="col-sm-5 text-xs text-right">
                <a href="#" class="btn btn-xs btn-outline-secondary btn-block">LOG OUT <i class="fas fa-fw fa-unlock-alt"></i> </a>
            </span>
-->
        </div>
        <div class="mt-0 pb-3 mb-3 d-flex row">
            <div class="col-sm-12 row mb-3 justify-content-center">
                <div class="rounded-portrait text-center">
                    <img src="/cencikutxxyyzz.php?kp=<?=$_SESSION['icno']?>" class="elevation-2">
                </div>
            </div>
			<br>
			<div class="col-sm-12 row justify-content-center">
			<dl class="row text-xs text-center">
			<dt>
            
			  </dt>
			  </dl>
			  </div>
            <br>
        </div>
<?php if (!empty($data->IDSTAF)) $idstaf = $data->IDSTAF; else $idstaf='';
	  if (!empty($data->NAMA)) $nama = $data->NAMA; else $nama='';		   
?>
        <dl class="row text-xs">
            <dt class="col-sm-4 text-white">ID Staf</dt>
            <dd class="col-sm-8 mb-0 text-white"><?php echo "UMT".str_pad($idstaf,5, "0", STR_PAD_LEFT);?></dd>
            <dt class="col-sm-4 text-white" >No. KP</dt>
            <dd class="col-sm-8 mb-0 text-white"><?=$_SESSION['icno']?></dd>
            <br>
            <dt class="col-sm-4 text-white">Nama</dt>
            <dd class="col-sm-8 mb-0 text-white"><?=$nama?></dd>
            <dt class="col-sm-4 text-white">Jawatan</dt>
            <dd class="col-sm-8 mb-0 text-white"><?php if (isset($data->JAWATAN)) echo $data->JAWATAN;?>-<?php if (isset($data->GRED)) echo $data->GRED;?></dd>
            <dt class="col-sm-4 text-white">PTJ/ Jabatan</dt>
            <dd class="col-sm-8 mb-0 text-white">PUSAT PENGURUSAN PENGETAHUAN DAN TEKNOLOGI KOMUNIKASI</dd>
            <dt class="col-sm-4 text-white">Taraf</dt>
            <dd class="col-sm-8 mb-0 text-white">TETAP</dd>
        </dl>
    </div>
</aside>
<!-- /.control-sidebar -->

