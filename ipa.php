<?php
$hash = @$_POST['hash'];
$ipa = @$_FILES['ipa'];
if (empty($hash) || empty($ipa) || empty($ipa['size'])) {
	header("HTTP/1.0 400 Bad request");
	exit;
}
$dirName = '/var/www/symbolicate/ipa/'.$hash;
$fileName = $dirName.'/'.$ipa['name'];
if (!file_exists($dirName)) {
	if (!mkdir($dirName, true)) {
		header("HTTP/1.0 404 Access denied");
		exit;
	}
}
if (!move_uploaded_file($ipa['tmp_name'], $fileName)) {
	header("HTTP/1.0 403 Access denied");
	exit;
}

echo 'Done!';