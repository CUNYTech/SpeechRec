<?php
include_once './UsersTableModules.php';

//MAYBE I SHOULD HAVE A VARIABLE HOLDING ERROR MESSAGE (if any) TO GO INTO FCT AS BE RETURNED BY REFERENCE.

//"Create Account", "Login Request", "Delete Account", "Change Password", "Logout Request".

function CreateAccount( $conn, $username, $password, &$msg ) {
  //Check if username already exist, if so, return false, and echo "Username already exists!"
  if( FindDataUser( $conn, "User_Name", $username ) ) {
    $msg = "Username already exists!\n";
    return false;
  }

  //Insert into MySQL
  if( InsertIntoUser( $conn, $username, $password, $msg ) ) {
    $msg = "New User created successfully\n";
    return true;
  }
  else {
    $msg = "New User failed to create\n";
    return false;
  }
}

function SetOnline( $conn, $username, &$msg ) {
  return ModifyUser($conn,"User_Name",$username,"Online_Status", 1, $msg);
}

function SetOffline( $conn, $username, &$msg ) {
  return ModifyUser($conn,"User_Name",$username,"Online_Status", 0, $msg);
}

function LoginRequest( $conn, $username, $password, &$msg ) {	//WILL ALSO MODIFY IN TABLE TO ONLINE STATUS
  if( FindDataUser( $conn, "User_Name", $username, $msg ) ) {
    // Find the associated password and see if match with input password.
    if( $password == AccessUser( $conn, "User_Name", $username, "Password", $msg ) ) {
      return SetOnline($conn,$username,$msg);
    }
    $msg = "Wrong Password!\n";
  }
  else
    $msg = "Username doesn't exist!\n";
  // Username doesn't exist or password is wrong at this point.
  return false;
}

function DeleteUser( $conn, $username, $password, &$msg ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password, $msg ) ) {
    // Delete Account.
    if( RemoveUser( $conn, "User_Name", $username, $msg ) ) {
      $msg = "Removed User Successfully.\n";
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

function ChangePassword( $conn, $username, $password, $new_password, &$msg ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password, $msg ) ) {
    // Change Password.
    return ModifyUser( $conn, "User_Name", $username, "Password", $new_password, $msg );
  }
  $msg = "Bad Login.\n";
  return false;
}

function LogoutRequest( $conn, $username, &$msg ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password, $msg ) ) {
    // Log out.
    return ModifyUser( $conn, "User_Name", $username, "Online_Status", 0, $msg );
  }
  $msg = "Bad Login.\n";
  return false;
}


?>
