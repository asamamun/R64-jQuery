<?php
header('Content-Type: application/json');

// Create uploads directory if it doesn't exist
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

$allowedTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/gif' => 'gif',
    'application/pdf' => 'pdf'
];

$response = [
    'success' => false,
    'message' => '',
    'file_name' => '',
    'file_type' => '',
    'file_size' => 0
];

try {
    if (!isset($_FILES['file'])) {
        throw new Exception('No file uploaded.');
    }

    $file = $_FILES['file'];

    // Check for upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File upload error: ' . $file['error']);
    }

    // Check file type
    $fileType = mime_content_type($file['tmp_name']);
    if (!array_key_exists($fileType, $allowedTypes)) {
        throw new Exception('Invalid file type. Only images (JPEG, PNG, GIF) and PDF files are allowed.');
    }

    // Check file size (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        throw new Exception('File size exceeds 5MB limit.');
    }

    // Generate a unique filename while preserving the extension
    $extension = $allowedTypes[$fileType];
    $filename = uniqid() . '.' . $extension;

    // Move the file to the uploads directory
    if (!move_uploaded_file($file['tmp_name'], 'uploads/' . $filename)) {
        throw new Exception('Failed to move uploaded file.');
    }

    $response['success'] = true;
    $response['message'] = 'File uploaded successfully.';
    $response['file_name'] = $filename;
    $response['file_type'] = $fileType;
    $response['file_size'] = $file['size'];

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>