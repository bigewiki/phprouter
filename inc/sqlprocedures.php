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
            while($row = $query->fetch()){
                // $res[] = $row;
                $res[] = array(
                    'book_id' => $book_id,
                    'title' => $title,
                    'isbn' => $isbn,
                    'isbn13' => $isbn13,
                    'pubyear' => $pubyear,
                    'pubname' => $pubname
                );
            }
            return $res;
        } else {
            return 'no results';
        }
    }

    public function authorsById(int $bookId) {
        $query = $this->prepare("CALL getauthorsbybookid(?)");
        $query->bind_param('i',$bookId);
        $query->execute();
        $query->bind_result($author_id, $lastname, $firstname, $authorder);
        if($query->fetch()){
            while($row = $query->fetch()){
                // $res[] = $row;
                $res[] = array(
                    'author_id' => $author_id,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'authorder' => $authorder
                );
            }
            return $res;
        } else {
            return 'no results';
        }
        $query->close();
    }

    public function bookById(int $bookId) {
        $query = $this->prepare("CALL getBookById(?)");
        $query->bind_param('i',$bookId);
        $query->execute();
        $query->bind_result($book_id, $title, $isbn, $isbn13, $pubyear, $pubname);
        if($query->fetch()){
            return array(
                'book_id' => $book_id,
                'title' => $title,
                'isbn' => $isbn,
                'isbn13' => $isbn13,
                'pubyear' => $pubyear,
                'pubname' => $pubname
            );
        } else {
            return 'no result';
        }
        $query->close();
    }
    
}

$SqlProcs = new SqlProcs($servername, $username, $password, $dbname);
if ($SqlProcs->connect_error) {
    die("Connection failed: " . $SqlProcs->connect_error);
}