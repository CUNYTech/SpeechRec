<?php
// Access specific data, return NULL if nothing found.
function AccessUser_Account( $conn, $member, $member_key, $target_member ) {
  $sql = "SELECT * FROM User_Account WHERE $member = '$member_key' ";
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

// Search User_Account Data existence 
function FindDataUser_Account( $conn, $member, $member_key ) {
  $sql = "SELECT * FROM User_Account WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false )
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";

  if( mysqli_num_rows( $result ) > 0 ) 
    return true;
  else 
    return false;    
}

// Injection into mysql User_Account
function InsertIntoUser_Account( $conn, $id, $username, $password ) {
  $sql = "INSERT INTO User_Account (User_Account_ID, User_Name, Password) VALUES ('$id', '$username', '$password')";

  if( mysqli_query( $conn, $sql ) ) 
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  } 
}

// Modifying mysql User_Account
function ModifyUserAccount( $conn, $member, $member_key, $target_member, $target_member_update ) {
  $sql = "UPDATE User_Account SET $target_member = '$target_member_update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Delete mysql User_Account
function RemoveUserAccount( $conn, $member, $member_key ) {
  $sql = "DELETE FROM User_Account WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) )
    return true;
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

?>
