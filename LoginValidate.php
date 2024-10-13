<?php
namespace App\Models;

use CodeIgniter\Model;

	class LoginValidate extends Model{
		// function __construct($conn){
		// 	$this->conn=$conn;
		// }
		public function datacheck($data){
			$query="select * from user_details where active_status=1 and email=:email: and password=:password:";
			$password=base64_encode($data['pass']);
			$binddata=$this->db->query($query,['email'=>$data['email'],'password'=>$password]);
			$resultset=$binddata->getResult();
			return $resultset;
		}
	}

?>