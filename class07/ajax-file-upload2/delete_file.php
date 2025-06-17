<?php
header('Content-Type: application/json');

$response = [
    'success' => false,
    'message' => ''
];

try {
    if (!isset($_POST['file_name']) || empty($_POST['file_name'])) {
        throw new Exception('No file name provided.');
    }

    $fileName = basename($_POST['file_name']);
    $filePath = 'uploads/' . $fileName;

    if (!file_exists($filePath)) {
        throw new Exception('File does not exist.');
    }

    // Verify the file is actually in our uploads directory
    if (realpath(dirname($filePath)) !== realpath('uploads')) {
        throw new Exception('Invalid file path.');
    }

    if (!unlink($filePath)) {
        throw new Exception('Failed to delete file.');
    }

    $response['success'] = true;
    $response['message'] = 'File deleted successfully.';

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>