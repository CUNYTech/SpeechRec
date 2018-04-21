<?php

$bucketname = 'speechrecaudios';
$e3endpoint = 'https://s3-us-east.amazonaws.com/' . $bucketname;

// Returns a Json object that is used for AWS transcription call.
function AWSTranscribeJsonPrep($filename, $mediaformat) {
  Global $e3endpoint;
  $e3mediaurl = $e3endpoint . $filename;

  $subprep = array(
    'MediaFileUri'=> $e3mediaurl
  );

  $subprepjson = json_encode($subprep);

  $prep = array(
      'TranscriptionJobName'=> $filename,
      'LanguageCode'=> 'en-US',
      'MediaFormat'=> $mediaformat,
      'Media' => $subprepjson
  );

  $prepjson = json_encode($prep);

  return $prepjson;
}


?>