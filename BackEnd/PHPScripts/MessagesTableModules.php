<?php

// Returns the number of entries a User has in the Message table.
function GetNumberOfMessageEntriesForUser( $conn, $user_id ) {
  $sql = "SELECT * FROM Messages WHERE User_ID  = '$user_id' ";
  $result = mysqli_query( $conn, $sql );
  
  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
  
  return mysqli_num_rows( $result );
}

// Returns the number of entries in the Message table.
function GetNumberOfMessageEntriesTotal( $conn ) {
  $sql = "SELECT * FROM Messages";
  $result = mysqli_query( $conn, $sql );
  
  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
  
  return mysqli_num_rows( $result );
}

// Access specific data, return falseL if nothing found.
function AccessMessages( $conn, $member, $member_key, $target_member ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    echo "Message Accessed. \n";
    return $row[$target_member];
  }
  else {
    echo "Message Not Found. \n";
    return false; 
  }   
}

// Accessing Lastest entry's member.
function GetLatestMessageFromWholeMessageTable( $conn, $target_member ) {
  $latest_msg_id = GetNumberOfMessageEntriesTotal( $conn );
  return AccessMessages( $conn, 'Message_ID', $latest_msg_id, $target_member );
}

// Generic Search Messages Data existence 
function FindDataMessages( $conn, $member, $member_key ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql ) ;

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    echo "Message Found. \n";
    return true;
  }
  else {
    echo "Message Not Found. \n";
    return false;  
  }  
}

// Create whole Message Entry
function CreateMessage( $conn, $user_id, $audio_path, $transcribe_path, $summary_path ) {
  $sql = "INSERT INTO Messages (User_ID, Audio_Path, Text_Path, Summarized_Text_Path) VALUES ('$user_id', '$audio_path', '$transcribe_path', '$summary_path')";

  if( mysqli_query( $conn, $sql ) ) {
    echo "Insert Complete. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Injection into mysql Messages
function InsertIntoMessages( $conn, $user_id, $audio_path ) {
  $sql = "INSERT INTO Messages (User_ID, Audio_Path) VALUES ('$id', '$audio_path')";

  if( mysqli_query( $conn, $sql ) ) {
    echo "Insert Complete. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Modifying mysql Messages
function ModifyMessages( $conn, $member, $member_key, $member_update, $update ) {
  $sql = "UPDATE Messages SET $member_update = '$update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    echo "Message Modified. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Delete mysql Message
function RemoveMessage( $conn, $member, $member_key ) {
  $sql = "DELETE FROM Messages WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    echo "Messaged Removed. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Request for audio's pathname, return false if none are found. Based on Message_ID
function GetAudioPathName( $conn, $id ) {
  $sql = "SELECT Audio_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    echo "Audio Path Retrieved. \n";
    return $row['Audio_Path'];
  }
  else {
    echo "Audio Path not found. \n";
    return false;
  }
}

// Request for transcription's pathname, return false if none are found.
function GetTranscriptPathName( $conn, $id ) {
  $sql = "SELECT Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
 
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    echo "Transcript Path Retrieved. \n";
    return $row['Text_Path'];
  }
  else {
    echo "Transcript Path Not Found. \n";
    return false;
  }
}

// Request for summary's pathname, return false if none are found.
function GetSummaryPathName( $conn, $id ) {
  $sql = "SELECT Summarized_Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    echo "Summary Path Found. \n";
    return $row['Summarized_Text_Path'];
  }
  else {
    echo "Summary Path Not Found. \n";
    return false;
  }
}
?>
