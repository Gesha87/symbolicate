<?php
$architecture = @$_POST['architecture'];
$loadAddress = @$_POST['load_address'];
$addresses = @$_POST['addresses'];
$hash = @$_POST['hash'];
$path = @$_POST['path'];
$lib = @$_POST['lib'];
$systemVersionCode = @$_POST['version'];
if (empty($hash) ||  empty($architecture) || empty($loadAddress) || empty($addresses) || empty($productName)) {
	header("HTTP/1.0 400 Bad request");
	exit;
}
if ($lib) {
	if ($systemVersionCode) {
		$fileName = '/var/local/ios-dsyms/' .$systemVersionCode . '/Symbols' . $path;
		if (!file_exists($fileName)) {
			echo json_encode(explode(' ', $addresses));
			exit;
		}
	} else {
		echo json_encode(explode(' ', $addresses));
		exit;
	}
} else {
	$fileName = '/var/dsyms/'.$hash.'/'.$path;
}
exec(escapeshellcmd("sudo /usr/local/bin/atosl -A $architecture -o $fileName -l $loadAddress $addresses"), $output);

echo json_encode($output);