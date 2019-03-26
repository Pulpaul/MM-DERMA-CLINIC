<?php 
	$str = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM123456789!@#$%^&*()_+';
	$str = str_shuffle($str);
	echo substr($str, 0 , 10); 

?>