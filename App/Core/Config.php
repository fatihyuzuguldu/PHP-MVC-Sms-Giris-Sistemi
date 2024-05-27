<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
	define('DBNAME', 'betayonetim');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost/betayonetim');

}else
{
	/** database config **/
	define('DBNAME', 'my_db');
	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');

}

define('APP_NAME', "Beta Yönetim Paneli");
define('APP_DESC', "Yönetim Paneli ile işlerinizi kolaylaştırın.");

/** true means show errors **/
define('DEBUG', true);
