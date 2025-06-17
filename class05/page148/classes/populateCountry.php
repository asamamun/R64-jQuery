<?php
require "database.php";

$selectDivision = "select * from country where 1";
$selectDivisionResult = $conn->query($selectDivision);

if($selectDivisionResult->num_rows > 0 ){
	$rows = array();
	while($r = $selectDivisionResult->fetch_assoc()){
		//$rows[] = $r;
		array_push($rows,$r);
		}
		echo json_encode($rows);
	}
else json_encode(["result"=>"no data found"]);	