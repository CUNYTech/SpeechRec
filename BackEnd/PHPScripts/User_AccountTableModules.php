<?php
// Access specific data, return NULL if nothing found.
function AccessUser_Account( $conn, $member, $member_key, $target_member, $msg ) {
  $sql = "SELECT * FROM User_Account WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false ) {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    $msg = "User Account Accessed.";
    return $row[$target_member];
  }
  else {
    $msg = "User Account Not Accessed.";
    return false; 
  }   
}

// Search User_Account Data existence 
function FindDataUser_Account( $conn, $member, $member_key, $msg ) {
  $sql = "SELECT * FROM User_Account WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false ) {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }

  if( mysqli_num_rows( $result ) > 0 ) {
    $msg = "Found Data in User Account Table.";
    return true;
  }
  else {
    $msg = "Did NOT find Data in User Account Table.";
    return false;    
  }
}

// Injection into mysql User_Account
function InsertIntoUser_Account( $conn, $id, $username, $password, $msg ) {
  $sql = "INSERT INTO User_Account (User_Account_ID, User_Name, Password) VALUES ('$id', '$username', '$password')";

  if( mysqli_query( $conn, $sql ) ) { 
    $msg = "Insert into User Account Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  } 
}

// Modifying mysql User_Account
function ModifyUserAccount( $conn, $member, $member_key, $target_member, $target_member_update, $msg ) {
  $sql = "UPDATE User_Account SET $target_member = '$target_member_update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "User Account Modified Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Delete mysql User_Account
function RemoveUserAccount( $conn, $member, $member_key, $msg ) {
  $sql = "DELETE FROM User_Account WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    $msg = "User Account Removed Successfully.";
    return true;
  }
  else {
    $msg = "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

?>
