<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>MYNEMO | Version 3</title>

    <!-- Font Awesome Icons -->
  <!--<link rel="stylesheet" href="../assets/adminlte/bootstrap/css/bootstrap.min.css">-->
  <!-- Font Awesome -->
  <!--<link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.min.css">-->
  <link rel="stylesheet" href="assets/v3/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="../assets/plugins/ionicons/css/ionicons.min.css">-->
  <!-- Select2 -->
  <!--<link rel="stylesheet" href="../assets/v3/plugins/select2/css/select2.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/v3/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/v3/dist/css/mynemo.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
 <!-- <link rel="stylesheet" href="../assets/adminlte/dist/css/skins/_all-skins.min.css">-->
  <!-- Custom CSS -->
 <!-- <link rel="stylesheet" href="../assets/css/styles.css">-->
  <!-- jQuery 2.2.3 -->
  <script src="assets/v3/plugins/jquery/jquery.min.js"></script>
  
  

  <!--<link rel="stylesheet" href="../assets/adminlte/bootstrap/css/bootstrap-datepicker.min.css"> 
  <link rel="stylesheet" href="../assets/adminlte/bootstrap/css/bootstrap-timepicker.min.css"> 
  <link rel="stylesheet" href="../assets/adminlte/bootstrap/css/daterangepicker.css">
  
  <script src="../assets/adminlte/bootstrap/js/bootstrap-timepicker.min.js"></script>--> 
  <script src="assets/js/jquery.form.js"></script>  
  <script src="assets/v3/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.php.js"></script>
  <!--<script src="../assets/adminlte/bootstrap/js/bootstrap-datepicker.min.js"></script>  
  <script src="../assets/adminlte/bootstrap/js/daterangepicker.js"></script> 
  <script src="../assets/adminlte/bootstrap/js/moment.min.js"></script>  
  <script src="../assets/adminlte/bootstrap/js/select2.full.min.js"></script>  -->  
  <!-- Start Iqbal Tambah Untuk Datepicker-->
  <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <script src="assets/v3/plugins/jquery-ui/jquery-ui.js"></script>
  <!-- End Iqbal Tambah Untuk Datepicker-->
</head>
<script>
<?php $testlink = '/mytime/index.php/mywbf/wbf_stafpunch';?>
 function cekmytime() {
 $("#waitmytime").css("display","block");
 			$.ajax({
                url: '<?=$testlink?>',
                type: 'post',
				data: { token: '<?php echo $_SESSION['tokenx'];?>', masa: '<?php echo date('dmy G:i:s')?>'} ,
                success: function(data){
                    //If the success function is execute,
                    //then the Ajax request was successful.
                    //Add the data we received in our Ajax
                    //request to the "content" div.
                    $('#btn_mytime').html(data);
					//$("#waitmytime").css("display","none");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    //$('#btn_mytime').html(errorMsg);
                  }
            });
 }
 
 $( document ).ready(function(){
	$.ajax({
				url: '/cigen/demo/todonemo/todogen_icon/<?php echo $_SESSION['icno']?>',
                type: 'get',
				dataType: 'json',
                success: function(data){
					if(data.display == 'E') $('#stage').append('error no valid session');
					else 
					{
						$('#stage').append(data.todo);
					}
					$('#load1').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    $('#stage').html(errorMsg);
                  }
            });
        });

$( document ).ready(function(){
	$.ajax({
				url: '/cigen/demo/todonemo/todogen_count/<?php echo $_SESSION['icno']?>',
                type: 'get',
				dataType: 'json',
                success: function(data){
					if(data.display == 'E') $('#stage_count').append('error no valid session');
					else 
					{
						$('#stage_count').append(data.todo);
					}
					$('#load1').hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    $('#stage_count').html(errorMsg);
                  }
            });
        });
