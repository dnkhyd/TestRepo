<?php
/**
 * @author rajasekhar
 * @desc Handles database actions
 * 1. Inserting data to database
 * 2. Updating the data
 * 3. Deleteing (updating the flags) the data
 * 4. Selecting the data based on quesries
 */
include_once $_SERVER['DOCUMENT_ROOT']."/admin/config/dbConfig.php";

class DbConnection
{
	private $dbcon	=	null;
	/**
	 * @author rajasekhar
	 * @desc creating the database connection
	 */
	function __construct()
	{
		try
		{
			$this->dbcon = new PDO("mysql:host=".HOST_NAME.";dbname=".DB_NAME."", USERNAME, PASSWORD);
			$this->dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch ( Exception $e )
		{
			error_log('Function: DbConnection -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}
	/**
	 * @author rajaskehar
	 * @param $sql
	 * @desc execute the insert statement
	 * @return last inserted id
	 */
	function insert($sql)
	{
		try
		{			
			$noOfRowsAffected = $this->dbcon->exec($sql);
			$insertedId = $this->dbcon->lastInsertId();
		}
		catch ( Exception $e )
		{
			error_log('Function: insert -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
		return $insertedId;
	}

	/**
	 * @author rajaskehar
	 * @param $sql
	 * @desc execute the delete statement( we are doing only updates- no direct delete will work)
	 * @return number of rows effected
	 */
	function delete($sql)
	{
		try
		{
			return $abc=$this->dbcon->exec($sql);
		}
		catch ( Exception $e )
		{
			error_log('Function: delete -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}

	/**
	 * @author rajaskehar
	 * @param $sql
	 * @desc update the records
	 * @return number of rows effected
	 */
	function update($sql)
	{
		try
		{
			return $noOfRowsAffected = $this->dbcon->exec($sql) ;

		}
		catch ( Exception $e )
		{
			error_log('Function: update -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			echo 0;
		}
	}

	/**
	 * @author rajaskehar
	 * @param $sql
	 * @desc execue the select command
	 * @return returns the record set
	 */
	function select($sqlcmd)
	{
		$rs = Array();
		try
		{
			$r = $this->dbcon->query($sqlcmd);
			if ($r != null)
			{
				while($row = $r->fetch(PDO::FETCH_ASSOC))
				{
					$rs[]=$row;
				}
			}
		}
		catch(Exception $e)
		{
			error_log('Function: select -- Error #' . $e->getCode() . ': ' . $e->getMessage() . "\n" . ' on Line: ' . $e->getLine() . ' in File: ' . $e->getFile() . ' being Requested by: ' . $_SERVER[ 'REQUEST_URI' ] );
			unset($rs);
		}
		return $rs;
	}
}
?>