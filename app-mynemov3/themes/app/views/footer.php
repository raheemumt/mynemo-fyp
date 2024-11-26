<style type="text/css">
/*.merah {color: red;}
.important {color: grey;}
.on {background-color:red;}*/

.dropdown-large{ padding:20px; }

@media all and (min-width: 992px) {

	.dropdown-large{min-width:600px;}

}
</style>
<footer>
<nav class="navbar text-md navbar-expand navbar-fixed navbar-dark low-menu nav justify-content-center loginbg" style="border-color:#147682;">


    <!-- Right navbar links -->
    <?php //if (isset($t01A) && is_array($t01) && count($t01)) :?>
	<?php 
			foreach ($t01->result() as $t01) : 
			
			?>
	<ul class="navbar-nav w-auto">
        <li class="nav-item dropup">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-center">
			<i class="fas fa-user"></i><br><?=$t01->T01_NAMA?> </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu dropdown-large border-0 shadow bg-info" style="left: 0px; right: inherit;">
             <div class="row">   
			<?php
				$t02 = $this->t02m->t02t01($t01->T01_ID);
						
				if ($t02) :

				foreach ($t02->result() as $t02):

				//$where = "deleted is NULL";
				/*$f = $this->t04_model
				->select("count(T04_ID) as jum")
				//->where($where)
				->find_by(array('t02_id' =>$t02->T02_ID,'t04_idstaf' =>$data->idstaf));
				if ($f->jum>0){
					$c = "color:red";
				} else { $c = "color:grey";}*/
			?>
                
                <div class="col-md-6">
					
					<li>
					<?php if ($t02->T02_QUERYMENU=='Y') { echo "<a href='/cek_akseslevel.php?idapp=$t02->T02_ID' style='color: white;'>$t02->T02_NAMA_APP</a>";?>
					<?php } else { if ($t02->T02_LOGIN=='Y') {?>
					<a href="<?=$t02->T02_URL?>" target="_blank" style="color: white;"><?=$t02->T02_NAMA_APP?></a>
					<?php } else { ?>
					<a href="/<?=$t02->T02_URL?>" target="_blank" style="color: white;"><?=$t02->T02_NAMA_APP?></a>
					<?php } } ?>
					</li>
                 </div>
				 <?php endforeach;
				 endif;
				 // }
				 ?>  
                
                 <div class="col-md-12 text-right">
				 
                     <a class="btn btn-outline-light btn-sm" data-toggle="modal" data-target="#exampleModalCenter" onClick="open_modal_app('<?=$t01->T01_ID?>')"> SENARAI APLIKASI <?=$t01->T01_NAMA?> <i class="fas fa-info-circle fa-fw"></i></a>
                </div>


                </div>
                <!-- Level two dropdown-->

                <!-- End Level two -->

            </ul>
        </li>
        
    </ul>
	 <?php endforeach; //endif;  ?>
	 <ul class="navbar-nav w-auto">
        <li class="nav-item dropup">
		<a id="dropdownSubMenu1" href="<?=base_url()?>mainpage/main"  class="nav-link text-center">
			<i class="fas fa-home"></i><br>Home</a>
		</li>
	</ul>	
</nav>

<div class="modal fade" id="myapp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      
	  <div id="tabapp"><?php echo $table;?></div>
	  <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
</footer>
<script>
	function open_modal_app(t01id)
	{ 
		$.php('<?=base_url()?>mainpage/fmodal_app', { t01id:t01id });
		$('#myapp_modal').modal('show');
	}
	
	$('#myapp_modal').on('hidden.bs.modal', function () {
    	window.location.reload(true);
});
</script>

<!--<script src="../assets/v3/plugins/jquery/jquery.min.js"></script>-->
    <!-- Bootstrap 4 -->
    <script src="assets/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/v3/plugins/bootstrap/js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/v3/dist/js/adminlte.min.js"></script>