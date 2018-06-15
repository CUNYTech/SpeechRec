package com.example.kasinets.speechrecandroidapp;

import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.regex.Pattern;
import java.util.HashMap;



import static android.widget.Toast.LENGTH_LONG;
import static android.widget.Toast.makeText;

public class SignupActivity extends AppCompatActivity {

    private EditText userPhone, userfName, userlName, userEmail, userPass, userConfirmPass;
    private String phone, fName, lName, email, pass, confirmPass;
    private Button account;

    private String output, result;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup);

        userPhone = (EditText) findViewById(R.id.txtPhone);
        userfName = (EditText) findViewById(R.id.txtFirstName);
        userlName = (EditText) findViewById(R.id.txtLastName);
        userEmail = (EditText) findViewById(R.id.txtEmail);
        userPass = (EditText) findViewById(R.id.txtPass);
        userConfirmPass = (EditText) findViewById(R.id.txtConfirmPass);
        account = (Button) findViewById(R.id.btn_Account);

        // Need this following bit to allow networking operation in main thread and avoid calling this in a thread of Asynch class
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                .permitAll().build();
        StrictMode.setThreadPolicy(policy);

        account.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                createAccount();
            }
        });
    }


    public void createAccount() {


        //creating request parameters
        //HashMap<String, String> params = new HashMap<>();
        //params.put("username", email);
        //params.put("email", email);
        //params.put("password", pass);
       // params.put("phonenumber", phone);
        //params.put("firstName", fName);
        //params.put("lastName", lName);
        //params.put("gender", gender);

        /*RequestHandler requestHandler = new RequestHandler();

        output = requestHandler.sendPostRequest(URLs.URL_REGISTER, params);
        //output = "hellowworldd";


        Log.d("myTag", "Success");

        Log.d("myTag2", output);*/




        /*
        @SuppressLint("StaticFieldLeak")
        class RegisterUser extends AsyncTask<Void, Void, String> {

            private ProgressBar progressBar;

            @Override
            protected String doInBackground(Void... voids) {
                //creating request handler object
                RequestHandler requestHandler = new RequestHandler();

                //creating request parameters
                HashMap<String, String> params = new HashMap<>();
                params.put("username", email);
                params.put("password", pass);
                params.put("phonenumber", phone);
                params.put("firstName", fName);
                params.put("lastName", lName);

                //returning the response
                return requestHandler.sendPostRequest(URLs.URL_REGISTER, params);
            }

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                //displaying the progress bar while user registers on the server
                //progressBar = findViewById(R.id.progressBar);
                progressBar.setVisibility(View.VISIBLE);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                //hiding the progressbar after completion
                progressBar.setVisibility(View.GONE);
                /*

                try {
                    //converting response to json object
                    JSONObject obj = new JSONObject(s);

                    //if no error in response
                    if (!obj.getBoolean("error")) {
                        Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_SHORT).show();

                        //getting the user from the response
                        JSONObject userJson = obj.getJSONObject("user");
                        //String server_msg = obj.getJSONObject("server_msg").toString();

                        //Toast.makeText(getApplicationContext(), server_msg, Toast.LENGTH_LONG).show();

                        //creating a new user object

                        User user = new User(
                                userJson.getInt("id"),
                                userJson.getString("username"),
                                userJson.getString("phonenumber"),
                                userJson.getString("firstName"),
                                userJson.getString("lastName"),
                                userJson.getString("password")

                        );


                        //storing the user in shared preferences
                        SharedPrefManager.getInstance(getApplicationContext()).userLogin(user);

                        //starting the profile activity
                        finish();
                        startActivity(new Intent(getApplicationContext(), ProfileActivity.class));
                    } else {
                        Toast.makeText(getApplicationContext(), "Some error occurred", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }

        //executing the async task
        RegisterUser ru = new RegisterUser();
        ru.execute();
        */

        
        if (validate() && isOnlineNetwork()) {

            //creating request parameters
            HashMap<String, String> params = new HashMap<>();
            params.put("username", email);
            params.put("email", email);
            params.put("password", pass);
            params.put("phonenumber", phone);
            params.put("firstName", fName);
            params.put("lastName", lName);

            RequestHandler requestHandler = new RequestHandler();

            output = requestHandler.sendPostRequest(URLs.URL_SIGNUP, params);

            //Log.d("myTag2", output);

            String response_for_request = "";
            String response_reason = "";
            try {
                JSONObject jsonObj = new JSONObject(output);
                response_for_request = jsonObj.getString("response");
                response_reason = jsonObj.getString("server_msg");
            } catch( JSONException e ) {
                makeText(getApplicationContext(), "Response from server is not parsed correctly!", LENGTH_LONG).show();
            }

            Log.d("response", response_for_request);
            Log.d("reason", response_reason);




            if( response_for_request.equals( "true" ) ) {
                final ProgressDialog progressDialog = new ProgressDialog(SignupActivity.this, R.style.Theme_AppCompat_Light_Dialog_Alert);
                progressDialog.setIndeterminate(true);
                progressDialog.setMessage("Signing you up. One moment please....");
                progressDialog.show();


                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        progressDialog.dismiss();

                        Intent intent = new Intent(SignupActivity.this, LoginActivity.class);
                        startActivity(intent);

                        makeText(getApplicationContext(), "Registration Successful", LENGTH_LONG).show();
                    }
                }, 3000);

            } else {
                makeText(getApplicationContext(), "Username is already taken!?", LENGTH_LONG).show();
            }

        } else {
            makeText(getApplicationContext(), "Please check network connection!", LENGTH_LONG).show();
        }
    }

    public boolean validate() {

        boolean valid = true;

        phone = userPhone.getText().toString();
        fName = userfName.getText().toString();
        lName = userlName.getText().toString();
        email = userEmail.getText().toString();
        pass = userPass.getText().toString();
        confirmPass = userConfirmPass.getText().toString();

        boolean validPass = Pattern.matches("^(?=.*[0-9])(?=.*[A-Z])(?=.*[@#$%^&+=!])(?=\\S+$).{4,}$", pass);
        boolean validPhone = Pattern.matches("^(?=.*[0-9])(?=\\S+$).{10}$", phone);

        if (phone.isEmpty() || !validPhone) {
            userPhone.setError("Please enter a valid phone number");
            valid = false;
        } else {
            userPhone.setError(null);
        }
        if (fName.isEmpty()) {
            userfName.setError("Please enter your First Name");
            valid = false;
        } else {
            userfName.setError(null);
        }
        if (lName.isEmpty()) {
            userlName.setError("Please enter your Last Name");
            valid = false;
        } else {
            userlName.setError(null);
        }
        if (email.isEmpty() || !Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            userEmail.setError("Please enter a valid Email");
            valid = false;
        } else {
            userEmail.setError(null);
        }
        if (pass.isEmpty() || !validPass) {
            userPass.setError("Password must be:\nMinimum 8 character.\n1 alphabet\n1 number\n1 special character @#$%^&+=! ");
            valid = false;
        } else {
            userPass.setError(null);
        }
        if (confirmPass.isEmpty() || !confirmPass.matches(pass)) {
            userConfirmPass.setError("Password and Confirm Password do not match");
            valid = false;
        } else {
            userConfirmPass.setError(null);
        }
        return valid;
    }

    public boolean isOnlineNetwork() {
        ConnectionActivity connectionActivity = new ConnectionActivity(this);
        return connectionActivity.checkConnetion();
    }
}
