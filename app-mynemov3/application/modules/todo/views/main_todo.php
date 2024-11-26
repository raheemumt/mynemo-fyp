  
    <div id="stage" class="stage">
	<?php 
	  if( isset($_SESSION["todo"]) )
	  {
		  echo $_SESSION["todo"];
	  } else {
  	?>
		<span id="load1" class="load1"></span>
<?php } ?>
    </div>


 


