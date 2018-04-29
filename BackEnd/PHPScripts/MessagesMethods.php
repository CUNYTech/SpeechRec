<?php
include_once './MessagesTableModules.php';

function FindNextMessageID( $conn, $username ) {
    $user_id = AccessUser( $conn, 'User_Name', $username, 'User_ID' );
    //echo "Found User ID $user_id \n";
    return 1 + GetNumberOfMessageEntriesForUser( $conn, $user_id );
}

function CreateMessageEntry( $conn, $username, $audio_path, $transcribe_path, $summary_path ) {
    $user_id = AccessUser( $conn, 'User_Name', $username, 'User_ID' );
    return CreateMessage($conn, $user_id, $audio_path, $transcribe_path, $summary_path);
}

function GetLastesSummaryPath( $conn ) {
    return GetLatestMessageFromWholeMessageTable( $conn, 'Summarized_Text_Path' );
}



?>