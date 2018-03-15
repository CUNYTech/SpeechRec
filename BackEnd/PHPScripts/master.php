<?php
include './User_AccountOverallFunctions.php';
include './JobsOverallFunctions.php';

$servername = "localhost";
$username = "root";
$password = "SpeechRec";
$dbname = "SpeechRec";
$requesttype = ""; 	// Request type "Create Account", "Request Audio", "Request Transcript", "Request Summary", "Job Submission", "Change Password", "Delete Account", "Remove Message" (Removes audio, text and summary), "Login Request", "Logout Request".

//----------------------------------------------------------------------------
// Create connection
$conn = mysqli_connect( $servername, $username, $password );

// Check connection
if( !$conn ) {
  die( "Connection failed: " . mysqli_connect_error() . "\n");
  
}
//echo "Connected successfully\n";

// Access the correct database
$sql = "USE $dbname";
if( !mysqli_query( $conn, $sql ) )
  die( "Error: <" . $sql . "> | " . mysqli_error( $conn ) );
//----------------------------------------------------------------------------
//InsertIntoMessages( $conn, "2", "yizongk", "xxx.wav", "/home/cunycode/audio", "/home/cunycode/text", "/home/cunycode/summary" );
//echo RequestAudioPath( $conn, "2" ) . "\n";
//echo RequestTextPath( $conn, "2" ) . "\n";
//echo RequestSumTextPath( $conn, "2" ) . "\n";
//RequestMessageRemoval( $conn, "Message_ID", "2" );
//if( DeleteAccount( $conn, "yizo", "hel" ) )
//  echo "Deleted successfully!\n";
//else
 // echo "Not Deleted!\n";
//if(CreateAccount( $conn, "yizo", "hel" ))
//  echo "Created Successfully!\n";
//if( ChangePassword( $conn, "yizo", "newpass", "hel" ) )
//  echo "Pass changed successfully!\n";
//$temp=GetTranscriptPathName( $conn, "3" );
//if(is_null($temp))
//  echo "NULL\n";
//else
//  echo "$temp\n";
/*
// Checks for the type of request
switch ( $requesttype ) {
  case "Create Account":	//Expects this format: ""
    CreateAccount($conn, $username, $password);
    break;
  case "Login Request":
    Login
    break;
  case "Logout Request":
    break;
  case "Change Password":
    break;
  case "Delete Account":
    break;
  case "Job Submission":
    break;
  case "Request Audio":
    break;
  case "Request Transcript":
    break;
  case "Request Summary":
    break;
  case "Remove Message":
    break;
}
*/








//InsertIntoUser_Account($conn,"123","yizongk","omg");
//InsertIntoMessages( $conn, "44", "yizongk", "cat", "/home/ubuntu/data_dir/cat.wav", "/home/ubuntu/data_dir/cat.txt", "/home/ubuntu/data_dir/cat.sum.txt" );
//InsertIntoUser( $conn, "1", "yi zong", "kuang", "347-525-5576", "yizongk@gmail.com", "123", "44" );
//ModifyUserAccount( $conn, "123", "Password", "newpass!" );
//ModifyMessages( $conn, "44", "Audio_Path", "/home" );			// ONLY User's ID can be changed, other two's ID are referenced by User, so their ID cannot be modified
//ModifyUser( $conn, "1", "Last_Name", "Rodin" );
//RemoveUser( $conn, "1" );            //SINCE USERACC AND MESSAGE HAVE DATA CONNECTED TO USER, USER must be deleted first, before the other two can be deleted.
//RemoveUserAccount( $conn, "123" );
//RemoveMessage( $conn, "44" );
//PrintAudioPathName( $conn, "44" ) . "\n";
//PrintTranscriptPathName( $conn, "44" ) . "\n";
//PrintSummaryPathName( $conn, "44" ) . "\n";


// Close connection
mysqli_close( $conn );
//echo "Connection closed\n";
?>
