<?php
$hash = @$_POST['hash'];
$dsym = @$_FILES['dsym'];
if (empty($hash) || empty($dsym) || empty($dsym['size'])) {
	header("HTTP/1.0 400 Bad request");
	exit;
}
$dirName = '/var/dsyms/'.$hash;
$fileName = $dirName.'/'.$dsym['name'];
if (!mkdir($dirName) || !move_uploaded_file($dsym['tmp_name'], $fileName)) {
	header("HTTP/1.0 403 Access denied");
	exit;
}

echo 'Done!';