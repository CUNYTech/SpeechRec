<?php

$bucketname = 'speechrecaudios';
$e3endpoint = 'https://s3-us-east-2.amazonaws.com/' . $bucketname . '/';

// Returns a Json object that is used for AWS transcription call.
function AWSTranscribeJsonPrep($filename, $mediaformat) {
  Global $e3endpoint;
  $e3mediaurl = $e3endpoint . $filename;

  $subprep = array(
    'MediaFileUri'=> $e3mediaurl
  );

  $subprepjson = json_encode($subprep,JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

  $prep = array(
      'TranscriptionJobName'=> $filename,
      'LanguageCode'=> 'en-US',
      'MediaFormat'=> $mediaformat,
      'Media' => $subprepjson
      //'Media'=> 'https://s3-us-east-2.amazonaws.com/speechrecaudios/' . $filename,
  );

  $prepjson = json_encode($prep, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);

  //return $prepjson;
  return $subprepjson;
}


?>