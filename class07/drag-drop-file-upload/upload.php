<?php
header('Content-Type: application/json');

$uploadDir = 'uploads/';
$response = ['success' => false, 'message' => ''];

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Validate file
    $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        $response['message'] = 'Invalid file type. Only JPG, PNG, and PDF are allowed.';
    } elseif ($file['size'] > $maxSize) {
        $response['message'] = 'File too large. Maximum size is 5MB.';
    } else {
        $fileName = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $response['success'] = true;
            $response['message'] = 'File uploaded successfully!';
        } else {
            $response['message'] = 'Failed to upload file.';
        }
    }
} else {
    $response['message'] = 'No file uploaded.';
}

echo json_encode($response);
?>