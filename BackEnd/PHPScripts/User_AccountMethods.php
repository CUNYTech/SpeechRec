<?php
include './User_AccountTableFunctions.php';
include './MessagesTableFunctions.php';
include './UserTableFunctions.php';

//MAYBE I SHOULD HAVE A VARIABLE HOLDING ERROR MESSAGE (if any) TO GO INTO FCT AS BE RETURNED BY REFERENCE.

//"Create Account", "Login Request", "Delete Account", "Change Password", "Logout Request".

function CreateAccount( $conn, $username, $password, $msg ) {
  //Check if username already exist, if so, return false, and echo "Username already exists!"
  if( FindDataUser_Account( $conn, "User_Name", $username ) ) {
    $msg = "Username already exists!\n";
    return false;
  }

  //Insert into MySQL
  if( InsertIntoUser_Account( $conn, "2", $username, $password, $msg ) ) {
    $msg = "New User_Account created successfully\n";
    return true;
  }
  else {
    $msg = "New User_Account failed to create\n";
    return false;
  }
}

function LoginRequest( $conn, $username, $password, $msg ) {	//WILL ALSO MODIFY IN TABLE TO ONLINE STATUS
  if( FindDataUser_Account( $conn, "User_Name", $username, $msg ) ) {
    // Find the associated password and see if match with input password.
    if( $password == AccessUser_Account( $conn, "User_Name", $username, "Password", $msg ) ) {
      return true;
    }
    $msg = "Wrong Password!\n";
  }
  else
    $msg = "Username doesn't exist!\n";
  // Username doesn't exist or password is wrong at this point.
  return false;
}

function DeleteAccount( $conn, $username, $password, $msg ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password, $msg ) ) {
    // Delete Account.
    if( RemoveUserAccount( $conn, "User_Name", $username, $msg ) ) {
      $msg = "Removed Account Successfully.\n";
      return true;
    }
    else {
      $msg = "Remove FAILED.\n";
      return false;
    }
  }
  $msg = "Bad Login.\n";
  return false;
}

function ChangePassword( $conn, $username, $password, $new_password, $msg ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password, $msg ) ) {
    // Change Password.
    if( ModifyUserAccount( $conn, "User_Name", $username, "Password", $new_password, $msg ) ) {
      $msg = "Modified Successfully.\n";
      return true;
    }
    else {
      $msg = "Modify FAILED.\n";
      return false;
    }
  }
  $msg = "Bad Login.\n";
  return false;
}

function LogoutRequest( $conn, $username, $msg ) {
//UPDATE USER ACCOUNT AS OFFLINE!
}


?>
