<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Favicon icon-->
<link rel="shortcut icon" type="image/png" href="<?=base_url()?>/assets/images/logos/icon.png" />

<!-- Core Css -->
<link rel="stylesheet" href="<?=base_url()?>/assets/css/styles.css" />
  <title>MyNEMO - Login</title>
</head>
<body>
  <!-- Preloader -->
  <div class="preloader">
    <img src="<?=base_url()?>/assets/images/logos/icon.png" alt="loader" class="lds-ripple img-fluid" />
  </div>
  <div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
      <div class="position-relative z-index-5">
        <div class="row">
          <div class="col-xl-5 col-xxl-4" style="background: linear-gradient(to right, #773ebd 0%, #a878e3 100%) !important;">
            <div class="authentication-login min-vh-100 row justify-content-center">
              <div class="col-12">
                
              </div>
              <div class="auth-max-width col-12 px-4">
                <center><img src="<?=base_url()?>/assets/images/landingpage/logo_UMT.png" width="150px" alt="MyNEMO"/></center>
                <center><img src="<?=base_url()?>/assets/images/logos/mynemov3_white.png" alt="MyNEMO"/></center>
				<small class="mb-0 px-3 d-inline-block text-light text-center"><em>Malaysian Nautical Educational Management Operations (MyNEMO) is an integrated educational management system for <strong>Universiti Malaysia Terengganu (UMT)</strong>. Nemo is also a nickname for amphiprion ocellaris also known as ocellaris clownfish.</em></small>
                <div class="position-relative text-center my-4">
                  <p class="mb-0 fs-4 px-3 d-inline-block text-white z-index-5 position-relative">Please sign in with</p>
                  <span class="border-top w-100 position-absolute top-50 start-50 translate-middle"></span>
                </div>
                <form class="mb-3">

                  <a href="<?=base_url('/users/fedlogin');?>" class="btn btn-warning w-100 py-8 mb-4 rounded-2">UMT ID<br><small><em>(Staff/ Student/ Part time)</em></small></a>
                  <a href="<?=base_url('/loginothers');?>" class="btn btn-light w-100 py-8 mb-4 rounded-2">Visitor ID<br><small><em>(Reporting/ Locum/ External)</em></small></a>
                  <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
                    <li class="position-relative">
                      <a class="d-flex align-items-center justify-content-center text-bg-primary p-2 fs-4 rounded-circle" href="https://www.facebook.com/OfficialUMT" width="30" height="30">
                        <i class="ti ti-brand-facebook"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-bg-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="https://www.youtube.com/channel/UClnJ7YLLQQVN4LiXKeY0GeA/videos">
                        <i class="ti ti-brand-youtube"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-bg-dark d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="https://www.tiktok.com/@official_umt?lang=en">
                        <i class="ti ti-brand-tiktok"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-bg-success d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="https://www.instagram.com/OfficialUMT/">
                        <i class="ti ti-brand-instagram"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-bg-info d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="https://twitter.com/UMT_Official">
                        <i class="ti ti-brand-twitter"></i>
                      </a>
                    </li>
                    <li class="position-relative">
                      <a class="text-bg-light d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="https://www.umt.edu.my/umt-contact-directory">
                        <i class="ti ti-phone"></i>
                      </a>
                    </li>
                    
                  </ul>                  

                </form>  
                <div class="text-dark text-white border-top text-center fs-2 p-2 mt-5">MyNemo v3.0 by Pusat Ekosistem Digital, Universiti Malaysia Terengganu</div>
            </div>
            
            </div>
        </div>    
        <div class="col-xl-7 col-xxl-8 d-none d-xl-block">
            <div class="d-none d-xl-flex align-items-center justify-content-center h-100">
              <iframe class="embed-responsive-item" src="https://www.umt.edu.my/spau2/display/board.php" scrolling="no" width="80%" height="80%"></iframe>
				<!--<img src="<?=base_url()?>/assets/images/landingpage/banner01.jpg" alt="" class="img-fluid" width="80%">-->
            </div>
          </div>
        </div>
    </div>
      <script>
  function handleColorTheme(e) {
    $("html").attr("data-color-theme", e);
    $(e).prop("checked", !0);
  }
</script>

    </div>
  </div>
  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
<script src="<?=base_url()?>/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="<?=base_url()?>/assets/js/theme/app.init.js"></script>
<script src="<?=base_url()?>/assets/js/theme/theme.js"></script>
<script src="<?=base_url()?>/assets/js/theme/app.min.js"></script>
<script src="<?=base_url()?>/assets/js/theme/sidebarmenu.js"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>