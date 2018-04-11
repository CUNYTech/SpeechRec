<?php
include_once './UsersTableModules.php';

//MAYBE I SHOULD HAVE A VARIABLE HOLDING ERROR MESSAGE (if any) TO GO INTO FCT AS BE RETURNED BY REFERENCE.

//"Create Account", "Login Request", "Delete Account", "Change Password", "Logout Request".

function CreateAccount( $conn, $username, $password ) {
  //Check if username already exist, if so, return false, and echo "Username already exists!"
  if( FindDataUser( $conn, "User_Name", $username ) ) {
    echo "Username already exists! \n";
    return false;
  }

  //Insert into MySQL
  if( InsertIntoUser( $conn, $username, $password ) ) {
    echo "New User created successfully \n";
    return true;
  }
  else {
    echo "New User failed to create \n";
    return false;
  }
}

function SetOnline( $conn, $username ) {
  return ModifyUser($conn,"User_Name",$username,"Online_Status", 1 );
}

function SetOffline( $conn, $username ) {
  return ModifyUser($conn,"User_Name",$username,"Online_Status", 0 );
}

function LogoutRequest( $conn, $username ) {
  // Check if User exists.
  if( !FindDataUser( $conn, "User_Name", $username ) ) {
    echo "Username doesn't exist. \n";
    return false;
  }
  // Check If user is online.
  if( AccessUser( $conn, "User_Name", $username, "Online_Status" ) == 1 ) {
    echo "User is online and will now be logged off. \n";
    SetOffline($conn,$username,$msg);
    return true;
  }
  echo "User is already logged off. \n";
  return true;
}

function LoginRequest( $conn, $username, $password ) {	//WILL ALSO MODIFY IN TABLE TO ONLINE STATUS
  if( FindDataUser( $conn, "User_Name", $username ) ) {
    // Find the associated password and see if match with input password.
    if( $password == AccessUser( $conn, "User_Name", $username, "Password" ) ) {
      return SetOnline($conn,$username);
    }
    echo "Wrong Password! \n";
  }
  else
    echo "Username doesn't exist !\n";
  // Username doesn't exist or password is wrong at this point.
  return false;
}

function DeleteUser( $conn, $username, $password ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password ) ) {
    // Delete Account.
    if( RemoveUser( $conn, "User_Name", $username ) ) {
      echo "Removed User Successfully. \n";
      return true;
    }
    else {
      echo "Remove FAILED. \n";
      return false;
    }
  }
  echo "Bad Login. \n";
  return false;
}

function ChangePassword( $conn, $username, $password, $new_password ) {
  // Request Login credential
  if( LoginRequest( $conn, $username, $password ) ) {
    // Change Password.
    return ModifyUser( $conn, "User_Name", $username, "Password", $new_password );
  }
  echo "Bad Login. \n";
  return false;
}

?>
