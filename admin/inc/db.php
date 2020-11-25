<?php
	
	$db = mysqli_connect("localhost", "root", "", "ssb-280");

	if ( $db ){
		//echo "Database Connected";
	}
	else {
		die("MySQL Connection Faild." . mysqli_error($db));
	}

?>