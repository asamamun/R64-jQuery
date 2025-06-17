<?php
require "db.php";
$term = $_GET['id'];
$sql = "SELECT * FROM film WHERE film_id = " . $term . " LIMIT 1";
$result = $conn->query($sql);
header("Content-Type: application/json");
echo json_encode(['data'=>$result->fetch_array(MYSQLI_ASSOC)]);
?>