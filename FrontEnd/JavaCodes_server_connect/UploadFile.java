import java.net.URLConnection;
import java.net.HttpURLConnection;
import java.net.URL;
import java.io.*;
import java.nio.file.Files;

public class UploadFile {
  //static String url = "http://localhost/RetrieveUploadPOSTMethod.php";
  static String url = "http://ec2-18-219-242-118.us-east-2.compute.amazonaws.com/RetrieveUploadPOSTMethod.php";
  static String charset = "UTF-8";
  static String param = "value";
  //static File textFile = new File("/path/to/file.txt");
  static File binaryFile = new File("/home/yizongk/CUNYCodes/JavaCodes_server_connect/CloudAtlasPiano.mp3");
  static String boundary = Long.toHexString( System.currentTimeMillis() );   // Just generate some unique random value.
  static String CRLF = "\r\n";  // Line separator required by multipart/form-data.

  public static void upload() throws Exception {
    URLConnection connection = new URL( url ).openConnection();
    connection.setDoOutput(true);
    connection.setRequestProperty( "Content-Type","multipart/form-data; boundary=" + boundary );

    OutputStream output = connection.getOutputStream();
    PrintWriter writer = new PrintWriter( new OutputStreamWriter( output, charset ), true );

    // Send normal param.

      
    // Send text file.

  
    // Send binary file.
    writer.append( "--" + boundary ).append( CRLF );
    writer.append( "Content-Disposition: form-data; name=\"binaryfile\"; filename=\"" + binaryFile.getName() + "\"" ).append( CRLF );
    writer.append( "Content-Type: " + URLConnection.guessContentTypeFromName( binaryFile.getName() ) ).append( CRLF );
    writer.append( "Content-Transfer-Encoding: binary" ).append( CRLF );
    writer.append( CRLF ).flush();
    Files.copy( binaryFile.toPath(), output );
    output.flush();  // Important before continuing with writer!
    writer.append( CRLF ).flush(); // CRLF is important! It indicates end of boundary.
 
    // End of multipart/form-data.
    writer.append( "--" + boundary + "--" ).append( CRLF ).flush();

   /* Request is lazily fired whenever you need to obtain information about response. */
    int responseCode = (( HttpURLConnection ) connection).getResponseCode();
    System.out.println( responseCode );  // Should be 200.

    return;
  }



 
  public static void main(String[] args) {
    try {
      System.out.println("Attempting to upload now.");
      UploadFile.upload();
      System.out.println("Finished, not sure if it worked.");
    } catch (Exception e) {
      e.printStackTrace();
    }
  }
}
