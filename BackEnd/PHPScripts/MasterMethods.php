<?php
include_once './User_AccountMethods.php';
//include_once './MessagesMethods.php';
//include_once './UserMethods.php';

//BEFORE DOING ANY OF THE FOLLOWING FCT, NOTE TO SELF, HAVE A CHECK THAT THEY ARE CURRENTLY ONLINE, BEFORE EACH FCT, MUST CHECK THAT THEY ARE ONLINE (that they are logged in).
//IT IS ASSUMED THAT MASTER SCRIPT WILL MAKE SURE BEFORE CALLING ANY OF FOLLOWING FCT THAT USER IS ONLINE (that they are logged in).

//"Job Submission", "Request Audio", "Request Transcript", "Request Summary", " "Remove Message" (Removes audio, text and summary)".


/* CORE FUNCTIONS */
function getDBConnection() {
  $servername = "localhost";
  $username = "root";
  $password = "SpeechRec";
  $dbname = "SpeechRec";
  
  // Create connection
  $conn = mysqli_connect( $servername, $username, $password );

  // Check connection
  if( !$conn ) {
    echo( "Connection failed: " . mysqli_connect_error() . "\n");

    return false;
  }

  // Access the correct database
  $sql = "USE $dbname";
  if( !mysqli_query( $conn, $sql ) ) {
    echo ( "Error: <" . $sql . "> | " . mysqli_error( $conn ) );

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
function JobSubmission( $conn, $username, $audio_filename, $source_ip, &$msg ) {
  // Find next audio ID in data_dir, not mysql, cuz they might have different ID#
  // rename audio file to username.ID#.filename.wav
  // Move to data_dir/audio
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
}

function CreateAcc( $username, $password ) {  // Create Account ID, must be unique somehow
  $msg = "";
  $conn = getDBConnection();
  $success = CreateAccount($conn, $username, $password, $msg);
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

function Login( $username, $password ) {
  $msg = "";
  $conn = getDBConnection();
  $success = LoginRequest( $conn, $username, $password, $msg );
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

// Assumes $member to be Message_ID, and member_key to be its id number.
//stil need to add column for file name in mysql Messages and then append that to function output.
function RequestAudioPath( $member_key ) {
  $msg = "";
  $conn = getDBConnection();
  $success = GetAudioPathName( $conn, $member_key, $msg );
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

function RequestTextPath( $member_key ) {
  $msg = "";
  $conn = getDBConnection();
  $success = GetTranscriptPathName( $conn, $member_key, $msg );
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

function RequestSumTextPath( $member_key ) {
  $msg = "";
  $conn = getDBConnection();
  $success = GetSummaryPathName( $conn, $member_key, $msg );
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

function RequestMessageRemoval( $member, $member_key ) {
  $msg = "";
  $conn = getDBConnection();
  $success = RemoveMessage( $conn, $member, $member_key, $msg );
  closeDBConnection($conn);
  echo $msg . "\n";
  return $success;
}

?>
