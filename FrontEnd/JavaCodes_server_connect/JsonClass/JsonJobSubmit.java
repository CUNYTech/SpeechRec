package JsonClass;

public class JsonJobSubmit {
    public JsonJobSubmit() {
      this.username = "";
      this.password = "";
      this.binary = "";
    }
    public JsonJobSubmit(String name, String pass, String biName, String bi) {
      this.username = name;
      this.password = pass;
      this.binary = bi;
      this.binaryName = biName;
    }

    static String type = "JobSubmit";
    String username;
    String password;
    String binary;
    String binaryName;
}
