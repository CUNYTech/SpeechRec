<?php
include_once './MasterMethods.php';

/*
// Make sure form size in form.html and php.ini's post_max_size are the same, and also upload_max_filesize to be same as well. If uploaded file is greate than post_max_size, $_FILES will be empty.
// After you make changes to php.ini in 	/etc/php/7.0/apache2/php.ini   make sure to restart apache  sudo service apache2 restart. 
// phpinfo() will, at the top, tell you where it's looking for the config files.
// Current post_max_size is 15M, upload_max_filesize is 10M.
// Make sure you editing the correct php file, calling phpinfo() on a local script will not tell you correct place, best have the script in /var/www/html/ and then go to browser to see config where it's loading php.ini
// Also do     chown -R www-data /dir/for/file/uploads   THIS WILL GIVE PHP SCRIPT PERMISSION TO WRITE TO CERTAIN FOLDER.
*/

/* don't let the script time out */
set_time_limit(0);

/* some global variable */
$error_msg_dir = '/home/yizongk/CUNYCodes/PHPScripts/filesuploads/msg.txt';
$arr;

ob_start();
echo "Hello! This is the beginning of the php script! <br>\n";
echo "Today is " . date("m/d/y") . " <br>\n";
echo "The time is " . date("h:i:sa") . " <br>\n";
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $json_data = recieveIncomingJson();
  if($json_data != null) {
    if( processJson($json_data) === true ) {
      echo $json_data[type] . " is a Success! \n";
      $arr->success = true;
    } else {
      echo $json_data[type] . " Failed! \n";
      $arr->success = false;
    }


  }else if(isset($_GET['apicall'])) {
    echo "This is a api call\n";
    $incoming_request_data = recieveIncomingRequest();
    if( processRequest($incoming_request_data) === true ) {
      // success
      echo "\n Incoming request prcoessed and finished successfully. \n";
    } else {
      // failed
      echo "\n Incoming request processed but did NOT finished successfully. \n";
    }
    
  } else {
    echo "POST request not recognized! \n";
  }

} else {
  echo "Request type is not POST!";
  $arr->success = false;
}

echo "\n--------------------------\n";
//file_put_contents($error_msg_dir, ob_get_contents(), FILE_APPEND);   
$arr->server_msg = ob_get_contents();
ob_end_clean();

$myjson = json_encode($arr);
echo $myjson;

?>


