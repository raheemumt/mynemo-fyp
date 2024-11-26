<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
<script>
$(function() {

  // optional: don't cache ajax to force the content to be fresh
  $.ajaxSetup({
    cache: false
  });
 var id = document.getElementById("t01").value;
 //var i = document.getElementById("i").value;
	//alert(i);
  // specify the server/url you want to load data from
  var url = "<?php echo base_url();?>mainpage/main_menupage/"+id;
	alert(url);
	//var url = document.getElementById("#butang").getAttribute("href");;
  // on click, load the data dynamically into the #demo div
  // while loading, show three dots (…)
  $("#button").click(function() {
    $("#demo").html("…").load(url);
  });

});
/*	
$("#myHref").on('click', function() {
  alert("inside onclick");
  //window.location = "http://www.google.com";
	 $("#loadingimg").show();
});
	
$(document).ready(function (e) {

	
    $("form[ajax=true]").submit(function (e) {

        e.preventDefault();

        var form_data = $(this).serialize();
        var form_url = $(this).attr("action");
        var form_method = $(this).attr("method").toUpperCase();

        $("#loadingimg").show();

        $.ajax({
            url: form_url,
            type: form_method,
            data: form_data,
            cache: false,
            success: function (returnhtml) {
                $("#result-page").append(returnhtml).show();
                $('form').hide();
                $("#loadingimg").hide();
                setTimeout(function () {
                    $("#result-page").hide();
                    $("#link-page").show();
                }, 5000);
            }
        });

    });

});*/
</script>



<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- Header Space Sizing : DO NOT TOUCH-->
<div class="text-bg-white py-5 d-none d-xl-block" style="padding-top: 24px !important;"> <!--75px -->
</div>
<div class="text-bg-white py-5 d-flex d-lg-none" style="padding-top: 20px !important;">
</div>
<!-- End Header Space Sizing : DO NOT TOUCH-->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT STARTS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<div id="demo">
    <h1>Use jQuery load() to change this text</h1>
	<?php for ($i=0; $i<=2; $i++) {
	//($i = 1, $j = 0; $i <= 10; $j += $i, print $i, $i++);
	?>
	<a class="sidebar-link" id="button_<?=$i?>" name="button" href="#" aria-expanded="false">test_<?=$i?></a>
	<?php } ?>   
	<input name="t01" type="hidden" id="t01" value="3">
  </div>

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
<!-- BODY CONTENT ENDS HERE-->
<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

<!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->


<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- Page Style Setting = DO NOT TOUCH -->
<div class="offcanvas customizer offcanvas-end" tabindex="-1" id="offcanvasExample"
  aria-labelledby="offcanvasExampleLabel">

  <div class="offcanvas-body h-n80" data-simplebar>
    <h6 class="fw-semibold fs-4 mb-2">Theme</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check light-layout" name="theme-layout" id="light-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="light-layout">
        <iconify-icon icon="solar:sun-2-bold" class="icon fs-7 me-2"></iconify-icon>Light</label>

      <input type="radio" class="btn-check dark-layout" name="theme-layout" id="dark-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="dark-layout"><iconify-icon icon="solar:moon-linear"
          class="icon fs-7 me-2"></iconify-icon>Dark</label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Direction</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="direction-l" id="ltr-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="ltr-layout">
        <iconify-icon icon="solar:align-left-linear" class="icon fs-7 me-2"></iconify-icon>LTR</label>

      <input type="radio" class="btn-check" name="direction-l" id="rtl-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="rtl-layout"><iconify-icon icon="solar:align-right-linear"
          class="icon fs-7 me-2"></iconify-icon>RTL</label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Theme Colors</h6>

    <div class="d-flex flex-row flex-wrap gap-3 customizer-box color-pallete" role="group">
      <input type="radio" class="btn-check" name="color-theme-layout" id="Blue_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Blue_Theme')" for="Blue_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="BLUE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-1">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="Aqua_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Aqua_Theme')" for="Aqua_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="AQUA_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-2">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="Purple_Theme" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Purple_Theme')" for="Purple_Theme" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="PURPLE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-3">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="green-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Green_Theme')" for="green-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="GREEN_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-4">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="cyan-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Cyan_Theme')" for="cyan-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="CYAN_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-5">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>

      <input type="radio" class="btn-check" name="color-theme-layout" id="orange-theme-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary d-flex align-items-center justify-content-center"
        onclick="handleColorTheme('Orange_Theme')" for="orange-theme-layout" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-title="ORANGE_THEME">
        <div class="color-box rounded-circle d-flex align-items-center justify-content-center skin-6">
          <iconify-icon icon="tabler:check" class="text-white d-flex icon fs-5"></iconify-icon>
        </div>
      </label>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Layout Type</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <div>
        <input type="radio" class="btn-check" name="page-layout" id="vertical-layout" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="vertical-layout"><iconify-icon
            icon="solar:sidebar-minimalistic-linear" class="icon fs-7 me-2"></iconify-icon>Vertical</label>
      </div>
      <div>
        <input type="radio" class="btn-check" name="page-layout" id="horizontal-layout" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="horizontal-layout"><iconify-icon
            icon="solar:airbuds-case-minimalistic-linear" class="icon fs-7 me-2"></iconify-icon>Horizontal</label>
      </div>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Container Option</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="layout" id="boxed-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="boxed-layout"><iconify-icon
          icon="solar:align-horizonta-spacing-linear" class="icon fs-7 me-2"></iconify-icon>Boxed</label>

      <input type="radio" class="btn-check" name="layout" id="full-layout" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="full-layout"><iconify-icon
          icon="solar:align-vertical-spacing-linear" class="icon fs-7 me-2"></iconify-icon>Full</label>
    </div>

    <h6 class="fw-semibold fs-4 mb-2 mt-5">Sidebar Type</h6>
    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <a href="javascript:void(0)" class="fullsidebar">
        <input type="radio" class="btn-check" name="sidebar-type" id="full-sidebar" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="full-sidebar"><iconify-icon icon="solar:mirror-left-linear"
            class="icon fs-7 me-2"></iconify-icon>Full</label>
      </a>
      <div>
        <input type="radio" class="btn-check " name="sidebar-type" id="mini-sidebar" autocomplete="off" />
        <label class="btn p-9 btn-outline-primary" for="mini-sidebar"><iconify-icon icon="solar:mirror-right-linear"
            class="icon fs-7 me-2"></iconify-icon>Collapse</label>
      </div>
    </div>

    <h6 class="mt-5 fw-semibold fs-4 mb-2">Card With</h6>

    <div class="d-flex flex-row gap-3 customizer-box" role="group">
      <input type="radio" class="btn-check" name="card-layout" id="card-with-border" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="card-with-border"><iconify-icon
          icon="solar:quit-full-screen-square-linear" class="icon fs-7 me-2"></iconify-icon>Border</label>

      <input type="radio" class="btn-check" name="card-layout" id="card-without-border" autocomplete="off" />
      <label class="btn p-9 btn-outline-primary" for="card-without-border"><iconify-icon
          icon="solar:minimize-square-2-linear" class="icon fs-7 me-2"></iconify-icon>Shadow</label>
    </div>
  </div>
</div>
<!-- End of Page Style Setting = DO NOT TOUCH -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->
<!-- $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ -->


    

  
