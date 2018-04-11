//import JsonPOST;
import JsonClass.JsonLogin;
import JsonClass.JsonJobSubmit;
import JsonClass.JsonLogout;
import JsonClass.JsonCreateAcc;
import UrlReader.URLReader;

import org.apache.http.HttpResponse;
import net.iharder.Base64;

import java.lang.Exception;
import java.io.File;
import java.nio.file.Files;
import java.nio.file.Path;
import java.io.OutputStream;


class Interface {
    static public String binaryPathName = "./CloudAtlasPiano.mp3";
    static File file = new File(binaryPathName);
    static Files files;
    public static void main(String[] args) throws Exception {
        JsonPOST jsonpost = new JsonPOST(new JsonCreateAcc("login name","login pass"));
        JsonPOST jsonpost1 = new JsonPOST(new JsonLogin("login name","login pass"));
        JsonPOST jsonpost2 = new JsonPOST(new JsonLogout("login name","login pass"));
        JsonPOST jsonpost3 = new JsonPOST(new JsonJobSubmit("login name","login pass","fffilename",Base64.encodeObject(files.readAllBytes(file.toPath()))));

        
        jsonpost.execute();
        //jsonpost1.execute();
        //jsonpost2.execute();
        //jsonpost3.execute();
        String jsonOut = jsonpost.getJsonResponse();
        //String jsonOut = jsonpost1.getJsonResponse();
        //String jsonOut = jsonpost2.getJsonResponse();
        //String jsonOut = jsonpost3.getJsonResponse();
        System.out.println("\n\n Here's the echos from the server...");
        System.out.println("-----------------------------------------");
        System.out.println(jsonOut);
        return;
    }
}