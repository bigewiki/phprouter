<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){
    header('Location: /superuser/phprouter');
}

    // get a password hash
    // $cleanPass = 'mypassword';
    // $options = [ 'cost' => 16 ];
    // $hashpw = password_hash($cleanPass, PASSWORD_DEFAULT, $options);
    // echo "<h2>Hash of password: <br /> $hashpw</h2>";
    
    // here a cheap way to set a password in the db, 
    // update grcustomers set hashpw = 'PASSWORDHASH' WHERE email = 'test@mydomain.com';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Basic HTML 5</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="dcterms.rightsHolder" content="Name of Copyright Holder" />
<meta name="dcterms.dateCopyrighted" content="2012" />
<meta name="description" content="A short description of the page" />
<meta name="keywords" content="keywords describing this page, most search engines
ignore this now due to abuse"/>
</head>
<body>

<form method="POST" action="proclogin">
<label for="userid">User Name:</label>
<input type="text" name="username" id="userid" /><br />
<label for ="password">Password:</label>
<input type="password" name="loginpass" id="password" /><br />
<input type="submit" name="submitted" value="LOGIN!!" />

</form>



</body>
</html>
