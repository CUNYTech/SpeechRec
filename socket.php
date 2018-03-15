<?php
  
  error_reporting(E_ALL);  

  /* Allow the script to hang aroud waiting for connections. */
  set_time_limit(0);

  /* Turn on implicit output flushing so we see what we're getting
   * as it comes in. */
  ob_implicit_flush();
  
  $address = "107.77.106.118";  // Your public IP.
  $port = 42131;

  if( ( $sock = socket_create( AF_INET, SOCK_STREAM, SOL_TCP ) ) === false ) {
    echo "socket_create() failed. Reason:" . socket_strerror( socket_last_error() ) . "\n";
  }

  if( socket_bind( $sock, $address, $port ) === false ) {
    echo "socket_bind() failed. Reason: " . socket_strerror( socket_last_error( $sock ) ) . "\n";
  }

  if( socket_listen( $sock, 5 ) === false ) {
    echo "socket_listen() failed. Reason:" . socket_strerror( socket_last_error( $sock ) ) . "\n";
  } //Machine Learning, gets pay alot
    //Get another degree in math and stat, to do machine learning and maybe neruo learning? what course need to be for neuro science

echo "Listening... to port $port\n";

  do {
    if( ( $msgsock = socket_accept( $sock ) ) === false ) {
      echo "socket_accept() failed. Reason: " . socket_strerror( socket_last_error( $sock ) ) . "\n";
      break;
    }
    
    /* Send instructions. Do not start with first char to be '\n' */
    $msg = " \nWelcome to the PHP Test Server. \n" .
           "To quit, type 'quit'. To shut down the server type 'shutdown'.\n";
    socket_write( $msgsock, $msg, strlen( $msg ) );

echo "socket_write() done.\n";
    do {
      if( ( $buf = socket_read( $msgsock, 248, PHP_NORMAL_READ ) ) === false ) {
        echo "socket_read() failed. Reason:" . socket_strerror( socket_last_error( $msgsock ) ) . "\n";
        break 2;
      }  
      if( !$buf = trim( $buf ) ) 
        continue;
      if( $buf == 'quit' )
        break;
      if( $buf == 'shutdown' ) {
        socket_close( $msgsock );
        break 2;
      }
      
echo "Data recieved: $buf.\n";
      $talkback = "PHP: You said '$buf'.\n";
      socket_write( $msgsock, $talkback, strlen( $talkback ) );
      echo "$buf\n";

    } while(true);

    socket_close( $msgsock );
  
  } while (true);
  
echo "Has stop listening... to port $port\n";
?>
