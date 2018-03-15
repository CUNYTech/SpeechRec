<?php
include_once './User_AccountTableFunctions.php';
include_once './MessagesTableFunctions.php';
include_once './UserTableFunctions.php';

//BEFORE DOING ANY OF THE FOLLOWING FCT, NOTE TO SELF, HAVE A CHECK THAT THEY ARE CURRENTLY ONLINE, BEFORE EACH FCT, MUST CHECK THAT THEY ARE ONLINE (that they are logged in).
//IT IS ASSUMED THAT MASTER SCRIPT WILL MAKE SURE BEFORE CALLING ANY OF FOLLOWING FCT THAT USER IS ONLINE (that they are logged in).

//"Job Submission", "Request Audio", "Request Transcript", "Request Summary", " "Remove Message" (Removes audio, text and summary)".

// Assumes that audio file is in working_directory before calling.
function JobSubmission( $conn, $username, $audio_filename, $source_ip ) {
  // Find next audio ID in data_dir, not mysql, cuz they might have different ID#
  // rename audio file to username.ID#.filename.wav
  // Move to data_dir/audio
  // Create entry in MESSAGES TABLE mysql
  // call transribe program
  // direct output of that program to /data_dir/fulltext/username.ID#.filename.txt
  // update transcribe status on message in mysql to done
  // update text_path in mysql
  // call summary program
  // direct output of that program to /data_dir/summary/usernamer.ID#.filename.sum.txt
  // update summary status on message in mysql to done
  // update sum_text_path on message in mysql
  // sends back summary text to original IP.
}

// Assumes $member to be Message_ID, and member_key to be its id number.
//stil need to add column for file name in mysql Messages and then append that to function output.
function RequestAudioPath( $conn, $member_key ) {
  //return AccessMessages( $conn, $member, $member_key, "Audio_Path" );
  return GetAudioPathName( $conn, $member_key );
}

function RequestTextPath( $conn, $member_key ) {
  //return AccessMessages( $conn, $member, $member_key, "Text_Path" );
  return GetTranscriptPathName( $conn, $member_key );
}

function RequestSumTextPath( $conn, $member_key ) {
  //return AccessMessages( $conn, $member, $member_key, "Summarized_Text_Path" );
  return GetSummaryPathName( $conn, $member_key );
}

function RequestMessageRemoval( $conn, $member, $member_key ) {
  return RemoveMessage( $conn, $member, $member_key );
}

?>
