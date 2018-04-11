<?php
include_once './UsersMethods.php';
include_once './MessagesMethods.php';
include_once './GlobalVar.php';

/* some global variable */
$upload_dir = '/home/yizongk/CUNYCodes/PHPScripts/filesuploads/';
$data_dir = '/home/yizongk/CUNYCodes/';

/* BEFORE DOING ANY OF THE FOLLOWING FCT, NOTE TO SELF, HAVE A CHECK THAT THEY ARE CURRENTLY ONLINE, BEFORE EACH FCT, MUST CHECK THAT THEY ARE ONLINE (that they are logged in).
// IT IS ASSUMED THAT MASTER SCRIPT WILL MAKE SURE BEFORE CALLING ANY OF FOLLOWING FCT THAT USER IS ONLINE (that they are logged in).
*/

/* "Job Submission", "Request Audio", "Request Transcript", "Request Summary", " "Remove Message" (Removes audio, text and summary)". */

/* CORE FUNCTIONS 
// $name will be decided what type of incoming request type. 'binaryfile' is for audio upload, 'login' will be for login with it's own logic.
*/
/*
function retrieveUpload( $name ) {
  if ( isset($_FILES[$name]) ) {
      return true;
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
*/  

function recieveIncomingJson() {
  $json_data = json_decode( file_get_contents('php://input'), true );
  //print_r($json_data);
  return $json_data;
}
  

function getDBConnection() {
  $servername = "localhost";
  $username = "root";
  $password = "SpeechRec";
  $dbname = "SpeechRec";
  
  // Create connection
  $conn = mysqli_connect( $servername, $username, $password );

  // Check connection
  if( !$conn ) {
    echo "Connection failed: " . mysqli_connect_error() . "\n";

    return false;
  }

  // Access the correct database
  $sql = "USE $dbname";
  if( !mysqli_query( $conn, $sql ) ) {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn );

    return false;
  } 
  
  return $conn;
}

function closeDBConnection($conn) {
  // Close connection,  assumes will work every time (got to double check this), so will return true;
  mysqli_close( $conn );
  return true;
}



/* Normal Methods */

// Assumes that audio file is in working_directory before calling.
function JobSubmission( $username ) {
  $conn = getDBConnection();
//$success = retrieveUpload('binaryfile');;
  $filename = basename( $_FILES[$name]['name']);
  echo $filename . "\n";
  // Find next audio ID in data_dir, not mysql, cuz they might have different ID#
  // rename audio file to username.ID#.filename.wav
  // Move to data_dir/audio
//shell_exec('mv $upload_dir/' . $filename);
  // Create entry in MESSAGES TABLE mysql
  // call transribe program
  // direct output of that program to /data_dir/fulltext/username.ID#.filename.txt
  // update transcribe status on message in mysql to done
  // update text_path in mysql
  // call summary program
  // direct output of that program to /data_dir/summary/usernamer.ID#.filename.sum.txt
  // update summary status on message in mysql to done
  // update sum_text_path on message in mysql
  // sends back summary text to original IP.
  closeDBConnection($conn);
//return $success;
  return true;
}

function CreateAcc( $username, $password ) {  // Create Account ID, must be unique somehow
  $conn = getDBConnection();
  $success = CreateAccount($conn, $username, $password);
  closeDBConnection($conn);
  return $success;
}

function Login( $username, $password ) {
  $conn = getDBConnection();
  $success = LoginRequest( $conn, $username, $password );
  closeDBConnection($conn);
  return $success;
}

function Logout( $username ) {
  $conn = getDBConnection();
  $success = LogoutRequest($conn,$username);
  closeDBConnection($conn);
  return $success;
}

// Assumes $member to be Message_ID, and member_key to be its id number.
//stil need to add column for file name in mysql Messages and then append that to function output.
function RequestAudioPath( $member_key ) {
  $conn = getDBConnection();
  $success = GetAudioPathName( $conn, $member_key );
  closeDBConnection($conn);
  return $success;
}

function RequestTextPath( $member_key ) {
  $conn = getDBConnection();
  $success = GetTranscriptPathName( $conn, $member_key );
  closeDBConnection($conn);
  return $success;
}

function RequestSumTextPath( $member_key ) {
  $conn = getDBConnection();
  $success = GetSummaryPathName( $conn, $member_key );
  closeDBConnection($conn);
  return $success;
}

function RequestMessageRemoval( $member, $member_key ) {
  $conn = getDBConnection();
  $success = RemoveMessage( $conn, $member, $member_key );
  closeDBConnection($conn);
  return $success;
}

function processJson($json_data) {
  $success = null;
  switch($json_data[type]) {
    case "CreateAcc":
      $success = CreateAcc($json_data[username],$json_data[password]);
      return $success;
      break;
    case "Login":
      $success = Login($json_data[username],$json_data[password]);
      return $success;
      break;
    case "Logout":
      $success = Logout($json_data[username]);
      return $success;
      break;
    case "JobSubmit":
      $success = JobSubmission($json_data[username]);
      return $success;
      break;

    return $success;
  }
  echo "$json_data[type]";
  echo " but nothing process!\n";
  return false;
}  

?>
