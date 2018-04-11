package JsonClass;

public class JsonLogin {
    public JsonLogin() {
      this.username = "";
      this.password = "";
    }
    public JsonLogin(String name, String pass) {
      this.username = name;
      this.password = pass;
    }

    static String type = "Login";
    String username;
    String password;
}
