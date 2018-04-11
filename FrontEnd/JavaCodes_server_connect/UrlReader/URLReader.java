package UrlReader;

import java.net.URL;
import java.io.BufferedReader;
import java.io.InputStreamReader;

public class URLReader {

    public URLReader(String url_name_param) {
        url_name = url_name_param;
    }

    public String getUrlName() {
        return url_name;
    }

    public String getResponse() {
        return response;
    }

    private String url_name;
    private String response;
    BufferedReader in;

    // Only reads one line per call.
    public void listen() throws Exception {
        URL url = new URL(url_name);
        in = new BufferedReader( new InputStreamReader( url.openStream() ) );

        //response = in.readLine();
    }
    public void report() throws Exception {
        System.out.println("Ran");
        while ((response = in.readLine()) != null)
            System.out.println(response);
    }
    public void stopListen() throws Exception {
        in.close();
    }
}