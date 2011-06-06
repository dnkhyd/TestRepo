<?php
	session_start();
	ob_start();
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: public");
	header("Expires: 0");
	 
	
  
	include_once 'app/models/my_adminImpl.php';
	include 'config/constants.php';

	class IndexController{
		
		private $myadmin = null;
		var $fail = null;
		function __construct()
		{
			$action		    = 	!empty($_POST['hdnAction'])?$_POST['hdnAction']:'';
			
			$this->myadmin	=	 new MyAdminImpl();		
			switch ($action)
			{
				case 'login'	 :	self::getImagesData();
									break;
				case 'logout'	 :	self::displayLoginPage();
									break;									
				default		 	:	self::displayLoginPage();
									break;
			}
		}
		function getImagesData(){

			$username			= 	isset($_POST["txtUserName"])?$_POST["txtUserName"]:'';
			$password			=	isset($_POST["txtPassWord"])?$_POST["txtPassWord"]:'';
			$count = $this->myadmin->getImagesData($username,$password);
			if($count>0){

				$_SESSION['user'] = $username;
				include_once 'app/views/helper/header.php';
			 	include_once 'app/views/helper/footer.php';
			}else{

				$this->fail = 1;
			 	$this->displayLoginPage();
			}
		}
		function displayLoginPage(){
			ob_clean();
			session_unset();
			session_destroy();
			if($_SESSION['user']){
				unset($_SESSION['user']);
				session_destroy();
			}
			$Login = $this->fail;
			include_once 'app/views/login.php';	
		}	
	}
	$index = new IndexController();

?>