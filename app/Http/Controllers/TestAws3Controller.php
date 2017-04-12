<?php
// Load 1 số thư viện cần thiết
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// Lấy các thông tin từ file config
$config = Config::get('aws');
// Khởi tạo 1 S3 client với các thông tin lấy từ file config
$s3 = S3Client::factory(
    [
        'key' => $config['key'],
        'secret' => $config['secret'],
        'region' => $config['region'],
    ]);
// Tải lên một ảnh có thể truy cập công khai.
try {
    $result = $s3->putObject(array(
        'Bucket' => 'my-bucket',
        'Key'    => 'my-object',
        'SourceFile'   => 'file_url',
        'ACL'    => 'public-read',
    ));
} catch (S3Exception $e) {
    echo "There was an error uploading the file.\n";
}