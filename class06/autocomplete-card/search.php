<?php
$conn = new mysqli("localhost", "root", "", "r64_php");

$term = $_GET['term'] ?? '';

if (!empty($term)) {
    $stmt = $conn->prepare("SELECT id, name, email, phone FROM users WHERE name LIKE ? LIMIT 10");
    $like = '%' . $term . '%';
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'label' => $row['name'],
            'value' => $row['name'],
            'id' => $row['id'],
            'email' => $row['email'],
            'phone' => $row['phone']
        ];
    }

    echo json_encode($data);
}
?>
