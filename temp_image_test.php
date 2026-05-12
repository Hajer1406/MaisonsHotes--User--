<?php
$url = 'http://127.0.0.1:8000/storage/maisons/yDGrCsWHYzzQCLqOCf5ULwXHg7hxyYjijZvygDzE.jpg';
$contents = @file_get_contents($url);
if ($contents === false) {
    echo 'FAIL\n';
    $error = error_get_last();
    print_r($error);
} else {
    echo 'OK '.strlen($contents).' bytes\n';
}
