<?php

require_once 'core/Helper.php';

class FileResourceController
{
    public function index()
    {
        // Scan directory for files
        $directory = 'assets/downloadable';
        $files = array_diff(scandir($directory), ['.', '..']);

        include 'views/coordinator/file-resource.php';
    }

    public function delete($request)
    {
        header('Content-Type: application/json');

        $file = "./assets/downloadable/" . $request['file'];

        if (file_exists($file)) {
            unlink($file);
            echo json_encode([
                'success' => true,
                'request' => $request
            ]);

            return;
        }

        echo json_encode([
            'success' => false
        ]);
    }

    public function upload($request)
    {
        // Upload File
        $upload = Helper::fileUpload([
            'target_dir' => "assets/downloadable/",
            'file' => $_FILES['file'],
            'allowed_types' => ['pdf', 'jpg', 'png', 'docx'],
            'max_size' => 5000  // 5MB in kilobytes
        ]);

        if (!$upload['success']) {
            // Scan directory for files
            $directory = 'assets/downloadable';
            $files = array_diff(scandir($directory), ['.', '..']);

            $flash['message'] = $upload['message'];
            return include 'views/coordinator/file-resource.php';
        }

        Helper::redirect('file-resource');
    }
}