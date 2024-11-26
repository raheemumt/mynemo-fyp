<?php
ini_set('display_errors',1);
 ini_set('display_startup_errors',1);
 error_reporting(-1);

?>
<!--<script src="<?=base_url()?>assets/js/jquery.min.js"></script>-->
<script>
var biltodo = 7;
var isnotify = false;
	
function hideloader( loaded = false )
{	
	biltodo--;
	
	if(biltodo==1 || loaded )
	{
    console.log("done");
		$('#todoloader').hide(); //hide loader
		$('#todopanel').fadeIn("slow"); //show todo icon
		//$('#todopanel').show();
		if (isnotify==true) 
		{
			//$('.notify').show(); 
			$('#todopanel').fadeIn("slow");
			$('#tododummy').hide();
		} 
		else
		{
			$('#tododummy').show();
			$('#todopanel').hide();
		}
		
		
	}
	else 
	{
		console.log("still load "+biltodo);
	}
}
	
$( document ).ready(function(){
	<?php 
  if( !isset($_SESSION["todo"]) )
  {
  ?>
	
	for (i=1;i<=8;i++) {
		//dummy++;
		 //console.log("done="+i+" | "+dummy);
	  $.ajax({
			url: '<?=base_url()?>todo/todogen/<?php echo $_SESSION['icno']?>',
					type: 'post',
			data: { tab: i } ,
			dataType: 'json',
			success: function(data)
		   {
			  if(data.display == 'E') {
          			$('#stage').append('error no valid session');
			  } else 
			  { 
			    $('.stage').append(data.todo);
				console.log("done="+isnotify);
				if (!isnotify) 
				{ 
						if (data.display == 'Y') isnotify = true; 
				}
			  }			  
        		$('#load1').hide();
				hideloader();
			},
			error: function (xhr, ajaxOptions, thrownError) {
			  var errorMsg = 'Ajax request failed: ' + xhr.responseText;
				$('#stage').html(errorMsg);
			}
    });
		
	}
	
	
	<?php 
	 
  }
  /*else
  {
  ?>
  $.ajax({
    url: '<?=base_url()?>todo/getTodoFromSession/<?php echo $_SESSION['icno']?>',
    type: 'post',
    dataType: 'json',
    success: function(data){
      $( '.stage' ).html( "" );
      
      if(data.display == 'E') 
        $('.stage').append('error no valid session');
      else 
        $('.stage').append(data.todo);
      
      $('.load1').hide();
      hideloader( true );
    },
    error: function (xhr, ajaxOptions, thrownError) {
      var errorMsg = 'Ajax request failed: ' + xhr.responseText;
      $('#stage').html(errorMsg);
    }
  });
  <?php
  }*/
  ?>
});

  

   </script>




 


