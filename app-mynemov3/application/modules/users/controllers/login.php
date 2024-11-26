
<html class="p-0 m-0 h-100">

<body class="hold-transition lockscreen container-fluid wrapper bgstar p-0 m-0 layout-top-nav ">
<!--<iframe src="http://mynemo-dev.umt/portal_handles.php?p=Logout" height="1" width="1" title="Iframe Example"></iframe>-->
<nav class="ml-0 navbar navbar-white navbar-light bg-bar navbar-expand-md">
  <a href="home.php" class="brand-link animate__animated animate__fadeInLeft">
        <img src="assets/images/logo_korporat.svg" alt="UMT Logo" class="brand-image" style="opacity: 1">
      
      <span class="border-left border-purple brand-text font-weight-light text-info text-lg">&nbsp;&nbsp; My<b>NEMO</b></span>
  </a>
  <span class="navbar-nav ml-auto text-sm text-info text-left pr-5 d-none d-lg-block">My Network of Management Operation</span>
</nav>

<!-- <div class="row h-20 bg-white pl-5 pr-5"><img src="#"></div> -->
<div class="vh-100 p-0 m-0 bgstar">
<div class="row align-items-center loginbgstar vh-100 pb-5 m-0 ">
	<div class="col-lg-7 pt-0 pl-5 pb-5 d-none d-lg-block align-self-center">
    <div class="align-middle  shadow mb-0 p-3 bg-transparent rounded float-right" style="width:90%">
		<div class="embed-responsive embed-responsive-4by3">
      <iframe class="embed-responsive-item" src="https://www.umt.edu.my/spau2/display/board.php" scrolling="no"></iframe>
    </div>
    </div>
	</div>
        <!-- LOGIN START -->
  <div class="col-lg-5  p-0 m-0 align-self-center align-item-center animate__animated animate__fadeInUp">
    <div class="lockscreen-wrapper mt-0 text-sm text-center">
        <img class="img img-center pb-3" src="<?=base_url()?>assets/images/login_logo.png" width="200px">
        <!-- START LOCK SCREEN ITEM -->
      
			
				<!--<div class="input-group input-group-lg mb-3 text-center p-5 m-0">-->
					<p class="w-100 text-center"><font color="white">Log Masuk <i class="text-secondary">login</i></font></p>
					<div class="social d-flex text-center">
						<a href="<?=base_url('/users/fedlogin');?>" class="btn btn-outline-primary btn-block px-2 py-2 mt-2 md-1 rounded border border-white"><strong><font color="white">Warga UMT</font></strong></a>
					<a href="<?=base_url('loginothers');?>" class="btn btn-outline-primary btn-block px-2 py-2 ml-md-1 rounded border border-white"><strong><font color="white">Bukan Warga UMT</font></strong></a>

				</div>
					
					<!--<div class="social-auth-links text-center mb-3">
						<a href="<?=base_url('/users/fedlogin');?>" class="btn btn-block btn-primary">
						 Warga UMT
						</a>
					</div>
					<br>
					<div class="social-auth-links text-center mb-3 p-1 m-1">
						<a href="<?=base_url('login_others');?>" class="btn btn-block btn-default">
						 Bukan Warga UMT
						</a>
					</div>-->
				<!--</div>-->
				
	
		<?php //echo form_open((!$bypass) ? $this->uri->uri_string(): site_url("users/login"), array('id' => 'frm_login', 'name' => 'frm_login')) ?>
		<!--<div class="input-group input-group-lg mb-3 text-center ">
            
            <input name="username" class="form-control border-0 text-sm" placeholder="Username" style="outline:none!important;" autofocus>

        </div>
        <div class="input-group input-group-lg mb-3 text-center ">

            <input name="password" type="password" class="form-control border-0 text-sm" placeholder="Password" style="outline:none!important;">
            <div class="input-group-append">
                <button type="submit" name="login" class="btn bg-white"><i class="fas fa-arrow-right fa-lg text-muted"></i></button>
			</div>
			
		
        </div>-->
		<!--<div class="input-group input-group-lg mb-3 text-center ">
			<div class="social-auth-links text-center mb-3">-->
				<!--<a href="https://idp3.umt.edu.my/idp/profile/SAML2/Redirect/SSO?execution=e1s1" class="btn btn-block btn-primary">
				 Login IDP
				</a>-->
			<!--</div>
		</div>
		</form>-->
		<br>
        <a class="text-sm lead text-white" href="https://traffic.umt.edu.my/ssp/" target="_blank">Terlupa ID/katalaluan?  <i class="text-secondary">Forgot Password</i></a>
        <br>
        <br>
        
		<div class="text-center">
			<a href="https://www.facebook.com/OfficialUMT" class="btn btn-sm bg-primary" target="_blank"><i class="fab fa-facebook"></i></a>
			<a href="https://www.youtube.com/channel/UClnJ7YLLQQVN4LiXKeY0GeA/videos" class="btn btn-sm btn-danger" target="_blank"><i class="fab fa-youtube" ></i></a>
			<a href="https://www.tiktok.com/@official_umt?lang=en" class="btn btn-sm btn-dark" target="_blank"><i class="fab fa-tiktok"></i></a>
			<a href="https://www.instagram.com/OfficialUMT/" class="btn btn-sm bg-teal" target="_blank"><i class="fab fa-instagram"></i></a>
			<a href="https://twitter.com/UMT_Official" class="btn btn-sm btn-info" target="_blank"><i class="fab fa-twitter"></i></a>
			<a href="https://www.umt.edu.my/umt-contact-directory/" class="btn btn-sm btn-secondary" target="_blank"><i class="fas fa-phone-alt"></i></a>
		</div>

        <!-- /.lockscreen credentials -->


    </div>
    </div>

    </div>
  </div>
    




    <!-- jQuery -->
   

</body>

</html>
