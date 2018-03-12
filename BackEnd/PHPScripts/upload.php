<?php

$target_dir = "/wwwuploads/";
$target_file = $target_dir . basename( $_FILES["fileToUpload"]["name"] );
$uploadOK = 1; 
$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );

// Check if image file is a actual image or fake image.
if( isset( $_POST["submit"] ) ) {
  $check = getimagesize( $_FILES["fileToUpload"]["tmp_name"] );
  
  if( $check !== false ) {
    echo "File is an image - " . $check["mime"] . ".\n";
    $uploadOk = 1;
  }
  else {
    echo "File is not an image.\n";
    $uploadOk = 0;
  }
}

?>
