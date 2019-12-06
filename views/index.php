<?php
declare(strict_types=1);
if(!defined('Canary'))
{
    header('Location: /superuser/phprouter');
}
?>

<html>
<head>
<title> Main Page of PHP Router Site</title>
<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
<body>
<h1>Main Page</h1>

<ul>
<li><a href="login">Login </a></li>
<li><a href="about">About Me</a></li>
<li><a href="showform">Show GET form</a></li>
<li><a href="createuser">Create A new user</a></li>
<li><a href="search">Search</a></li>
<li><a href="search/byauthor">Search by Author</a></li>
<li><a href="search/bytitle">Search by Title</a></li>
<li><a href="search/byisbn">Search By Isbn</a></li>
</ul>

</body>
</html>
