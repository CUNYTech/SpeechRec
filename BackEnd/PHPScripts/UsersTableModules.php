<?php
// Access specific data, return NULL if nothing found.
function AccessUser( $conn, $member, $member_key, $target_member, &$msg ) {
  $sql = "SELECT * FROM Users WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false ) {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "User Accessed.";
    return $row[$target_member];
  }
  else {
    $msg = "User Not Accessed.";
    return false; 
  }   
}

// Search User Data existence 
function FindDataUser( $conn, $member, $member_key, &$msg ) {
  $sql = "SELECT * FROM Users WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false ) {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }

  if( mysqli_num_rows( $result ) > 0 ) {
    $msg = "Found Data in User Table.";
    return true;
  }
  else {
    $msg = "Did NOT find Data in User Table.";
    return false;    
  }
}

// Injection into mysql User
function InsertIntoUser( $conn, $username, $password, &$msg ) {
  $sql = "INSERT INTO Users (User_Name, Password) VALUES ('$username', '$password')";

  if( mysqli_query( $conn, $sql ) ) { 
    $msg = "Insert into User Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  } 
}

// Modifying mysql Users
function ModifyUser( $conn, $member, $member_key, $target_member, $target_member_update, &$msg ) {
  $sql = "UPDATE Users SET $target_member = '$target_member_update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "User Modified Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Delete mysql Users
function RemoveUser( $conn, $member, $member_key, &$msg ) {
  $sql = "DELETE FROM Users WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "User Removed Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

?>
