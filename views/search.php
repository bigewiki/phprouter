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
		if(isset($options[1]) && !empty($options[1])){
			echo "Searching for $options[1]...";
			echo "<table>";
			echo "<tr><th>book_id</th><th>title</th><th>isbn</th><th>isbn13</th><th>pubyear</th><th>pubname</th></tr>";
			foreach ($SqlProcs->byTitle($options[1]) as $res) {
				echo '<tr>';
				echo '<td>' . $res['book_id'] . '</td>';
				echo '<td><a href="../bookinfo/' . $res['book_id'] . '">'. $res['title'] . '</a></td>';
				echo '<td>' . $res['isbn'] . '</td>';
				echo '<td>' . $res['isbn13'] . '</td>';
				echo '<td>' . $res['pubyear'] . '</td>';
				echo '<td>' . $res['pubname'] . '</td>';
				echo "<tr/>";				
			}
			echo "</table>";
		} else {
			// trailing forward slashes create trouble
			if(substr($_SERVER['REQUEST_URI'], -1) == "/"){
				header("Location: ../".$options[0]);
			} else {
				?>
				<form action="./" method="POST">
					<input type="text" name="search"/>
					<input type="hidden" name="parent-search" value="<?php echo $options[0] ?>"/>
					<input type="submit" name="submit"/>
				</form>
				<?php
			}
		}
	} elseif ($options[0] == "bookinfo") {
		if(isset($options[1]) && !empty($options[1]) && is_numeric($options[1])){
			$bookInfo = $SqlProcs->bookById(intval($options[1]));
			echo "Book info for book id $options[1]...";
			echo "<table>";
			echo "<tr><td>Book Id</td><td>" . $bookInfo['book_id'] . "</td></tr>";
			echo "<tr><td>Title</td><td>" . $bookInfo['title'] . "</td></tr>";
			echo "<tr><td>ISBN</td><td>" . $bookInfo['isbn'] . "</td></tr>";
			echo "<tr><td>ISBN13</td><td>" . $bookInfo['isbn13'] . "</td></tr>";
			echo "<tr><td>Year Published</td><td>" . $bookInfo['pubyear'] . "</td></tr>";
			echo "<tr><td>Publisher Name</td><td>" . $bookInfo['pubname'] . "</td></tr>";
			echo "</table>";
			echo "<br/><br/>";
			// author info
			echo "<table>";
			echo "<tr><th>author_id</th><th>firstname</th><th>lastname</th><th>authorder</th></tr>";
			foreach ($SqlProcs->authorsById(intval($options[1])) as $res) {
				echo '<tr>';
				echo '<td>' . $res['author_id'] . '</td>';
				echo '<td>' . $res['firstname'] . '</td>';
				echo '<td>' . $res['lastname'] . '</td>';
				echo '<td>' . $res['authorder'] . '</td>';
				echo "<tr/>";				
			}
			echo "</table>";
		} else if (!isset($options[1]) || empty($options[1])){
			if(substr($_SERVER['REQUEST_URI'], -1) == "/"){
				header("Location: ../bookinfo");
			} else {
				?>
				<p>Search by book Id</p>
				<form action="./" method="POST">
					<input type="number" value="82" name="search"/>
					<input type="hidden" name="parent-search" value="<?php echo $options[0] ?>"/>
					<input type="submit" name="submit"/>
				</form>
				<?php
			}
		} else {
			echo "Book Info search must be by numeric id";
		}
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

<style>
	table {
	margin-bottom: 20px;
	}

	table td, table th {
	border: 1px solid black;
	padding: 5px 5px 5px 10px;
	}
</style>