<?php
	/**
	 * @author Wilfren
	 * @since 25/09/2024
	 * @update Wilfren (26-09-2024)
	 * 
	 *  class is for connecting database and execute query
	 */
	namespace App\Models;

	use CodeIgniter\Model;
	class ModelStudent extends Model{
		// public $conn;
		#Constructor has parameter passed in the object of the connection to database
		// function __construct($conn){
		// 	$this->conn=$conn;
		// }
		#Selects all data from user_details table
		function studentlist($start,$filtercontent){
			$stmt="select * from user_details inner join student_details on user_id = r_user_id where active_status=1 and user_type='student'";
			// $query = $this->conn->prepare("$stmt");
			// $query->execute();
			// $resultset=$query->fetchAll(PDO::FETCH_ASSOC);
			#count for pagination total pages
			// $_SESSION['count']=count($resultset);
			#if url has filter content then select query is appended with conditions
			// if(!empty($filtercontent)){
			// 	foreach($filtercontent as $key=>$value){
			// 		if(!empty($value))
			// 			$stmt .= " and $key='$value'";
			// 	}
			// }
			#Now limit is applied displaying 2 contents per page
			// $stmt.=" Limit $start,2";
			$query=$this->db->query($stmt);
			$resultset=$query->getResult();
			return $resultset;
		}
		
		#deletes data from table using particular id
		function studentdatadelete($id){
			
			$this->db->query("update user_details set active_status='N' where user_id=:id:",['id'=>$id]);

			// $resultset=$query->getResult();
			return;
			
		}



		#inserts data to first table
		function studentinsert_table1($postdata){
			$password=base64_encode($postdata["password"]);
			$this->db->query("insert into user_details 
									(	first_name,
										last_name,
										email,
										password,
										active_status,
										user_type
									) 
									values(
										:first_name:,
										:last_name:,
										:email:,
										:password:,
										1,
										'student'
									)",
									[
										"first_name"=>$postdata["fname"],
										"last_name"=>$postdata["lname"],
										"email"=>$postdata["email"],
										"password"=>$password
									]);
			return null;
			
		}

		#selects last inserted data from table
		function lastinsertedstudent(){
			$query = $this->db->query("select user_id from user_details order by user_id desc limit 1");
			return $query->getResult();
		}
		
		#insert data to second table 
		function studentinsert_table2($postdata,$id){
			$query=$this->db->query(
									"insert into student_details 
									(r_user_id,dob,age,department,gender,location,phone_number,photo_location) 
									values(
										:id:,
										:dob:,
										:age:,
										:dept:,
										:gender:,
										:location:,
										:phone_number:,
										:photo_location:
									)",
									[
										'id'=>$id,
										'dob'=>$postdata["dob"],
										'age'=>$postdata["age"],
										'dept'=>$postdata["dept"],
										'gender'=>$postdata["gender"],
										'location'=>$postdata["location"],
										'phone_number'=>$postdata["phone_number"],
										'photo_location'=>$postdata["photo_location"]
									]);
			
		}

		#
		function studentupdate($postdata,$id){
			$password=base64_encode($postdata["password"]);
			$query=$this->db->query("update user_details set 
										first_name=:first_name:,
										last_name=:last_name:,
										email=:email:,
										password=:password:,
										active_status=1,
										user_type='student' 
										where user_id=:id:",
									[
										"first_name"=>$postdata["fname"],
										"last_name"=>$postdata["lname"],
										"email"=>$postdata["email"],
										"password"=>$password,
										"id"=>$id
									]);

			if(!empty($postdata['photo_location'])){
				$query2=$this->db->query("update student_details set 
										dob=:dob:,
										age=:age:,
										department=:department:,
										gender=:gender:,
										location=:location:,
										phone_number=:phone_number:,
										photo_location=:photo_location: 
										where r_user_id=:id:",
									[
										"id"=>$id,
										"dob"=>$postdata["dob"],
										"age"=>$postdata["age"],
										"department"=>$postdata["dept"],
										"gender"=>$postdata["gender"],
										"location"=>$postdata["location"],
										"phone_number"=>$postdata["phone_number"],
										"photo_location"=>$postdata["photo_location"]
									]);
			}
			else{
				$query2=$this->conn->prepare("update student_details set 
											dob=:dob:,
											age=:age:,
											department=:department:,
											gender=:gender:,
											location=:location:,
											phone_number=:phone_number: 
											where r_user_id=:id:",
											[
												"id"=>$id,
												"dob"=>$postdata["dob"],
												"age"=>$postdata["age"],
												"department"=>$postdata["dept"],
												"gender"=>$postdata["gender"],
												"location"=>$postdata["location"],
												"phone_number"=>$postdata["phone_number"]
											]);
			}
			
			return;
		}

		#Fetching specific data of the user
		function studentdataview($id){
			$query=$this->db->query("select * from user_details 
										inner join student_details on user_id=r_user_id 
										where active_status=1 and 
										user_type='student' and 
										user_id=:id:",
										[
											"id"=>$id
										]
									);
			$studentdata=$query->getResult();
			return $studentdata;
		}
		
		#This funtion is used to fetch data of the students
		function studentdatafetch($id){
				$query=$this->db->query("select * from user_details inner join student_details on user_id=r_user_id where active_status=1 and user_type='student' and user_id=:id:",['id'=>$id]);
				
				$resultset= $query->getResult();
				return $resultset;
		}
		
	}

?>