<?php 
if (!defined('CONNDB')) {
	define('CONNDB', true);
    

	$db="(DESCRIPTION =
		(ADDRESS_LIST =
		  (ADDRESS = (PROTOCOL = TCP)(HOST = db-oracle)(PORT = 1521))
		)
		(CONNECT_DATA =
		  (SID = XE ) 
		)
	  )";



			$conn = oci_pconnect("up_portal","mypassword",$db); 

	if (! $conn) {
				// connection failed
				// as we don't have a connection yet the error is stored in the
				// module global error-handle
				$err = OCIError();

				if ($err[ "code" ] == "12545") {
					echo "target host or object does not exist\n";
				}
				die();

	} 
	else
	{
		echo "<br>connected to Oracle => ".$conn;
	}
}
//$_SESSION['SESS_CONN']=$conn;



