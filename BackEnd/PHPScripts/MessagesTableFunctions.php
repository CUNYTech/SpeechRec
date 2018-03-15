<?php
// Access specific data, return NULL if nothing found.
function AccessMessages( $conn, $member, $member_key, $target_member ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    return $row[$target_member];
  }
  else 
    return NULL;    
}

// Generic Search Messages Data existence 
function FindDataMessages( $conn, $member, $member_key ) {
  $sql = "SELECT * FROM Messages WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql ) ;

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) 
    return true;
  else 
    return false;    
}

// Injection into mysql Messages
function InsertIntoMessages( $conn, $id, $username, $filename, $audio_path, $text_path, $summary_path ) {
  $sql = "INSERT INTO Messages (Message_ID, Audio_Path, Text_Path, Summarized_Text_Path) VALUES ('$id', '$audio_path', '$text_path', '$summary_path')";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Modifying mysql Messages
function ModifyMessages( $conn, $member, $member_key, $member_update, $update ) {
  $sql = "UPDATE Messages SET $member_update = '$update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Generic Delete mysql Message
function RemoveMessage( $conn, $member, $member_key ) {
  $sql = "DELETE FROM Messages WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Request for audio's pathname, return NULL if none are found. Based on Message_ID
function GetAudioPathName( $conn, $id ) {
  $sql = "SELECT Audio_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    return $row['Audio_Path'];
  }
  else
    return NULL;
}

// Request for transcription's pathname, return NULL if none are found.
function GetTranscriptPathName( $conn, $id ) {
  $sql = "SELECT Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
 
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    return $row['Text_Path'];
  }
  else
    return NULL;
}

// Request for summary's pathname, return NULL if none are found.
function GetSummaryPathName( $conn, $id ) {
  $sql = "SELECT Summarized_Text_Path FROM Messages WHERE Message_ID = '$id'";
  $result =  mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    return $row['Summarized_Text_Path'];
  }
  else
    return NULL;
}
?>
