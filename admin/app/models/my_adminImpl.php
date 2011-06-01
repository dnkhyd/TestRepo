<?php


	include_once 'DAO/my_adminDAO.php';
	include_once 'beans/my_adminVO.php';
		
	/*
	 * Author K.Manjunath
	 * 
	 * @desc Implementation class for the my_adminDAO. 
	 * 
	 */

	class MyAdminImpl {
		
		private $adminDao	=	null;
		private $adminVo   =   null;
		
		function __construct()
		{
			$this->adminDao 	=	new MyAdminDAO();
			$this->adminVo		= 	new MyAdminVO();
		}
		
		
	   /**
		 * @author  K.Manjunath
		 * @desc return Admin Data
		 * @return username and password
		 */
		
		function getImagesData ($username,$password){
			
			$admin  = $this->adminDao->getAdmin($username,$password);
			
			return $admin[0]['total'];
		}
	}

?>