<?php
//if request is not ajax stop execution
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
        exit;
}
$conn = new mysqli("localhost", "root", "", "r64_php");
$conn->set_charset("utf8");

$id = $_GET["pid"];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo "0 results";
}