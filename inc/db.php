
<?php
 $db = mysqli_connect("localhost","root","","ssb280-project");
 if ($db) {
 	//echo "database connected ";
 }
 else{
 	die("database not connected ".mysqli_error($db));
 }



?>