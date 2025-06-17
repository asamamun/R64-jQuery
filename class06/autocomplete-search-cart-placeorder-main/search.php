<?php
require 'connection.php';
//jquery autocomplete value always sends the search value to server with "term" in GET request
if (isset($_GET['term'])){
	$sql = "SELECT id,name FROM products WHERE name LIKE '%" . $_GET['term'] . "%'";
	$return_arr = array();
	$result = $conn->query($sql);
	while ($row = $result->fetch_assoc()) {
		$return_arr[] = array(
			'label' => $row['name'],
			'value' => $row['name'],
			'id' => $row['id']
		);
	}
    /* Toss back results as json encoded array. */
	// label and value is required, other keys are optional and you can add any number of keys you want
    echo json_encode($return_arr);
}
?>