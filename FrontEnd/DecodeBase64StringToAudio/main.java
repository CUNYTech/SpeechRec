import java.io.*;
import java.nio.charset.StandardCharsets;
import java.util.Arrays;
import java.util.Base64;

import javax.swing.text.Utilities;


public class main{

	public void decodeBase64StringToAudio(String toDecode, String pathToSavedOutput){
		
		byte[] decoded = Base64.getDecoder().decode(toDecode.replace("\n", ""));
		
		//System.out.println("Decoded. " + Arrays.toString(decoded));
		
		
		// Save audio File
		File out = new File(pathToSavedOutput);
		FileOutputStream os;
		
		try {
			os = new FileOutputStream(out, true);
			try {
				os.write(decoded);
				os.close();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
	
	public String readExampleBase64EncodedString(String pathToInputTXTFile) throws IOException{
		
		// Read Base64 encoded string saved in .txt file
		File file = new File(pathToInputTXTFile);
		  try {
					
				FileInputStream fis = new FileInputStream(file);
				byte[] data = new byte[ (int) file.length() ];
				try {
					fis.read(data);
					
					} catch (IOException e) {
						// TODO Auto-generated catch block
						e.printStackTrace();
					}
					
					String str = new String(data);
					fis.close();
				
					// return encoded string in Base64 format
					return str;
				
				} catch (FileNotFoundException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
		  
		   return pathToInputTXTFile;
		
	}
	
	public static void main(String[] args) throws IOException{
		// TODO Auto-generated method stub
			
			//write fill paths
			String input = ".../example_base64string.txt";
			String output = ".../example_output655.wav";
		
			main test = new main();
			//read from example file
			String base64stringinput = test.readExampleBase64EncodedString(input);
			
			//Print Base64 encoded string
			System.out.println("Base64 encoded string:\n\n" + base64stringinput);
			
			//Call a function to get audio file. Func arguments are Base64 string, and location to save audio file
			test.decodeBase64StringToAudio(base64stringinput, output);
			
			//File saved
			System.out.println("\nAudio file saved.");
	
	}

}
