<?php
header('Content-Type: application/json');

$files = [];

if (file_exists('uploads') && is_dir('uploads')) {
    $dir = new DirectoryIterator('uploads');
    
    foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot() && $fileinfo->isFile()) {
            $filePath = $fileinfo->getPathname();
            $mimeType = mime_content_type($filePath);
            
            // Only include images and PDFs
            if (strpos($mimeType, 'image/') === 0 || $mimeType === 'application/pdf') {
                $files[] = [
                    'name' => $fileinfo->getFilename(),
                    'type' => $mimeType,
                    'size' => $fileinfo->getSize()
                ];
            }
        }
    }
}

echo json_encode($files);
?>