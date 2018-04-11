import JsonClass.JsonLogin;
import JsonClass.JsonJobSubmit;
import JsonClass.JsonLogout;
import JsonClass.JsonCreateAcc;

import java.lang.Exception;
import java.nio.charset.Charset;
import java.io.OutputStream;
import java.io.InputStream;
import java.io.StringWriter;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;
import org.apache.http.entity.StringEntity;
import org.apache.http.client.HttpClient;
import org.apache.http.impl.client.HttpClientBuilder;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.HttpResponse;
import org.apache.http.HeaderIterator;
import org.apache.http.Header;
import org.apache.commons.io.IOUtils;

public class JsonPOST {  
    // Constructor,allow the serialization of static fields then creates a Gson instance based on the current config.
  JsonPOST(JsonCreateAcc data) throws Exception {
      GsonBuilder gsonBuilder = new GsonBuilder();
      gsonBuilder.excludeFieldsWithModifiers( java.lang.reflect.Modifier.TRANSIENT );
      Gson gson = gsonBuilder.create();
      jsonString = gson.toJson( data );
      postingString = new StringEntity( jsonString );  //gson.tojson() converts your class to json.
  
      /* Setting up the connection */
      request = new HttpPost(serverURL);
      request.setHeader("Accept","application/json");
      request.setHeader("Content-type","application/json");
      request.setEntity(postingString);
  }
  JsonPOST(JsonLogin data) throws Exception {
    GsonBuilder gsonBuilder = new GsonBuilder();
    gsonBuilder.excludeFieldsWithModifiers( java.lang.reflect.Modifier.TRANSIENT );
    Gson gson = gsonBuilder.create();
    jsonString = gson.toJson( data );
    postingString = new StringEntity( jsonString );  //gson.tojson() converts your class to json.

    /* Setting up the connection */
    request = new HttpPost(serverURL);
    request.setHeader("Accept","application/json");
    request.setHeader("Content-type","application/json");
    request.setEntity(postingString);
  }
  JsonPOST(JsonLogout data) throws Exception {
    GsonBuilder gsonBuilder = new GsonBuilder();
    gsonBuilder.excludeFieldsWithModifiers( java.lang.reflect.Modifier.TRANSIENT );
    Gson gson = gsonBuilder.create();
    jsonString = gson.toJson( data );
    postingString = new StringEntity( jsonString );  //gson.tojson() converts your class to json.

    /* Setting up the connection */
    request = new HttpPost(serverURL);
    request.setHeader("Accept","application/json");
    request.setHeader("Content-type","application/json");
    request.setEntity(postingString);
  }
  JsonPOST(JsonJobSubmit data) throws Exception {
    GsonBuilder gsonBuilder = new GsonBuilder();
    gsonBuilder.excludeFieldsWithModifiers( java.lang.reflect.Modifier.TRANSIENT );
    Gson gson = gsonBuilder.create();
    jsonString = gson.toJson( data );
    postingString = new StringEntity( jsonString );  //gson.tojson() converts your class to json.

    /* Setting up the connection */
    request = new HttpPost(serverURL);
    request.setHeader("Accept","application/json");
    request.setHeader("Content-type","application/json");
    request.setEntity(postingString);
  }
  JsonPOST() throws Exception {
    System.out.println("Empty constructor initiated, not recommanded, this class is empty!");
    /* Setting up the connection */
    request = new HttpPost(serverURL);
    request.setHeader("Accept","application/json");
    request.setHeader("Content-type","application/json");
    request.setEntity(postingString);
  }

    // Data Members
  static String serverURL = "http://localhost/master.php";
  HttpClient httpClient = HttpClientBuilder.create().build(); 
  StringEntity postingString;
  HttpPost request;
  String jsonString;
  String serverReplyJson;

    // Methods
  /* Sending the json out. */
  public HttpResponse fireAway() throws Exception {
    return httpClient.execute(request);
  } 
  /* Response code status */
  public String getResponse(HttpResponse response) throws Exception {
    System.out.println("Response Code          : "+response.getStatusLine().getStatusCode());
    System.out.println("Response Reason Phrase : "+response.getStatusLine().getReasonPhrase());
    System.out.println("Response Message if any: "+response.getEntity().getContent());

    for(HeaderIterator header_ptr = request.headerIterator(); header_ptr.hasNext(); ) {
      Header tmp = header_ptr.nextHeader();
      System.out.println(tmp.getName() + "*+++*" + tmp.getValue());
    }

    StringWriter writer = new StringWriter();
    IOUtils.copy(response.getEntity().getContent(), writer, Charset.defaultCharset());
    return writer.toString();
  }
  public void whatIsSendOut() throws Exception {
    GsonBuilder gsonBuilder = new GsonBuilder();
    gsonBuilder.excludeFieldsWithModifiers( java.lang.reflect.Modifier.TRANSIENT );
    Gson gson = gsonBuilder.create();
    System.out.println("This is the json sended out: \n" + jsonString );
    
    return;
  }
  public void execute() throws Exception {
    HttpResponse response = this.fireAway();
    serverReplyJson = this.getResponse(response);
    this.whatIsSendOut();
  
    return;
  } 
  public String getJsonResponse() {
    return serverReplyJson;
  }
}