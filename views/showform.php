<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){
    header('Location: /superuser/phprouter');
}
?>

<form method="get" action="procform" >
<label for="fullname">Name: </label>
<input type="text" name="fullname" id="fullname" />
<br />
<input type="submit" name="submitted" value="Test Form Get" />
</form>
