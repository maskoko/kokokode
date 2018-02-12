<?php 
	/** 
	* Configuration

	* @package SIM P4TK BMTI
	* @author a2ngsa
	* @copyright 2012
	* @version Id: config.ini.php, v1.00 2011-04-20 10:12:05 gewa Exp $
	*/
 
	 if (!defined("_VALID_PHP")) 
     die('Direct access to this location is not allowed.');
 
	/** 
	* Database Constants - these constants refer to 
	* the database configuration settings. 
	*/
	 define('DB_SERVER', 'localhost'); 
	 define('DB_USER', 'root'); 
	 define('DB_PASS', ''); 
	 define('DB_DATABASE', 'c1simdiklat');
 
	/** 
	* Show MySql Errors. 
	* Not recomended for live site. true/false 
	*/
	 define('DEBUG', false);
?>