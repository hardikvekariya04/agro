<?php

	$conn = mysqli_connect("localhost","root","","agro") or die("Connection failed");

	if($_POST['type'] == ""){
		$sql = "SELECT * FROM state_tb";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['sid']}'>{$row['s_name']}</option>";
		}
	}else if($_POST['type'] == "stateData"){

		$sql = "SELECT * FROM city_tb WHERE sid = {$_POST['id']}";

		$query = mysqli_query($conn,$sql) or die("Query Unsuccessful.");

		$str = "";
		while($row = mysqli_fetch_assoc($query)){
		  $str .= "<option value='{$row['cid']}'>{$row['c_name']}</option>";
		}
	}

	echo $str;
 ?>

<!-- INSERT INTO `city_tb` (`cid`, `c_name`, `sid`) VALUES (NULL, '2', ''); -->
