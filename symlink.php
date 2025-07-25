<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$target = $_SERVER['DOCUMENT_ROOT'] . '/../laravel/storage/app/public';
$link = $_SERVER['DOCUMENT_ROOT'] . '/storage';

echo "Target: $target<br>";
echo "Link: $link<br>";

if (symlink($target, $link)) {
    echo "Symlink created.";
} else {
    echo "Failed to create symlink.";
    clearstatcache();
    if (file_exists($target)) {
        echo "<br>Target exists.";
    } else {
        echo "<br>Target does not exist.";
    }
}
?>
