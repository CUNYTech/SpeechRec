import java.util.Scanner;
import java.net.Socket;
import java.io.PrintStream;
import java.net.UnknownHostException;
import java.io.IOException;
import java.io.*;
import java.net.*;

public class Fedex {
  //static String hostname = "146.95.216.82";
  static String hostname = "ec2-18-219-242-118.us-east-2.compute.amazonaws.com";
  //static String hostname = "18.219.242.118";
  static int port = 42131;

  public static void main( String args[] ) throws UnknownHostException, IOException {
    Socket s = new Socket(hostname, port);
    PrintWriter out = new PrintWriter( s.getOutputStream(), true );
    BufferedReader in = new BufferedReader( new InputStreamReader( s.getInputStream() ) );
    Scanner sc = new Scanner( System.in ); 
    String out_data, in_data;
    
    // Back and forth play.
    do{
      System.out.println( "Enter any string: " );
      out_data = sc.nextLine();
      out.println( out_data );
      in_data = in.readLine();
      System.out.println( in_data );
    } while( !out_data.equals( "quit" ) && !out_data.equals( "shutdown" ) );
    
    // Close connection.
    s.close();
    out.close();
    in.close();
    System.out.println( "Connection closed." );
  }
}

