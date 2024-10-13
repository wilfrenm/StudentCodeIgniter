<?php
namespace App\Controllers;
	class ValidationController extends BaseController{
		
		// function __construct($conn){
		// 	include_once("model/modelstudent.php");
		// 	$this->stud_mod_object=new ModelStudent($conn);
		// 	include_once("model/loginvalidate.php");
		// 	$this->login_mod_object=new ModelLoginValidate($conn);
		// }
		
		function loginvalidate(){
			$modobj=model('LoginValidate');
			$resultset=json_decode(json_encode($modobj->datacheck($_POST)),1);#Object to array conversion
			if(!empty($resultset)){
				if($resultset[0]['user_type']=="admin"){
					$_SESSION['user']="admin";	
					$_SESSION['name']=strstr($resultset[0]['email'],"@",true);
					return redirect()->to('http://localhost/Student/studentapp/public/student/adminview');
				}
				else{
					$_SESSION['user']="student";	
					$_SESSION['name']=strstr($resultset[0]['email'],"@",true);
					// redirect('/')
					$url="location:index.php?mod=student&view=studentview&id=".$resultset[0]['user_id'];
					// header("$url");
					return redirect()->to('http://localhost/Student/studentapp/public/student/studentview');
				}
			}
			else{
				return redirect()->to('http://localhost/Student/studentapp/public/student/login');
				// header("location:index.php");
			}
		}
		
		function logout(){
			session_unset();
			session_destroy();
			// header("location:index.php");
		}
		
		
	}




?>