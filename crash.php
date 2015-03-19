<?php
$architecture = @$_POST['architecture'];
$loadAddress = @$_POST['load_address'];
$addresses = @$_POST['addresses'];
$hash = @$_POST['hash'];
$productName = @$_POST['product_name'];
if (empty($hash) ||  empty($architecture) || empty($loadAddress) || empty($addresses) || empty($productName)) {
	header("HTTP/1.0 400 Bad request");
	exit;
}
$fileName = '/var/dsyms/'.$hash.'/'.$productName;
exec(escapeshellcmd("sudo /usr/bin/atosl -A $architecture -o $fileName -l $loadAddress $addresses"), $output);

echo json_encode($output);