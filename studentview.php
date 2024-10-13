<html>
<head>
<title>Student View</title>
<link rel="stylesheet" href="view/css/studentviewstyle.css">
<script src="view/js/validation.js"></script>
</head>
<body>
</body>
</html>

<?php

	
	echo "<div class='margin'>
			<h1><span class='color'>{$data[0]['first_name']}</span> DETAILS</h1>";
	
	echo "<div class='div'>";
	
	echo"{$data[0]['photo_location']}<div class='image'>
			<img src='{$data[0]['photo_location']}' class='img'>
		</div><table cellspacing=20  cellpadding=5 align=center >";
	foreach($data[0] as $key=>$value){
		if($key!="password" && $key!="r_user_id" && $key!="photo_location" && $key!="active_status"){
			echo "
				<tr>
					<td><b>".strtoupper($key)."</b></td><td>:</td>
					<td cellpaddin=20>".strtoupper($value)."</td>	
				</tr>
				
			";
		}
	}
	echo "<tr>
		</tr></table></div></div></div>";

?>

