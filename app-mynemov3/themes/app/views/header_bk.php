<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MYNEMO | Version 3</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/v3/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/v3/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/v3/dist/css/mynemo.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!--<script src="../assets/js/jquery.php.js"></script>
	<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
	
	<!--<script src="<?=base_url()?>asset/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
	<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!--<script src="../assets/js/jquery.php.js"></script>-->
	<script src="../assets/js/jquery.form.js"></script>
	<script src="../assets/js/jquery.js"></script>
</head>


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown d-lg-none">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">18</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">Senarai Tindakan</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> MyOT - Kewangan
                    <span class="float-right text-muted text-sm">2 Tindakan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> eLNPT
                    <span class="float-right text-muted text-sm">2 Tindakan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item pr-2">
            <a href="#" class="nav-link btn btn-flat btn-danger btn-sm" aria-label="Log Keluar" role="button"><span class="text-sm text-white"> INFO COVID-19 &nbsp;&nbsp; </span> <i class="fas fa-fw fa-exclamation-triangle 	d-none d-sm-inline-block"></i> </a>
        </li>
        <li class="nav-item">
            <a href="<?=site_url("logout")?>" class="nav-link btn btn-outline-warning btn-sm" aria-label="Log Keluar" role="button">
			<span class="text-sm d-none d-sm-inline-block">
			LOG OUT</span> <i class="fas fa-fw fa-unlock-alt"></i> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-user"></i></a>
        </li>
    </ul>
</nav>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark text-xs">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <div class="row mb-4 mt-0 text-xs">
            <span class="col-sm-7 text-xs">
                <a href="#" class="btn btn-xs btn-outline ">Profail</a>
            </span>
            <hr>
<!--
            <span class="col-sm-5 text-xs text-right">
                <a href="#" class="btn btn-xs btn-outline-secondary btn-block">LOG OUT <i class="fas fa-fw fa-unlock-alt"></i> </a>
            </span>
-->
        </div>
        <div class="user-panel mt-0 pb-3 mb-3 d-flex row">
            <div class="col-sm-12 row justify-content-center">
                <div class="circular-portrait text-center">
                    <img src="../assets/v3/images/nordin.jpg" class="elevation-2">
                </div>
            </div>
            <div class="col-sm-12 text-center text-xs">
                <br>
                <button class="btn btn-warning btn-lg text-sm btn-block"><small>LOG MASUK KERJA</small></button>

            </div>
            <br>

        </div>


        <dl class="row text-xs">
            <dt class="col-sm-4">ID Staf</dt>
            <dd class="col-sm-8 mb-0"><?php echo "UMT".str_pad($data->idstaf,5, "0", STR_PAD_LEFT);?></dd>
            <dt class="col-sm-4">No. KP</dt>
            <dd class="col-sm-8 mb-0"><?=$data->nokp?></dd>
            <br><br>
            <dt class="col-sm-4 text-white">Nama</dt>
            <dd class="col-sm-8 mb-0 text-white"><?=$data->nama?></dd>
            <dt class="col-sm-4 text-white">Jawatan</dt>
            <dd class="col-sm-8 mb-0 text-white">PEGAWAI TEKNOLOGI MAKLUMAT - F41</dd>
            <dt class="col-sm-4 text-white">PTJ/ Jabatan</dt>
            <dd class="col-sm-8 mb-0 text-white">PUSAT PENGURUSAN PENGETAHUAN DAN TEKNOLOGI KOMUNIKASI</dd>
            <dt class="col-sm-4 text-white">Taraf</dt>
            <dd class="col-sm-8 mb-0 text-white">TETAP</dd>
        </dl>
    </div>
</aside>
<!-- /.control-sidebar -->


