<script>
function save(warna,idstaf, t02id){
	var idstaf2 = idstaf;
	//var t02id2 = t02id;
	
	if(idstaf2!=""){
	//$('#love_'+t02id).addClass("important merah");
	$.php('<?php echo base_url();?>mainpage/save_fav', {warna: warna, idstaf:idstaf, t02id:t02id});
	
	} else {
	
		document.location.href="<?=base_url()?>mainpage/main";
	}
}
</script>
	<div class="card-header border-0">
		<form action="<?=base_url()?>app" method="post">
		<div class="text float-right">
		<div class="input-group">
			<input type="search" name="nama" id="nama" class="form-control form-control-sm" placeholder="Carian Aplikasi">
			<div class="input-group-append">
				<button type="submit" class="btn btn-sm btn-default">
					<i class="fa fa-search"></i>
				</button>
			</div>
		</div>
		</div>
	</form>
	</div>

<?php
/*$dt01 = $this->t01_model
             ->find_by(array('t01_id' => $t01id));*/
			 $data = $this->auth->userdata();
			 //echo $data->idstaf;
?>
 
	  <div class="row p-4 mb-5" >
	  <?php if ($capp) :
						foreach ($capp->result() as $dt02):
						$f = $this->t02m->t04_count($dt02->T02_ID,$data->IDSTAF);
						
						if ($f->JUM>0){
							$c = "color:red";
						} else { $c = "color:grey";
						
						}
			?>	
			  <div class="modal-body text-sm col-md-4 shadow-sm p-3 mb-1 bg-white rounded">
				   <label class="tajuk_app">
				   <?php if ($dt02->T02_QUERYMENU=='Y') { 
				   			echo "<a href='/cek_akseslevel.php?idapp=$dt02->T02_ID'>$dt02->T02_NAMA_APP</a>";?>
				   <?php } else { 
						 	if ($dt02->T02_LOGIN=='Y') { ?>
				   			<a href="#" onClick="cek_url('<?=$dt02->T02_ID?>')" class="Menu_Capaian2"><?=$dt02->T02_NAMA_APP?></a>
				  
						<?php } else { ?>
									
							<?php if ($dt02->T02_PLATFORM=='8') { ?>
							<i class="<?=$dt02->T02_ICON?> text-maroon"></i> <a href="<?=base_url()?>mainpage/redirect/<?=$dt02->T02_ID?>"><?=$dt02->T02_NAMA_APP?></a>
							<?php } else { ?>
								<i class="<?=$dt02->T02_ICON?> text-maroon"></i> <a href="#" onClick="check_link('<?=$dt02->T02_URL?>','<?=$dt02->T02_ID?>');" ><?=$dt02->T02_NAMA_APP?></a>
							<?php } 
							 }
						}?>
				   </label>
				<a  id="love_<?=$dt02->T02_ID?>" href="javascript:save('<?=$c?>','<?=$data->IDSTAF?>','<?=$dt02->T02_ID?>')" >
			  <i class="fa fa-heart pull-right" style="font-size: 12px; <?=$c?>"></i> 
			  </a>
				<br>
					<span class="text">
					Status : <strong><?php if ($dt02->T02_STATUS=='A') echo "Aktif";
											else echo "Belum Aktif";?></strong><br>
					<?=$dt02->T02_KETERANGAN?></span>
					<br>
					
					<?php
					
					/*$wp = "t03_support.T02_ID='$dt02->T02_ID' and t03_support.T03_STATUS = 'A'";
					//$wp = "t03_support.T03_STATUS = 'A'";
					$p = $this->personel_model
    					->select("personel.nama,t03_support.T03_NOTEL")
						->join("t03_support", "t03_support.t03_idstaf = personel.idstaf")
						->where($wp)
    					->find_all();*/
						//->find_by(array('t03_support.t02_id' =>$dt02->T02_ID));
					//if ($p):
					
				   ?>		
					
					<div>
					<i class="fas fa-users-cog title-case"></i> <strong>Pegawai Bertanggungjawab:</strong><br>
					<?php $t03=$this->t02m->get_t03($dt02->T02_ID);
							foreach ($t03->result() as $t03){?>
					
					<?php echo ucwords( strtolower($t03->NAMA))." : ".$t03->T03_NOTEL?><BR>
					<?php } //endforeach?>
					</div>
					
				<?php //endif;?>	
					
			  </div>
			 
	   <?php endforeach; endif; ?>
	  </div>
      