<?php
//connect to database
$mysqli = new mysqli("localhost","root","","agro");

if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
$id = $_GET['id'];
// $id = $_GET['id'];
// $date = $_GET['date'];

$arr 	= array();
$arr1 	= array();
$result = array();

$sql = "select max,min from excel where d_id = $id";
$q	 = $mysqli -> query($sql);

$j = 0;
while($row = $q->fetch_assoc()){

	if($j == 0){
	$arr['name'] = 'Max';
	$arr1['name'] = 'Min';
		$j++;
	}
	$arr['data'][] = $row['max'];
	$arr1['data'][] = $row['min'];
}

array_push($result,$arr);
array_push($result,$arr1);
print json_encode($result, JSON_NUMERIC_CHECK);

$mysqli -> close();

?>
