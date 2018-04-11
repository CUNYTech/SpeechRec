<?php
// Access specific data, return NULL if nothing found.
function AccessUser( $conn, $member, $member_key, $target_member ) {
  $sql = "SELECT * FROM Users WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );

  if( $result === false ) {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
  
  if( mysqli_num_rows( $result ) > 0 ) {
    $row = mysqli_fetch_assoc( $result );
    echo "User Accessed. \n";
    return $row[$target_member];
  }
  else {
    echo "User Not Accessed. \n";
    return false; 
  }   
}

// Search User Data existence, ONLY FOR USERNAME so far, no identifier.
function FindDataUser( $conn, $member, $member_key ) {
  $sql = "SELECT * FROM Users WHERE $member = '$member_key' ";
  $result = mysqli_query( $conn, $sql );
  if( $result === false ) {
    echo "result is false \n";
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }

  if( mysqli_num_rows( $result ) > 0 ) {
    echo "Found Data in User Table. \n";
    return true;
  }
  else {
    echo "Did NOT find Data in User Table. \n";
    return false;    
  }
}


// Injection into mysql User
function InsertIntoUser( $conn, $username, $password ) {
  $sql = "INSERT INTO Users (User_Name, Password) VALUES ('$username', '$password')";

  if( mysqli_query( $conn, $sql ) ) { 
    echo "Insert into User Successfully. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  } 
}

// Modifying mysql Users
function ModifyUser( $conn, $member, $member_key, $target_member, $target_member_update ) {
  $sql = "UPDATE Users SET $target_member = '$target_member_update' WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    echo "User Modified Successfully. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

// Delete mysql Users
function RemoveUser( $conn, $member, $member_key ) {
  $sql = "DELETE FROM Users WHERE $member = '$member_key'";

  if( mysqli_query( $conn, $sql ) ) {
    echo "User Removed Successfully. \n";
    return true;
  }
  else {
    echo "Error: <" . $sql . "> | " . mysqli_error( $conn ) . "\n";
    return false;
  }
}

?>
