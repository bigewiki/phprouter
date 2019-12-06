<?php
declare(strict_types=1);
function procnewuser()
{
	include_once '../../blurg.inc';
	include_once 'inc/passwordfuncs.inc.php';
	#include_once 'emailcheck.inc.php';
	//ARE YOU INSANE!?!?! FILTER THIS FIRST!!!
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$q1 = $_POST['question1'];
	$a1 = $_POST['answer1'];
	$q2 = $_POST['question2'];
	$a2 = $_POST['answer2'];
	
	echo "Name: $lname , $fname <br />";
	echo "Email: $email<br />";
	echo "Password1:  $password1<br />";
	echo "Password2:  $password2<br />";
	echo "Question1: $q1 Answer: $a1 <br />";
	echo "Question2: $q2 Answer: $a2 <br />";

	/************
		1. hash the password
		2. date user added
		3. create random "verifycode"
		4. set default status
		5. Connect to DB
		6. query to see if user already exists (QUERY email)
		7. if user exists, kick them to the login page
		8. if user does not exist, insert them (QUERY INSERT)
			a. after user inserted, create URL
			b. email validation URL to user
	*************/
	$verifycode = rand_string(30);
	echo $verifycode . "<br />";
	$hashedpw = hashit($password1);
	echo $hashedpw . "<br />";
	if (checkhash($password1,$hashedpw))
	{
		echo "Password matches hash<br />";
	}
	else
	{
		echo "Wrong password dummy";
	}
	//basic user level status, note if unverified, this is ignored
	$status = "general";
	$verified = "pending";
	
	//include '../../blurg.inc';
		//NOTE: if you call the $password1 above $password, your script is dead
	$db1 = new mysqli('localhost', 'coperni', $password, 'STUcoperni');

	if($db1->connect_errno > 0)
	{
		die('Unable to connect to database [' . $db1->connect_error . ']');
	}

	$query1 = $db1->prepare("select email from grcustomers where email = ?");
	$query1->bind_param('s',$email);

	$query1->execute();
	$query1->store_result();
	$userexists = $query1->num_rows;
	$query1->free_result();
	if ($userexists != 0 )
	{
		echo "User already exists<br />";
		die ('Should reload the newuser form  here instead of killing the program');
	}
	else
	{
		//Insert user
		if (! $query2 = $db1->prepare("INSERT INTO grcustomers (fname,lname,email,hashpw,status,dateadded,verifycode,verifystatus,question1,answer1,question2,answer2) VALUES (?,?,?,?,?,NOW(),?,?,?,?,?,?)"))
		{
			die('Query 2 prepare() failed: [' . $db1->connect_error . ']');	
		}
		$query2->bind_param('sssssssssss',$fname,$lname,$email,$hashedpw,$status,$verifycode,$verified,$q1,$a1,$q2,$a2);
		$query2->execute();
		
	}	
	$query2->free_result();
	$db1->close();
	
	$verifyurl = 'https://' . $_SERVER[SERVER_NAME] . $_SERVER[SCRIPT_NAME] . "?command=verifyuser&submitted=yes&verifycode=$verifycode";
	echo "<br /> $verifyurl";
	$recipientname = $fname .' '.$lname;
	$senderemail = 'coperni@lampbusters.com';
	$sendername = 'Coperni Admin';
	$subject = 'Verify your new account with Coperni';
	//sendverifyemail($senderemail,$sendername, $email,$recipientname, $verifyurl,$subject);
}

procnewuser();
?>
