<?php
/*** db connection strat ***/
	$con = mysql_connect("mysql50-56.wc2.dfw1.stabletransit.com","488180_blog","mykera1A");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("488180_blog", $con);
	/*** db connection end ***/


		/*** check for email validity ***/
echo		$sql = "CREATE TABLE mkh_authenticate (ID BIGINT(20) NOT NULL AUTO_INCREMENT,email VARCHAR(100) NOT NULL, token VARCHAR(100) NOT NULL, fname VARCHAR(100) NOT NULL, lname VARCHAR(100) NOT NULL, nicename VARCHAR(200) DEFAULT NULL, gender VARCHAR(10) NOT NULL, profile_lnk VARCHAR(200) DEFAULT NULL, locale VARCHAR(100) DEFAULT NULL, location VARCHAR(100) DEFAULT NULL, state VARCHAR(100) DEFAULT NULL, identifier VARCHAR(10) NOT NULL, ag_id VARCHAR(100) NOT NULL DEFAULT 0, TIMESTAMP DATETIME NOT NULL,STATUS TINYINT(10) NOT NULL DEFAULT 0,PRIMARY KEY (email,identifier),UNIQUE KEY ID (ID)) ENGINE=MYISAM DEFAULT CHARSET=latin1 ";
		$result = mysql_query($sql,$con);
echo "Hello";
print_r($result);

?>