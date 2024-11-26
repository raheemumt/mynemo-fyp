<?php //echo "sini".$platform->T02_PLATFORM.$g_url->T02_URL;
$http =  (isset($_SERVER["REQUEST_SCHEME"] ) && $_SERVER["REQUEST_SCHEME"]=='https') ? 'https':'http';
?>
<div style="display: flex; justify-content: center;">
<?php
//echo "sini".$_SESSION['tokenx'];

if ($platform->T02_PLATFORM=='8'){ ?>
<iframe class="embed-responsive-item" src="/<?=$g_url->T02_URL;?>" title="Iframe Example" scrolling="yes" style="height: 800px; min-width:100%;margin-bottom: 75px;" width="100%" height="100%" frameborder="0"></iframe>
<?php
} else {
	//echo "sini".$g_url->T02_URL;
?>
<iframe class="embed-responsive-item" src="<?=$http?>://mynemov31.umt.edu.my/<?=$g_url->T02_URL;?>" title="Iframe Example" style="height: 800px; min-width:100%;margin-bottom: 75px;" frameborder="0" scrolling="yes"></iframe>
<?php } ?>
</div>