<?php
$hash = @$_POST['hash'];
$dsym = @$_FILES['dsym'];
if (empty($hash) || empty($productName) || empty($dsym) || empty($dsym['size'])) {
	throw new HttpException();
}
$fileName = '/var/dsyms/'.$hash.'/'.$dsym['name'];
move_uploaded_file($dsym['tmp_name'], $fileName);

echo json_encode($output);