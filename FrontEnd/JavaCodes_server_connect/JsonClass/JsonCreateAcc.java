package JsonClass;

public class JsonCreateAcc {
    public JsonCreateAcc() {
        this.username = "";
        this.password = "";
      }
      public JsonCreateAcc(String name, String pass) {
        this.username = name;
        this.password = pass;
      }
  
      static String type = "CreateAcc";
      String username;
      String password;
}