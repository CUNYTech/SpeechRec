<?php
include_once './MessagesTableModules.php';

function FindNextID( $conn, $username ) {
    $user_id = AccessUser( $conn, 'User_Name', $username, 'User_ID' );
    echo "Found User ID $user_id \n";
    return 1 + GetNumberOfMessageEntries( $conn, $user_id );
}


?>