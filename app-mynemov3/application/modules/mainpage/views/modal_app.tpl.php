
<?php
/*$dt01 = $this->t01_model
             ->find_by(array('t01_id' => $t01id));*/
			 $data = $this->auth->userdata();
			 //echo $data->idstaf;
?>
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLongTitle">Senarai Aplikasi <?=ucwords(strtolower($dt01->T01_NAMA))?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <div class="row p-4" >
	  <?php if ($t02) :
						foreach ($t02->result() as $dt02):
						$f = $this->t02m->t04_count($dt02->T02_ID,$data->IDSTAF);
						
						if ($f->JUM>0){
							$c = "color:red";
						} else { $c = "color:grey";
						
						}
			?>	
			  <div class="modal-body text-sm col-md-6 shadow-sm p-3 mb-1 bg-white rounded">
				   <label class="tajuk_app">
				   <?php if ($dt02->T02_QUERYMENU=='Y') { 
				   			echo "<a href='/cek_akseslevel.php?idapp=$dt02->T02_ID'>$dt02->T02_NAMA_APP</a>";?>
				   <?php } else { 
						 	if ($dt02->T02_LOGIN=='Y') { ?>
				   			<a href="<?=base_url()?>mainpage/redirect/<?=$dt02->T02_ID?>" class="Menu_Capaian2"><?=$dt02->T02_NAMA_APP?></a>
				  
						<?php } else { ?>
									
							<?php if ($dt02->T02_PLATFORM=='8') { ?>
							<i class="<?=$dt02->T02_ICON?> text-maroon"></i> <a href="<?=base_url()?>mainpage/redirect/<?=$dt02->T02_ID?>"><?=$dt02->T02_NAMA_APP?></a>
							<?php } else { ?>
								<i class="<?=$dt02->T02_ICON?> text-maroon"></i> <a href="<?=base_url()?>mainpage/opensys/<?=$dt02->T02_ID?>/<?=$dt02->T02_URL?>"><?=$dt02->T02_NAMA_APP?></a>
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
			 
	   <?php endforeach; 
								 endif; ?>
	  </div>
	  
      