<?php
declare(strict_types=1);
function rand_string( int $length ): string 
{
	//note, if using this for an url, # ? & and ; are invalid characters
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789$@!*^';  
	$size = strlen( $chars );
	$str="";
	for( $i = 0; $i < $length; $i++ ) 
	{
		$str .= $chars[ mt_rand( 0, $size - 1 ) ];
	}
	return $str;
}

function hashit(string $password, int $cost = 12): string
{
	$options['cost'] = $cost;
	$hashpw = password_hash($password, PASSWORD_DEFAULT, $options);
	return $hashpw;
}

function checkhash(string $password, string $hashedpassword): bool
{
	return password_verify($password, $hashedpassword);
}
?>