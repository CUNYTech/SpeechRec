<?php
// Access specific data, return NULL if nothing found.
function AccessUser( $conn, $member, $member_key, $target_member ) {
  $sql = "SELECT * FROM User WHERE $member = '$member_key' ";
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

// Search Messages Data existence 
function FindDataUser( $conn, $member, $member_key ) {
  $sql = "SELECT * FROM User WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );
  
  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) 
    return true;
  else 
    return false;    
}

// Injection into mysql User
function InsertIntoUser( $conn, $user_id, $firstname, $lastname, $phone_number, $email, $user_acc_id, $message_id ) {
  $sql = "INSERT INTO User (User_ID, First_Name, Last_Name, Phone_Number, Email, User_Account_ID, Message_ID) VALUES ('$user_id', '$firstname', '$lastname', '$phone_number', '$email', '$user_acc_id', '$message_id')";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}


// Modifying mysql User
function ModifyUser( $conn, $member, $member_key, $target_member, $update ) {
  $sql = "UPDATE User SET $target_member = '$update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Delete mysql User
function RemoveUser( $conn, $member, $member_key ) {
  $sql = "DELETE FROM User WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

?>
