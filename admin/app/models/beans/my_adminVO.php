<?php
	
   /**
	 * @author K.Manjunath
	 * 
	 * @desc  Created this bean class for storing admin details.
	 * 
     */

	class MyAdminVO {

		private $id;       	        //admin user Id.
		private $username;       	//admin user name.
		private $password;			//admin password.
		
	/**
	  * Setter and Getter method for the $id variable; 
	  * 
	  */
		public function setId($id){
			$this->id=$id;
		}
		public function getId(){
			return $this->id;
		}	
		
	/**
	  * Setter and Getter method for the $password variable; 
	  * 
	  */
		public function setPassword($password){
			$this->password=$password;
		}
		public function getPassword(){
			return $this->password;
		}
		
	/**
	  * Setter and Getter method for the $username variable; 
	  * 
	  */
		public function setUserName($username){
			$this->username=$username;
		}
		public function getUserName(){
			return $this->username;
		}
	}


?>