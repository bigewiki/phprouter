<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){
    header('Location: /superuser/phprouter');
}

//If the user is not logged in at all, redirect them to the login
if(!$_SESSION['loggedIn']){
    header('Location: /superuser/phprouter/login');
}
//If the user is logged in, but is not admin, give a warning response


?>