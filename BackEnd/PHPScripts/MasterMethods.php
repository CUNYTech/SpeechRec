<?php
include_once './UsersMethods.php';
include_once './MessagesMethods.php';
include_once './AWSPrepFunctions.php';

/* some global variable */
//$upload_dir = '/home/yizongk/CUNYCodes/PHPScripts/filesuploads/';
$working_dir = '/home/ubuntu/working_space/';
$data_dir = '/home/ubuntu/data_dir/';

/* BEFORE DOING ANY OF THE FOLLOWING FCT, NOTE TO SELF, HAVE A CHECK THAT THEY ARE CURRENTLY ONLINE, BEFORE EACH FCT, MUST CHECK THAT THEY ARE ONLINE (that they are logged in).
// IT IS ASSUMED THAT MASTER SCRIPT WILL MAKE SURE BEFORE CALLING ANY OF FOLLOWING FCT THAT USER IS ONLINE (that they are logged in).
*/

/* "Job Submission", "Request Audio", "Request Transcript", "Request Summary", " "Remove Message" (Removes audio, text and summary)". */

/* CORE FUNCTIONS 
// $name will be decided what type of incoming request type. 'binaryfile' is for audio upload, 'login' will be for login with it's own logic.
*/

// CREATE A CLASS TO STORE INCOMING POST DATA IN!
function recieveIncomingRequest() {
  $request_data = null;

  if(isset($_GET['apicall'])){
    
    switch($_GET['apicall']){
    
      case 'signup':
      //if(isTheseParametersAvailable(array('username','email','password','phonenumber', 'firstName', 'lastName','gender'))){
        $request_data = array(
          'apicall'=>'signup',
          'username' => $_POST['username'],
          'email' => $_POST['email'],
          //$password = md5($_POST['password']);
          'password' => $_POST['password'],
          'phonenumber' => $_POST['phonenumber'],
          'firstName' => $_POST['firstName'],
          'lastName' => $_POST['lastName'],
          'gender' => $_POST['gender'],
          'filename' => $_POST['filename']
        );
        //echo "Sign Up Call.\n";
      //}
      break;

      case 'login':
      $request_data = array(
        'apicall'=>'login',
        'username' => $_POST['username'],
        'password' => $_POST['password']
      );
      //echo "Login Call\n";
      break;

      case 'logout':
      $request_data = array(
          'apicall'=>'logout',
          'username' => $_POST['username']
      );
      //echo "Logout Call\n";
      break;

      case 'jobsubmit';
      $request_data = array(
        'apicall'=>'jobsubmit',
        'username' => $_POST['username'],
        'filename' => $_POST['filename'],
        'emlfile' => $_POST['emlfile']
      );
      //echo "Job Submit Call.\n";
      break;

      case 'transcriptrequest';
      $request_data = array(
        'apicall'=>'transcriptrequest',
        'username' => $_POST['username'],
        'filename' => $_POST['filename']
      );
      //echo "Transcript Request Call.\n";
      break;

    }
    //echo "After break\n";
    //print_r($request_data);
    return ($request_data);

  }
  return null;
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
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . " \n";

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

// Functions for writting to file. param is filename, and data.
function WriteToFile( $filename, $data, $path ) {
  $path .= $filename;

  //echo 'Current script owner: ' . get_current_user() . " \n";
  //echo 'Current user_id: ' . getmyuid() . 'Current group_id: ' . getmygid() . " \n";

  if (!file_exists($path)) {
    //echo "File not found, it doesn't exist! \n";
  } else {
    //echo "File already exist, overwritting it. \n";
  }

  if( !$myfile = fopen($path, 'w') ) {
    //echo "Cannot open file ($path) \n";
    return false;
  }

  if( is_writable($path) ) {
    
    if( fwrite($myfile, $data) === false ) {
      //echo "Cannot write to file ($path) \n";
      return false;
    }

    //echo "Success, wrote ($data) to file ($path)\n";
    fclose($myfile);
    return true;

  } else {
    //echo "The file $path is not writable. \n";
    return false;
  }

  return false;
}

// Moves the audio file to working_directory during call.
function JobSubmission( $username, $filename, $emlfile, &$arr ) {
  $conn = getDBConnection();
  Global $working_dir;
  Global $data_dir;
  $user_next_message_id = null;
  $output_filename = null;
  $myfile = null;
  $summarizer_path = '/home/ubuntu/InstallationSummary/summary.py';

  if( isLogin( $conn, $username ) === false ) {
    echo "Unable to submit job, user is not logged in. \n";
    return false;
  }

  $user_next_message_id = FindNextMessageID($conn,$username);
  //echo $filename . " and next message ID " . $user_next_message_id . "! \n";
  // rename audio file to ID#.username.filename.wav
  $output_filename = $user_next_message_id . "." . $username . "." . $filename;
  //echo "Output filename: " . $output_filename . " \n";
  // Move incoming audio to working_dir.
  //WriteToFile($output_filename, $emlfile, $working_dir);
  // Assumesit's sended audio
  // For now only story in /data/... no sub folder.
  $audio_path = $working_dir . $output_filename;
  $transcribe_path = $data_dir . $user_next_message_id . '.txt'; 
  $summary_path =$data_dir . $user_next_message_id . '.sum.txt';
  $command = 'pocketsphinx_continuous -infile ' . $audio_path . ' > ' . $transcribe_path;
  $command_output = null;
  //echo $command;
  exec($command, $command_output);
  //print_r($command_output);

  $command1 = 'python3.5 ' . $summarizer_path . ' ' . $transcribe_path . ' > ' . $summary_path;
  $command_output1 = null;
  exec($command1, $command_output1);

  $arr->summary = $command_output1;
  
  // Create entry in MESSAGES TABLE mysql
  CreateMessageEntry( $conn, $username, $audio_path, $transcribe_path, $summary_path );
  
  // call transribe program
  // direct output of that program to /data_dir/fulltext/ID#.txt
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

function RequestMessageRemovJobSubal( $member, $member_key ) {
  $conn = getDBConnection();
  $success = RemoveMessage( $conn, $member, $member_key );
  closeDBConnection($conn);
  return $success;
}


function processRequest($request_data, &$arr) {
  if( $request_data === null ) {
    echo "parameter is null.\n";
    return false;
  }
  //echo "Printing out data... \n";
  //print_r($request_data);
  $success = null;

  switch($request_data[apicall]) {
    case 'signup':
      $success = CreateAcc($request_data[username],$request_data[password]);
      return $success;
      break;
    case 'login':
      $success = Login($request_data[username],$request_data[password]);
      return $success;
      break;
    case 'logout':
      $success = Logout($request_data[username]);
      return $success;
      break;
    case 'jobsubmit':
      $success = JobSubmission($request_data[username], $request_data[filename], $request_data[emlfile], $arr);
      return $success;
      break;
  }

  echo $request_data[type] . " \n";
  echo " but nothing process! \n";
  return false;
}

?>

 
