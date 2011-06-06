<?php
	
	
/*
 * Author : K.Manjunath
 * 
 * @desc: For making the Database Transactions DAO class for the my_admin table
 * 
 * 1. Save the admin details in the my_admin table.
 * 2. Getting the admin details from the my_admin table.
 * 
 * 
 */	
include_once 'dbConnection.php';

class MyAdminDAO extends DbConnection {
 	
 	/**
      * getting datbase connection object
	  */ 	
	 	function __construct(){
				parent::__construct();
		}
		
   /**
	 * @author K.Manjunath
	 * 
	 * 
	 * @desc return the Admin details from the my_admin table
	 */
	function getAdmin($username,$password)
	{
		try
		{
			$sqlStmt1="SELECT count(*) as total  from ".TBL_ADMIN ;
			
			$sqlStmt1.=" where username = '".$username."' and password = '".$password."'";
											
			return parent::select($sqlStmt1);
		}
		catch ( Exception $e )
		{
			error_log('Function: getAdmin -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	
} 





?>