
<html>
<head>
	<title>Edit</title>
	<!-- <link rel="stylesheet" href="view/css/studentinsertstyle.css"> -->
	<script>
		function editverify(){
			let password=document.getElementById("password").value;
			let p='w@123';
			let pattern1=/[a-z]/g;
			let pattern2=/[0-9]/g;
			let pattern3=/[!@#$&*]/g;
			let pattern4=/[A-Z]/g;
			let pattern=/^[a-zA-Z0-9!@#$&*]{6,16}$/;
			console.log(pattern.test(password));
			if(password.length>5){
				console.log("length matched");
				let g=pattern.test(password);
				console.log(g);
				if(pattern1.test(password)){
					console.log("pattern1 true");
					if(pattern2.test(password)){
						console.log("pattern2 true");
						if(pattern3.test(password)){
							console.log("pattern3 true");
							if(pattern4.test(password)){
								console.log("pattern4 true");
								return true;
							}
							else{
								document.getElementById("errordisp").innerHTML="Password must have caps values";
								return false;
							}
						}
						else{
							document.getElementById("errordisp").innerHTML="Password must have special symbols";
							return false;
						}
					}
					else
						document.getElementById("errordisp").innerHTML="Password must have digits";
						return false;
				}
				else{
					document.getElementById("errordisp").innerHTML="Password must have characters";
					return false;
				}
			}
			else{
				document.getElementById("errordisp").innerHTML="Password length must be greater than 5";
				return false;
				
			}
			
		}
	</script>
</head>
<body>
	<div class='form'>
		<h1>EDIT <span><?php echo $first_name;?><span></h1>
		<form action='<?php echo "http://localhost/Student/studentapp/public/student/update/id/".$user_id?>' method=post onsubmit="return editverify()" enctype="multipart/form-data">
			<label>First Name:</label><br><br>
			<input type="text" name="fname" value="<?php echo $first_name?>" class="click" required><br><br>
			<label>Last Name:</label><br><br>
			<input type="text" name="lname" value="<?php echo $last_name?>" class="click" required><br><br>
			<label>Email:</label><br><br>
			<input type="email" name="email" value="<?php echo $email?>" class="click" required><br><br>
			<label>Password:</label><br><br>
			<input type="password" name="password" value="<?php echo base64_decode($password)?>" id="password" class="click" required><br><br>
			<span id="errordisp"></span><br>
			<label>DOB:</label><br><br>
			<input type="date" name="dob" value="<?php echo $dob?>" class="click" required><br><br>
			<label>Age:</label><br><br>
			<input type="number" name="age" id='age' value="<?php echo $age?>" class="click" required><br><br>
			<label>Department:</label><br><br>
			<select name="dept" ">
				<option value="ECE" <?php if($department=="ECE") echo"selected"?> >ECE</option>
				<option value="CSE"<?php if($department=="CSE") echo"selected"?>>CSE</option>
				<option value="MECH"<?php if($department=="MECH") echo"selected"?>>MECH</option>
				<option value="IT"<?php if($department=="IT") echo"selected"?>>IT</option>
				<option value="EEE"<?php if($department=="EEE") echo"selected"?>>EEE</option>
				<option value="CIVIL"<?php if($department=="CIVIL") echo"selected"?>>CIVIL</option>
			</select><br><br>
			<label>Gender:</label><br><br>
			<input type="radio" name="gender" value="Male" class="click" <?php if($gender=="Male") echo "checked"?> required><label for="gender" >Male</label>
			<input type="radio" name="gender" value="Female" class="click" <?php if($gender=="Female") echo "checked"?> required><label for="gender" >Female</label>
			<input type="radio" name="gender" value="Others" class="click" <?php if($gender=="Others") echo "checked"?> required><label for="gender" >Others</label><br><br>
			<label>Location:</label><br><br>
			<input type="text" name="location" value="<?php echo $location?>" class="click" required><br><br>
			<label>Phone number:</label><br><br>
			<input type="number" name="phone_number" value="<?php echo $phone_number?>" class="click" required><br><br>
			<label>Photo :</label><br><br>
			<?php
				if(!empty($photo_location)){
					// echo $photo_location;
					echo "<img src='$photo_location' width='100px'><br><br>";
					echo "<input type='file' name='photo_location' value='view/images/vijay.jpg'  class='click' ><br><br>";
				}
				else
				echo "<input type='file' name='photo_location'  class='click' required><br><br>"
			?>
			
			<input type="submit">
		</form>
	</div>
</body>
</html>