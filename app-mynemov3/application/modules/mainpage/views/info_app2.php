<script>
$(document).ready(function(){
$('.nav-tabs li').on('click', function(event) {
    $('.nav-tabs li').removeClass('active'); // remove active class from tabs
    $(this).addClass('active'); // add active class to clicked tab
    $('.tab-content div').hide(); // hide all tab content
    $('#' + $(this).data('id')).show(); // show the tab content with matching id
});
});
</script>
<?php
$maintajuk ="";
$subtajuk ="";
$page="";
$i = 1;
$j=0;
foreach ($sent07->result() as $sent07){
$gt08=$this->t02m->get_t08($i);
if ($j==0) $aktif = "active"; else $aktif="";
	$maintajuk.="<li class='nav-item'>
					<a class='nav-link  $j id='custom-content-below-home-tab' data-toggle='tab' href='#$sent07->T07_ID' role='tab' aria-controls='custom-content-below-home' aria-selected='false'>$sent07->T07_PERIHAL</a>
				</li>";
	 //else $aktif = "";
	$subtajuk.="<div class='tab-pane active' id='$sent07->T07_ID' role='tabpanel' aria-labelledby='custom-content-below-profile-tab'>";			
	foreach ($gt08->result() as $gt08){
	$gt09=$this->t02m->get_t09($gt08->T08_ID);
	//if (($page=="")|| ($page=='1')) $aktif = "active";
	//$subtajuk.="<div class='tab-pane' id='$i' role='tabpanel' aria-labelledby='custom-content-below-profile-tab'>
	$subtajuk.="<dl class='dl-horizontal'><dt>$gt08->T08_KETERANGAN<dt>";
	$subtajuk.="<dd>";
		foreach ($gt09->result() as $gt09){
		$subtajuk.="<a href='$gt09->T09_LINK' target='_blank'>$gt09->T09_TAJUKLINK</a>&nbsp;&nbsp";
		}
	$subtajuk.="</dd></dl>";
	
	}
	$subtajuk.="</div>";
	$i++;
	$j++;
}
?>
<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">

<?=$maintajuk?>
</ul>
<br>
<div class="tab-content" id="custom-content-below-tabContent">
<?=$subtajuk?>

</div>