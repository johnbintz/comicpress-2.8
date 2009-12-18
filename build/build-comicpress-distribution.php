#!/usr/bin/php
<?php

$pear_ok = true;
if (!extension_loaded('zip')) { $pear_ok = false; }

if (!$pear_ok) {
	echo "This script requires the zip PECL extension\n. Please install it before proceeding.\n";
	exit(1);
}

if (!file_exists('comicpress-config.php.dist')) {
	echo "Must be run from the root ComicPress theme directory!\n";
	exit(1);
}

if (empty($argv[1])) {
	echo "Usage: {$argv[0]} <name of destination file>\n";
	exit(1);
}

if (!$zip_file = tempnam('', 'comicpress')) {
	echo "A temp directory could not be created!\n";
	exit(1);
}

$zip_file .= '.zip';

$ignore_filters = array(
	'#~$#', '#^\.#', '#^test$#', '#^build$#'
);

$renames = array(
	'#^(.*)\.dist$#' => '\1'
);

$zip = new ZipArchive();
$result = $zip->open($zip_file, ZipArchive::CREATE);
if ($result === true) {
	$dir_stack = array('.');
	while (!empty($dir_stack)) {
		$dir = array_shift($dir_stack);
		$zip_dir = preg_replace('#^.#', 'comicpress', $dir);
		$zip->addEmptyDir($zip_dir);
		if ($dh = opendir($dir)) {
			while ($file = readdir($dh)) {
				$ok = true;
				foreach ($ignore_filters as $filter) {
					if (preg_match($filter, $file) > 0) { $ok = false; break; }
				}
				if ($ok) {
					$target = $dir . '/' . $file;
					if (is_dir($target)) {
						$dir_stack[] = $target;
					} else {
						$zip_target = $file;
						foreach ($renames as $filter => $replacement) {
							$zip_target = preg_replace($filter, $replacement, $zip_target);
						}
						$zip_target = $zip_dir . '/' . $zip_target;
						echo $zip_target . "\n";
						$zip->addFile($target, $zip_target);
					}
				}
			}
		}
		closedir($dh);
	}

	$zip->close();
	rename($zip_file, $argv[1]);
}
