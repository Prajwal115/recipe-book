<?php

$tempJsPath = 'temp.js';

// Checking if the file exists
if (!file_exists($tempJsPath)) {

    $initialContent = "console.log('temp.js file created');";
    file_put_contents($tempJsPath, $initialContent);
    echo 'temp.js file created.';
} else {
    echo 'temp.js file already exists.';
}


$tempJsPath = 'temp.js';
$dataJsPath = 'data.js';


$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (isset($data['finaldata']) && isset($data['p'])) {
    $finaldata = $data['finaldata'];
    $p = $data['p'];

    $jsContent = "
        window.itemList = " . json_encode($finaldata) . ";
        window.things = " . json_encode($p) . ";

    ";

    // Write content to temp.js
    file_put_contents($tempJsPath, $jsContent);

    // Delete data.js if it exists
    if (file_exists($dataJsPath)) {
        unlink($dataJsPath);
    }

    // Rename temp.js to data.js
    rename($tempJsPath, $dataJsPath);

    echo 'JavaScript file updated successfully.';
} else {
    echo 'Invalid data.';
}
?>
