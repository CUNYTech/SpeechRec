<?php
// Access specific data, return falseL if nothing found.
function AccessMessages( $conn, $member, $member_key, $target_member, &$msg ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "Message Accessed.";
    return $row[$target_member];
  }
  else {
    $msg = "Message Not Found.";
    return false; 
  }   
}

// Generic Search Messages Data existence 
function FindDataMessages( $conn, $member, $member_key, &$msg ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql ) ;

  if( $result === false )
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $msg = "Message Found.";
    return true;
  }
  else {
    $msg = "Message Not Found.";
    return false;  
  }  
}

// Injection into mysql Messages
function InsertIntoMessages( $conn, $user_id, $audio_path, &$msg ) {
  $sql = "INSERT INTO Messages (User_ID, Audio_Path) VALUES ('$id', '$audio_path')";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "Insert Complete.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Modifying mysql Messages
function ModifyMessages( $conn, $member, $member_key, $member_update, $update, &$msg ) {
  $sql = "UPDATE Messages SET $member_update = '$update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "Message Modified.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Delete mysql Message
function RemoveMessage( $conn, $member, $member_key, &$msg ) {
  $sql = "DELETE FROM Messages WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "Messaged Removed.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Request for audio's pathname, return false if none are found. Based on Message_ID
function GetAudioPathName( $conn, $id, &$msg ) {
  $sql = "SELECT Audio_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "Audio Path Retrieved.";
    return $row['Audio_Path'];
  }
  else {
    $msg = "Audio Path not found.";
    return false;
  }
}

// Request for transcription's pathname, return false if none are found.
function GetTranscriptPathName( $conn, $id, &$msg ) {
  $sql = "SELECT Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
 
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "Transcript Path Retrieved.";
    return $row['Text_Path'];
  }
  else {
    $msg = "Transcript Path Not Found.";
    return false;
  }
}

// Request for summary's pathname, return false if none are found.
function GetSummaryPathName( $conn, $id, &$msg ) {
  $sql = "SELECT Summarized_Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "Summary Path Found.";
    return $row['Summarized_Text_Path'];
  }
  else {
    $msg = "Summary Path Not Found.";
    return false;
  }
}
?>
