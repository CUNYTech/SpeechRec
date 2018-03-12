<?php
include './User_AccountTableFunctions.php';
include './MessagesTableFunctions.php';
include './UserTableFunctions.php';

//MAYBE I SHOULD HAVE A VARIABLE HOLDING ERROR MESSAGE (if any) TO GO INTO FCT AS BE RETURNED BY REFERENCE.

//"Create Account", "Login Request", "Delete Account", "Change Password", "Logout Request".

function CreateAccount( $conn, $username, $password ) {
  //Check if username already exist, if so, return false, and echo "Username already exists!"
  if( FindDataUser_Account( $conn, "User_Name", $username ) ) {
    echo "Username already exists!\n";
    return false;
  }

  //Insert into MySQL
  if( InsertIntoUser_Account( $conn, "2", $username, $password ) ) {
    echo "New User_Account created successfully\n";
    return true;
  }
  else {
    echo "New User_Account failed to create\n";
    return false;
  }
}

function LoginRequest( $conn, $username, $password ) {	//WILL ALSO MODIFY IN TABLE TO ONLINE STATUS
  if( FindDataUser_Account( $conn, "User_Name", $username ) ) {
    // Find the associated password and see if match with input password.
    if( $password == AccessUser_Account( $conn, "User_Name", $username, "Password" ) ) {
      return true;
    }
    echo"Wrong Password!\n";
  }
  else
    echo "Username doesn't exist!\n";
  // Username doesn't exist or password is wrong at this point.
  return false;
}

function DeleteAccount( $conn, $username, $password ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password ) ) {
    // Delete Account.
    if( RemoveUserAccount( $conn, "User_Name", $username ) ) {
      echo "Removed Account Successfully.\n";
      return true;
    }
    else {
      echo "Remove FAILED.\n";
      return false;
    }
  }
  echo "Bad Login.\n";
  return false;
}

function ChangePassword( $conn, $username, $password, $new_password ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password ) ) {
    // Change Password.
    if( ModifyUserAccount( $conn, "User_Name", $username, "Password", $new_password ) ) {
      echo "Modified Successfully.\n";
      return true;
    }
    else {
      echo "Modify FAILED.\n";
      return false;
    }
  }
  echo "Bad Login.\n";
  return false;
}

function LogoutRequest( $conn, $username ) {
//UPDATE USER ACCOUNT AS OFFLINE!
}


?>
