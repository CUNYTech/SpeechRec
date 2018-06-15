package com.example.kasinets.speechrecandroidapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.StrictMode;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.regex.Pattern;

import static android.widget.Toast.LENGTH_LONG;
import static android.widget.Toast.makeText;

public class LoginActivity extends AppCompatActivity {

    private EditText userName, userPass;
    private Button login, signup;
    private CheckBox userRem;
    private TextView resetPass;

    String email;
    String pass;
    private String output;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        login = findViewById(R.id.btn_login);
        signup = findViewById(R.id.btn_signup);
        userName = findViewById(R.id.txtLogEmail);
        userPass = findViewById(R.id.txtLogPass);
        userRem = findViewById(R.id.chekBox);
        resetPass = findViewById(R.id.resetPass);


        // Need this following bit to allow networking operation in main thread and avoid calling this in a thread of Asynch class
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                .permitAll().build();
        StrictMode.setThreadPolicy(policy);


        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                logIn();
            }
        });

        signup.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(LoginActivity.this, SignupActivity.class);
                startActivity(intent);
            }
        });

        resetPass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent intent = new Intent(LoginActivity.this, ResetPasswordActivity.class);
                startActivity(intent);
            }
        });

    }

    public void logIn() {

        if (validate() && isOnline()) {

            //creating request parameters
            HashMap<String, String> params = new HashMap<>();
            params.put("username", email);
            params.put("password", pass);

            RequestHandler requestHandler = new RequestHandler();

            output = requestHandler.sendPostRequest(URLs.URL_LOGIN, params);
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
                final ProgressDialog progressDialog = new ProgressDialog(LoginActivity.this, R.style.Theme_AppCompat_Light_Dialog_Alert);
                progressDialog.setIndeterminate(true);
                progressDialog.setMessage("Authenticating....");
                progressDialog.show();

                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        progressDialog.dismiss();

                        Intent intent = new Intent(LoginActivity.this, ProfileActivity.class);
                        intent.putExtra("username", userName.getText().toString());
                        intent.putExtra("password", userPass.getText().toString());
                        startActivity(intent);

                        makeText(getApplicationContext(), "Login Successful", LENGTH_LONG).show();
                    }
                }, 3000);
            } else {
                makeText(getApplicationContext(), "Reason: " + response_reason, LENGTH_LONG).show();
            }
        } else {
            makeText(getApplicationContext(), "Please check network connection!", LENGTH_LONG).show();
        }
    }

    public boolean validate() {

        boolean valid = true;

        email = userName.getText().toString();
        pass = userPass.getText().toString();

        //boolean validPass = Pattern.matches("^(?=.*[0-9])(?=.*[A-Z])(?=.*[@#$%^&+=!])(?=\\S+$).{4,}$", pass);

        if (email.isEmpty() || !Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            userName.setError("Please enter a valid email address");
            valid = false;
        } else {
            userName.setError(null);
        }
        //if (pass.isEmpty() || !validPass) {
        if( pass.isEmpty() ) {
            userPass.setError("Please enter a valid password");
            valid = false;
        } else {
            userPass.setError(null);
        }
        return valid;
    }

    public boolean isOnline() {
        ConnectionActivity connectionActivity = new ConnectionActivity(this);
        return connectionActivity.checkConnetion();
    }
}