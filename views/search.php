<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){
    header('Location: /superuser/phprouter');
}
// pull in sqlProcedures
require_once('/home/stu/superuser/public_html/phprouter/inc/sqlprocedures.php');
echo "<h1>Search Page</h1>";
$options = explode('/',$pathvars);
// if not already validated should be 
if($_SESSION['loggedIn'] === true){
	if ($options[0] == "byauthor") {
		echo "Do search by author stuff";
	} elseif ($options[0] == "bytitle") {
		if(isset($options[1])){
			foreach ($SqlProcs->byTitle($options[1]) as $arr) {
				echo "<table>";
				foreach ($arr as $key => $value) {
					echo "<tr>";
					echo "<td>$key</td><td>$value<td>";
					echo "<tr/>";
				}
				echo "</table>";
			}
		} else {
			echo 'please define your search';
		}
	} elseif ($options[0] == "bookinfo") {

	} elseif ($options[0] == "byyear") {
		echo "Do search by year";
	} elseif ($options[0] == "byisbn") {
		echo "search by isbn";
	} else {
		echo "that is a not a valid search option";
	}
} else {
	echo 'you must be logged in';
}


// close the connection
$SqlProcs->close();
?>