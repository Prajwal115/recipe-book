<?php
$filePath = 'data.txt';
$content = file_get_contents($filePath);
$fcode = $content;


// Define the directory where files will be uploaded
$targetDir = "IMG/";

// Ensure the directory exists and create it if not
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $foodName = $_POST['foodname'];
    $foodDesc = $_POST['fooddes'];
    $foodIngr = $_POST['foodingr'];
    $foodPro = $_POST['foodpro'];
    $foodType = $_POST['foodtype'];


    // Handle file upload
    if (isset($_FILES['fimg']) && $_FILES['fimg']['error'] == UPLOAD_ERR_OK) {
        // Path to the uploaded file
        $targetFilePath = $targetDir . $fcode . '.jpg'; // Use $fcode for the file name

        // Check if the file is an image
        $check = getimagesize($_FILES["fimg"]["tmp_name"]);
        if ($check !== false) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["fimg"]["tmp_name"], $targetFilePath)) {
                echo '<h1>The file has been uploaded and renamed successfully.</h1>';
            } else {
                echo '<h1>Failed to move the uploaded file.</h1>';
            }
        } else {
            echo '<h1>The uploaded file is not a valid image.</h1>';
        }
    } else {
        echo '<h1>No file was uploaded or there was an upload error.</h1>';
    }


} else {
    echo '<h1>Invalid request method.</h1>';
}

echo '<script>';
echo 'const formData = ' . json_encode(array(
    'foodName' => $foodName,
    'foodDesc' => $foodDesc,
    'foodIngr' => $foodIngr,
    'foodPro' => $foodPro,
    'foodType' => $foodType,
    'fcode' => $fcode
)) . ';';

echo '</script>';

?>

<html>

<head>
    <title>Recipe Added Successfully.</title>
    <link rel="stylesheet" href="CSS/done.css">
</head>
<script src="data.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function () {

        console.log("Form data received from PHP:", formData);
        const fProcedure = formData['foodPro'].split("***");
        console.log(fProcedure);
        console.log("Window.things", window.things);
        console.log("Window.ItemList", window.itemList);
        p = window.things;
        q=window.itemList;
        finaldata = [formData['foodName'], formData['foodDesc'], "IMG/" + formData['fcode'] + ".jpg", formData['foodType'], formData['fcode']];
        q.push(finaldata);
        console.log(q);
        things = {
            [formData['fcode']]: {
                'name': formData['foodName'],
                'desc': formData['foodDesc'],
                'time': '',
                'ing': formData['foodIngr'],
                'procedure': fProcedure
            }
        };

        Object.assign(p, things);
        console.log(p);
        fetch('update_js.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ finaldata: q, p: p })
    }).then(response => response.text())
      .then(result => {
          console.log(result); // success result
      }).catch(error => {
          console.error('Error:', error);
      });
    });
    
</script>


</html>