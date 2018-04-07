<?php

include './MasterMethods.php';

// Make sure form size in form.html and php.ini's post_max_size are the same, and also upload_max_filesize to be same as well. If uploaded file is greate than post_max_size, $_FILES will be empty.
// After you make changes to php.ini in 	/etc/php/7.0/apache2/php.ini   make sure to restart apache  sudo service apache2 restart. 
// phpinfo() will, at the top, tell you where it's looking for the config files.
// Current post_max_size is 15M, upload_max_filesize is 10M.
// Make sure you editing the correct php file, calling phpinfo() on a local script will not tell you correct place, best have the script in /var/www/html/ and then go to browser to see config where it's loading php.ini
// Also do     chown -R www-data /dir/for/file/uploads   THIS WILL GIVE PHP SCRIPT PERMISSION TO WRITE TO CERTAIN FOLDER.

// don't let the script time out
set_time_limit(0);

// some global variable
$upload_dir = '/home/yizongk/CUNYCodes/PHPScripts/filesuploads/';
$error_msg_dir = $upload_dir . 'msg.txt';
  

// $name will be decided what type of incoming request type. 'binaryfile' is for audio upload, 'login' will be for login with it's own logic.
function retrieveUpload( $name ) {
if ( isset($_FILES[$name]) ) {
    //print_r($_FILES);
}else
echo "nothing is set!<br>\n";

  // Checks if files is uploaded.
  if( !is_uploaded_file( $_FILES[$name]['tmp_name'] ) ) {
    echo "File not uploaded<br>\n";
    echo "Here is some more debugging info: <br>\n";
    print_r($_FILES);
    if( $_FILES[$name]['error'] == '1' )
      echo "The uploaded file exceeds the upload_max_filesize directive in php.ini. <br>\n";
    if( $_FILES[$name]['error'] == '2' )
      echo "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.<br>\n";
    if( $_FILES[$name]['error'] == '3' )
      echo "The uploaded file was only partially uploaded.<br>\n";
    if( $_FILES[$name]['error'] == '4' )
      echo "No file was uploaded.<br>\n";
    if( $_FILES[$name]['error'] == '5' )
      echo "No entry on this error 5 on php.net/manual<br>\n";
    if( $_FILES[$name]['error'] == '6' )
      echo "Missing a temporary folder.<br>\n";
    if( $_FILES[$name]['error'] == '7' )
      echo "Failed to write file to disk.<br>\n";
    if( $_FILES[$name]['error'] == '8' )
      echo "A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.<br>\n";
    return false;
  }


  $uploaded_file_dir = $upload_dir . basename( $_FILES[$name]['name'] );


  echo "<pre>\n";
  if( move_uploaded_file( $_FILES[$name]['tmp_name'], $uploaded_file_dir ) ) {
    echo "File is valid, and was successfully uploaded.<br>\n";
  }
  else {
    echo "Possible file upload attack!<br>\n";
    echo "Here is some more debugging info: <br>\n";
    print_r($_FILES);
  }
  echo "</pre>\n";

  return true;
}

function recieveIncomingJson() {
  $json_data = json_decode( file_get_contents('php://input'), true );
  print_r($json_data);
  return $json_data;
}

function processJson($json_data) {
  switch($json_data[type]) {
    case "CreateAcc":
      return CreateAcc($json_data[username],$json_data[password]);
      break;
    case "Login":
      return Login($json_data[username],$json_data[password]);
      break;
    case "Logout":
      break;
    case "JobSubmit":
      break;
  }
echo "$json_data[type]";
echo "but nothing process!\n";
  return false;
}

ob_start();
echo "Hello!<br>\n";
echo "Today is " . date("m/d/y") . " <br>\n";
echo "The time is " . date("h:i:sa") . " <br>\n";
if($_SERVER["REQUEST_METHOD"] == "POST") {
  //retrieveUpload('requesttype');
  //retrieveUpload('binaryfile');
  //retrieveUpload('json');
  $json_data = recieveIncomingJson();
  if( processJson($json_data) === true ) {
    echo $json_data[type] . " is a Success! \n";
  } else {
    echo $json_data[type] . " Failed! \n";
  }


} else {
  echo "Request type is not POST!";
}
echo "\n--------------------------\n";
file_put_contents($error_msg_dir, ob_get_contents(), FILE_APPEND);    
ob_end_clean();
?>
