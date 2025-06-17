<?php
require "db.php";
//user value always sends the search value to server with "term" in GET request
$term = $_GET['term'];

$sql = "SELECT film_id, title FROM film WHERE title LIKE '%".$term."%' or description LIKE '%".$term."%'";

$result = $conn->query($sql);
$data = array();
while($r = $result->fetch_array(MYSQLI_ASSOC)){
	//you must send label and value, other keys are optional
    $data[] = array(
			'label' => $r['title'],
			// 'value' => $r['film_id'],
			'value' => $r['title'],
			'id' => $r['film_id']
		);
}
echo json_encode($data);
?>