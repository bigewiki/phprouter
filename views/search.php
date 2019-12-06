<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /coperni/phprouter');
}
echo "<h1>Search Page</h1>";
$options = explode('/',$pathvars);
# if not already validated should be 
print_r($options);
if ($options[1] == "byauthor")
{
	echo "Do search by author stuff";
}
elseif ($options[1] == "bytitle")
{
	echo "Do search by title";
}
elseif ($options[1] == "byyear")
{
	echo "Do search by year";
}
elseif ($options[1] == "byisbn")
{
	echo "search by isbn";
}
else
{
	echo "that is a not a valid search option";
}
?>