<?php $data = $this->auth->userdata();
	  $f = $this->t02m->get_t01t04($data->IDSTAF);
	  if($f)
	  {
		foreach ($f->result() as $fv)
		{
			$f2 = $this->t02m->t02_aplikasifav($data->IDSTAF,$fv->T01_ID);
?>
		<div class="col-6">
			<div class="d-flex align-items-center pb-9 position-relative">
				<div
					class="bg-<?=$fv->T01_ICON_COLOUR?>-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center border-end">
					<iconify-icon icon="<?=$fv->T01_ICON?>" class="text-<?=$fv->T01_ICON_COLOUR?> fs-5"></iconify-icon>&nbsp;
				</div>
				<div class="d-inline-block">
					<h6 class="mb-0"><?=$fv->T01_NAMA_BI?></h6>
					
					
					<?php foreach ($f2->result() as $dt02)
						  {
				   ?>
					<span class="fs-3 d-block text-<?=$fv->T01_ICON_COLOUR?>">
					<?php
							 if ($dt02->T02_QUERYMENU=='Y') { 
				   					echo "<a href='/cek_akseslevel.php?idapp=$dt02->T02_ID'>$dt02->T02_NAMA_APP</a>&nbsp;&nbsp;";?>
				   		  <?php } else { 
						 				if ($dt02->T02_LOGIN=='Y') { ?>
				   							<a href="<?=base_url()?>mainpage/redir/redirect/<?=$dt02->T02_ID?>" class="Menu_Capaian2"><?=$dt02->T02_NAMA_APP?></a>&nbsp;&nbsp;			  
								  <?php } else { ?>			
											<?php if ($dt02->T02_PLATFORM=='8') { ?>
												<a href="<?=base_url()?>mainpage/redir/redirect/<?=$dt02->T02_ID?>"><?=$dt02->T02_NAMA_APP?></a>&nbsp;&nbsp;
										 <?php } else { ?>
												<a href="<?=base_url()?>mainpage/redir/opensys/<?=$dt02->T02_ID?>/<?=$dt02->T02_URL?>"><?=$dt02->T02_NAMA_APP?></a>&nbsp;&nbsp;
							<?php 			   } 
										}
							   }
						?>
					</span>
					<?php
						}
				   ?>
					</span>
				</div>
			</div>
		</div>
<?php } } ?>

