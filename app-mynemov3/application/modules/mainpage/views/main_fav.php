<script>
function save_fav(warna,idstaf, t02id){
	
	var idstaf2 = idstaf;
	
	if(idstaf2!=""){
	$.php('<?php echo base_url();?>mainpage/save_fav', {warna: warna, idstaf:idstaf, t02id:t02id});
	refresh_list_2(idstaf);
	} else {	
		document.location.href="<?=base_url()?>mainpage/main";
	}
}
function refresh_list_2(idstaf) {
        $.php('<?php echo base_url(); ?>mainpage/refreshlist_fav', {idstaf:idstaf});//idstaf: $("#idstaf").val(), t02id: $("#t02id").val() });
}
</script>
<?php if ($t0204){
		foreach ($t0204->result() as $t0204) { 
			$f = $this->t02m->t04_count($t0204->T02_ID,$data->IDSTAF);

			if ($f->JUM>0){
				$c = "solar:star-bold";
			} else { $c = "solar:star-linear";

			}
?>
	<?php if ($t0204->T02_PLATFORM=='8') $linkfav = "mainpage/redir/redirect"; else $linkfav = "mainpage/redir/opensys"; ?>
<div class="col-lg-4" id="tablefav2">
    <div class="card">
	
		<div class="card-body p-4 d-flex align-items-center gap-3">
			<div class="bg-<?=$t0204->T01_ICON_COLOUR?>-subtle rounded-circle round-40 me-3 p-6 d-flex align-items-center justify-content-center">
			<iconify-icon icon="<?=$t0204->T01_ICON?>" class="text-<?=$t0204->T01_ICON_COLOUR?> fs-8"></iconify-icon>
			</div>                 
			<div>
			<a href="http://localhost/<?=$t0204->T02_URL?>">
			<h5 class="fw-semibold mb-0"><?=$t0204->T02_SHORTNAME?></h5>
			</a>
			<span class="fs-2 d-flex align-items-center"><?=$t0204->T02_KETERANGAN?></span>
			</div>
			<span class="text-warning fs-8 ms-auto">
				<a class="card-body p-2 d-flex align-items-center align-items-right gap-3"  id="love_<?=$t0204->T02_ID?>" href="javascript:save_fav('<?=$c?>','<?=$data->IDSTAF?>','<?=$t0204->T02_ID?>')" >
				<iconify-icon icon="<?=$c?>" class="fs-8 text-warning py-1 px-2 ms-auto" ></iconify-icon>
				</a>
			</span>
		</div>	
		
    </div>
</div>
<?php  } } ?>



