<?php  
	@$host = 'localhost';
	@$us = 'root';
	@$ps = '';
	@$db = 'koperasi';

	mysql_connect($host,$us,$ps);
	mysql_select_db($db);
?>