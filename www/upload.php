<?php
// fileToUpload is the name of our file input field
if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    echo "File name: " . $_FILES['fileToUpload']['name'] . "<br />";
    echo "File type: " . $_FILES['fileToUpload']['type'] . "<br />";
    echo "File size: " . ($_FILES['fileToUpload']['size'] / 1024) . " Kb<br />";
    echo "Temp path: " . $_FILES['fileToUpload']['tmp_name'];
}
if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
}
 else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        echo 'Uploaded file is allowed!';
    } else {
        echo 'You must upload an image...';
    }
}
if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        // we are renaming the file so we can upload files with the same name
        // we simply put current timestamp in fron of the file name
        $newName = time() . '_' . $_FILES['fileToUpload']['name'];
        $destination = 'uploads/' . $newName;
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)) {
            echo 'File ' .$newName. ' succesfully copied';
        }
    } else {
        echo 'You must upload an image...';
    }
}
require_once('ImageManipulator.php');
 
if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
        // resizing to 200x200
        $newImage = $manipulator->resample(200, 200);
        // saving file to uploads folder
        $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
        echo 'Done ...';
    } else {
        echo 'You must upload an image...';
    }
}

if ($_FILES['fileToUpload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['fileToUpload']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
        $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator($_FILES['fileToUpload']['tmp_name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        // our dimensions will be 200x130
        $x1 = $centreX - 100; // 200 / 2
        $y1 = $centreY - 65; // 130 / 2
 
        $x2 = $centreX + 100; // 200 / 2
        $y2 = $centreY + 65; // 130 / 2
 
        // center cropping to 200x130
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save('uploads/' . $newNamePrefix . $_FILES['fileToUpload']['name']);
        echo 'Done ...';
    } else {
        echo 'You must upload an image...';
    }
}