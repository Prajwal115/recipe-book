<?php

$val;

if (isset($_POST['foodid'])) {
    $val = $_POST['foodid'];
    $c = $c + 1;
    $filePath = 'data.txt';

    // Data to write into the file
    $data = $val;

    // Write data to the file, overwriting any existing content
    if (file_put_contents($filePath, $data) !== false) {
        echo 'File written successfully.';
        header("Location: create1.html");
    } else {
        echo 'Operation Failed';
    }

}

