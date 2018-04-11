package JsonClass;

public class JsonLogout {
    public JsonLogout() {
      this.username = "";
      this.password = "";
    }
    public JsonLogout(String name, String pass) {
      this.username = name;
      this.password = pass;
    }

    static String type = "Logout";
    String username;
    String password;
}