</script>
<style>
.title-case{ text-transform:capitalize; }
</style>
<body class="hold-transition sidebar-mini sidebar-collapse">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <!--<ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>-->


    <!-- Right navbar links -->
    
	<ul class="navbar-nav ml-auto">
		<!--<li class="nav-item dropdown">
		  <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="far fa-bell"></i>
			<span class="badge badge-warning navbar-badge">1</span>
		  </a>
		  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
			
			 
			  
			  <div id="stage"><span id="load1"></span></div>
			  
			 
			
			<div class="dropdown-divider"></div>
			<a href="<?=base_url()?>mainpage/main" class="dropdown-item dropdown-footer">Lihat semua notifikasi</a>
		  </div>
		</li>-->
		
		
        <!-- Notifications Dropdown Menu -->
       
		
		<li class="nav-item dropdown">
		<a class="nav-link" data-toggle="dropdown" href="#">
		 <!-- <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
			<i class="far fa-bell"></i>
			<span class="badge badge-warning navbar-badge">3</span>
		  </a>-->
		  <div id="stage_count"></div>
		  </a>
		  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
			
			  <!-- Message Start -->
			  
			  <div id="stage" ><span id="load1"></span></div>
			  
			  <!-- Message End -->
			
			<div class="dropdown-divider"></div>
			<a href="<?=base_url()?>mainpage/main" class="dropdown-item dropdown-footer">Lihat semua notifikasi</a>
		  </div>
		</li>
						
	  
	   <li class="nav-item pr-2">
		<?php //if ($covid)
		//echo "sini".$ipmytime->T10_IP;
		
			  
		?>
        </li>
        <li class="nav-item pr-2">
            <a href="#" class="nav-link btn btn-flat btn-danger btn-sm" aria-label="Log Keluar" role="button"><span class="text-sm text-white"> INFO COVID-19 &nbsp;&nbsp; </span> <i class="fas fa-fw fa-exclamation-triangle 	d-none d-sm-inline-block"></i> </a>
        </li>
        <li class="nav-item">
            <a href="<?=site_url("logout")?>" class="nav-link btn btn-outline-warning btn-sm" title="<?php if (isset($data->NAMA)) echo $data->NAMA;?>" aria-label="Log Keluar" role="button">
			<span class="text-sm d-none d-sm-inline-block">
			LOG OUT</span> <i class="fas fa-fw fa-unlock-alt"></i> </a></li>
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
            <div class="col-sm-12 row mb-3 justify-content-center">
                <div class="circular-portrait text-center">
                    <img src="/cencikutxxyyzz.php?kp=<?=$_SESSION['icno']?>" class="elevation-2">
                </div>
            </div>
			<br>
			<div class="col-sm-12 row justify-content-center">
			<dl class="row text-xs text-center">
			<dt>
            <?php
			if (!empty($covid->TKH))
			  {
				  if (isset($wfh->ID)){
					 echo " <div id='btn_mytime'></div>
						<script>cekmytime()</script>
						"; 
				  } else {	
			  			//echo "<a href='#' class='nav-link btn btn-flat btn-warning btn-sm' aria-label='Log Keluar' role='button'><span class='text-sm text-red'> <strong>Log Masuk Kerja</strong></span></a>";
			  	 	
				 if (!empty($ipmytime->T10_IP))
					  {
					  	echo " <div id='btn_mytime'></div>
						<script>cekmytime()</script>
						";
					  }
				 }	
			  } else {
			  echo "
			  <a href='/my3k/saringan/'><span class='username text-center text-warning'>Isi My3K</span> <br>
			  <span class='description text-xs text-warning'>(Log masuk kerja setelah My3K diisi)</span></a> 
			  ";
			  } 
			  ?>
			  </dt>
			  </dl>
			  </div>
            <br>

        </div>

<?php if (!empty($data->IDSTAF)) $idstaf = $data->IDSTAF; else $idstaf='';
	  if (!empty($data->NAMA)) $nama = $data->NAMA; else $nama='';		   
?>
        <dl class="row text-xs">
            <dt class="col-sm-4">ID Staf</dt>
            <dd class="col-sm-8 mb-0"><?php echo "UMT".str_pad($idstaf,5, "0", STR_PAD_LEFT);?></dd>
            <dt class="col-sm-4">No. KP</dt>
            <dd class="col-sm-8 mb-0"><?=$_SESSION['icno']?></dd>
            <br><br>
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


