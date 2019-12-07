<?php
declare(strict_types=1);
include_once '/home/stu/superuser/blurg.inc.php';
$servername = 'localhost';
$username = 'superuser';
$dbname = 'STUsuperuser';

class SqlProcs extends mysqli{

    public function byTitle(string $title) {
        $title = $this->real_escape_string(trim($title));
        $query = $this->prepare("CALL getBookByTitle(?)");
        $query->bind_param('s',$title);
        $query->execute();
        $query->bind_result($book_id, $title, $isbn, $isbn13, $pubyear, $pubname);
        if($query->fetch()){
            while($row = $query->fetch_assoc()){
                $res[] = $row;
            }
            return $res;
        } else {
            return 'no results';
        }
    }

}

$SqlProcs = new SqlProcs($servername, $username, $password, $dbname);
if ($Api->connect_error) {
    die("Connection failed: " . $Api->connect_error);
}