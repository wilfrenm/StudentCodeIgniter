<?php
	
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for controlling data from model and view
	 */
	namespace App\Controllers;
	class StudentController extends BaseController{
		public $studentmodelobject;
		#Controller class for redirecting and performing bussiness logics
		#Constructor creates object for model and starts the session
		function __construct(){
			$this->studentmodelobject=model('ModelStudent');
		}

		public function loginpage(){
			return view("studentlogin.php");
		}

		function studentlist(){
			#if admin is the user then showing all student's data 
			// if($this->sessioncheck()=="admin"){
				// $pageno=$_GET['pgno'];
				// $start=($_GET['pgno']*2)-2;
				// $previous=$start-2;
				// if(!empty($_GET['filterdata_available']))
				// 	$_SESSION['filterQuery']=$_POST;
				// if(empty($_GET['filter']))
				// 	$_SESSION['filterQuery']="";
				
				
				$resultset=$this->studentmodelobject->studentlist(null,null);
				$resultset=json_decode(json_encode($resultset),1);
				foreach($resultset as $key=>$value){
					$data["key$key"]=$value;
				}
				$arr['result']=$data;
				// print_r($arr);
				// var_dump($data);
				return view("viewstudentlist.php",$arr);
			// }
		}
		
		function studentdelete($id){
			
			echo $id;
			$this->studentmodelobject->studentdatadelete($id);
			return redirect()->to('http://localhost/Student/studentapp/public/student/adminview');
			// print_r($user);
			// 	#Checking if  the user is  set or not for only access to admin
			// 	if($this->sessioncheck()=="admin"){
			// 		//Once delete button clicked id of the particular user is send via url
					// $result=$this->studentmodelobject->
			// 		header("location:index.php?mod=student&view=studentlist&pgno=1");
			// 	}
			}
		
		
		function studentadd(){
			return view("viewstudentinsert.php");
		}

		#This function is used to insert values to database
		function studentinsert(){
			//This if condition is for checking whether the user is admin or not
			// if($this->sessioncheck()=="admin"){
				#In form to  differenciate after submitting operation in url used
				// if(!isset($_GET["operation"]))
					// include_once("view/viewstudentinsert.php");
				#If operation is set pass the value to model
				// else{
				// echo "Entered";die;
					$postdata=$this->request->getPost();
					print_r($postdata);
					#Checking if the global variable file have data or not
					if(!empty($_FILES)){
						$imgpath="../app/Views/Images/".$_FILES['photo_location']['name'];
						move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
						$postdata["photo_location"]=$imgpath;
					}
					#now send the data to model and insert into database table1
					$this->studentmodelobject->studentinsert_table1($postdata);
					#select the table data for getting the userid of last inserted data
					$user_id=json_decode(json_encode($this->studentmodelobject->lastinsertedstudent()),1);
					$this->studentmodelobject->studentinsert_table2($postdata,$user_id[0]['user_id']);
					// return redirect()->to('localhost/Student/studentapp/public/student/adminview');
					return redirect()->to('http://localhost/Student/studentapp/public/student/adminview');
					#After inserting list all the user
					// header("location:index.php?mod=student&view=studentlist&pgno=1");
				// }
			// }
		}
		function studentedit($id){
			#Checking if  the user is  set or not for only access to admin
			// if($this->sessioncheck()=="admin"){
				#data is fetched for the particular user
				$resultset=json_decode(json_encode($this->studentmodelobject->studentdatafetch($id)),1);
				return view('viewstudentedit',$resultset[0]);
			// }
		}

		function studentupdate($id){
			#Checking if  the user is  set or not for only access to admin
			// if($this->sessioncheck()=="admin"){
				$imgpath="";
				$data=$this->request->getPost();print_r($data);
				#if files uploaded then move to local system and save the path in database
				print_r($_FILES);
				if(!empty($_FILES['photo_location']['full_path'])){
					$imgpath="../app/Views/Images/".$_FILES['photo_location']['name'];
					move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
					$data['photo_location']=$imgpath;
				}
				else{
					unset($data['photo_location']);
				}
				
				#pass the imagepath,data array from post, and id of the user edited from url
				$result=$this->studentmodelobject->studentupdate($data,$id);
				if($result)echo"<script>alert('Updated successfully')</script>";
				return redirect()->to('http://localhost/Student/studentapp/public/student/adminview');
				// header("location:index.php?mod=student&view=studentlist&pgno=1");
			// }
			 
		}


		#This function is used to display specific details about the student
		function studentview($id){
			#Checking if the session for the variable is set or not
			// if($_SESSION['user']){
				#calling model to fetch data of the specific user
				$studentdata=json_decode(json_encode($this->studentmodelobject->studentdataview($id)),1);
				return view("studentview.php",['data'=>$studentdata]);
			// }
		}



		
		// function studentdelete(){
		// 	#Checking if  the user is  set or not for only access to admin
		// 	if($this->sessioncheck()=="admin"){
		// 		//Once delete button clicked id of the particular user is send via url
		// 		$result=$this->studentmodelobject->studentdatadelete($_GET['user_id']);
		// 		header("location:index.php?mod=student&view=studentlist&pgno=1");
		// 	}
		// }

		// function studentedit(){
		// 	#Checking if  the user is  set or not for only access to admin
		// 	if($this->sessioncheck()=="admin"){
		// 		#data is fetched for the particular user
		// 		$resultset=$this->studentmodelobject->studentdatafetch($_GET['id']);
		// 		include_once("view/viewstudentedit.php");
		// 	}
		// }


		// function studentupdate(){
		// 	#Checking if  the user is  set or not for only access to admin
		// 	if($this->sessioncheck()=="admin"){
		// 		$imgpath="";
		// 		#if files uploaded then move to local system and save the path in database
		// 		print_r($_FILES);
		// 		if(!empty($_FILES['photo_location']['full_path'])){
		// 			$imgpath="view/images/".$_FILES['photo_location']['name'];
		// 			move_uploaded_file($_FILES['photo_location']['tmp_name'],$imgpath);
		// 			$_POST['photo_location']=$imgpath;
		// 		}
		// 		else{
		// 			unset($_POST['photo_location']);
		// 		}
		// 		$data=$_POST;
		// 		#pass the imagepath,data array from post, and id of the user edited from url
		// 		$result=$this->studentmodelobject->studentupdate($data,$_GET['id']);
		// 		if($result)echo"<script>alert('Updated successfully')</script>";
		// 		header("location:index.php?mod=student&view=studentlist&pgno=1");
		// 	}
			 
		// }

		// #This function is used to display specific details about the student
		// function studentview($resultset){
		// 	#Checking if the session for the variable is set or not
		// 	if($_SESSION['user']){
		// 		#calling model to fetch data of the specific user
		// 		$studentdata=$this->studentmodelobject->studentdataview($resultset['id']);
		// 		if(!empty($studentdata))
		// 			include_once("view/studentview.php");
		// 	}
		// }
		
		// function sessioncheck(){
		// 	if(!empty($_SESSION['user'])){
		// 		if($_SESSION['user']=="admin"){
		// 			return $_SESSION['user'];
		// 		}
		// 		else
		// 			header("location:index.php");
		// 	}
		// 	else
		// 		header("location:index.php");
		// }
		// #Magic method to avoid using wrong view content in the url to avoid error
		// function __call($fun,$result){
			
		// 	if($this->sessioncheck()){
		// 		echo "Invalid view";
		// 		header("location:index.php");
		// 		return null;
		// 	}
		// }
	}
	
?>