<?php
/* echo json_encode([
    ['name' => 'Product 1', 'price' => 100],
    ['name' => 'Product 2', 'price' => 200],
    ['name' => 'Product 3', 'price' => 300],
    ['name' => 'Product 4', 'price' => 400],
    ['name' => 'Product 5', 'price' => 500]
]); */
$conn = new mysqli("localhost", "root", "", "r64_php");
$conn->set_charset("utf8");

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo "0 results";
}

?>