<?php
declare(strict_types=1);
if(!defined('Canary'))
{
    header('Location: /superuser/phprouter');
}
?>


<h1>Main Page</h1>

<ul>
<li><a href="login">Login </a></li>
<li><a href="useradmin">User Admin</a></li>
<li><a href="about">About Me</a></li>
<li><a href="showform">Show GET form</a></li>
<li><a href="createuser">Create A new user</a></li>
<li><a href="search">Search</a></li>
<li><a href="search/byauthor">Search by Author</a></li>
<li><a href="search/bytitle">Search by Title</a></li>
<li><a href="search/byisbn">Search By Isbn</a></li>
</ul>

