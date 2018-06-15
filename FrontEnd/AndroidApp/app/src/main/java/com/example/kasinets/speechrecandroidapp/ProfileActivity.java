package com.example.kasinets.speechrecandroidapp;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.NavigationView;
import android.support.design.widget.Snackbar;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.DividerItemDecoration;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.HashMap;
import java.util.List;

import static android.widget.Toast.LENGTH_LONG;
import static android.widget.Toast.makeText;

public class ProfileActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private List<Voicemail> voicemailList = new ArrayList<>();
    private RecyclerView recyclerView;
    private VoicemailAdapter mAdapter;
    private String output = null;
    private String out_summary = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        recyclerView = (RecyclerView) findViewById(R.id.recycler_view);

        mAdapter = new VoicemailAdapter(this, voicemailList);
        RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(getApplicationContext());
        recyclerView.setLayoutManager(mLayoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        recyclerView.addItemDecoration(new DividerItemDecoration(recyclerView.getContext(), LinearLayoutManager.VERTICAL));
        recyclerView.setAdapter(mAdapter);

        prepareVoicemailData();

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                out_summary = sendJobRequest();
                Snackbar.make(view, out_summary, Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
                //sendJobRequest();
                String newValue = "I like sheep.";
                int updateIndex = 0;
                Voicemail tmp = voicemailList.get(updateIndex);
                tmp.setMessage(out_summary);
                //voicemailList.set(updateIndex, out_summary);
                mAdapter.notifyItemChanged(updateIndex);
                // suppose to update recycle view with new inputs, so this act as a refresh.
                //mAdapter.notifyDataSetChanged();

            }
        });

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);


        View navHeaderView = navigationView.inflateHeaderView(R.layout.nav_header_profile);
        TextView headerUserName = (TextView) navHeaderView.findViewById(R.id.nav_header_name);
        TextView headerMobileNo = (TextView) navHeaderView.findViewById(R.id.nav_header_email);
        Intent intent = getIntent();
        String str = intent.getStringExtra("username");
        headerUserName.setText(str);
        headerMobileNo.setText(str);
    }


    private String sendJobRequest() {
        //creating request parameters
        HashMap<String, String> params = new HashMap<>();
        //params.put("username", email);
        //params.put("password", pass);
          //DUMMY DATA, works with a preexisting audio file on server side.
        params.put("username", "yi@gmail.com");
        params.put("filename", "movie.wav");
        params.put("emlfile", "DUMMY DATA");

        RequestHandler requestHandler = new RequestHandler();

        output = requestHandler.sendPostRequest(URLs.URL_JOB_SUBMIT, params);
        Log.d("myTag2", output);

        String response_for_request = "";
        String response_reason = "";
        String summary = "";
        try {
            JSONObject jsonObj = new JSONObject(output);
            response_for_request = jsonObj.getString("response");
            response_reason = jsonObj.getString("server_msg");
            summary = jsonObj.getString("summary");
        } catch( JSONException e ) {
            makeText(getApplicationContext(), "Response from server is not parsed correctly!", LENGTH_LONG).show();
        }

        Log.d("response", response_for_request);
        Log.d("reason", response_reason);
        Log.d("summary", summary);

        return summary;
    }

    private void prepareVoicemailData() {

        Calendar calendar=Calendar.getInstance();
        SimpleDateFormat mdformat = new SimpleDateFormat("MM-dd-yyyy");
        String strDate = mdformat.format(calendar.getTime());

        Voicemail voicemail = new Voicemail("Yi Zong", "This will be changed", strDate, R.drawable.ic_menu_camera);
        voicemailList.add(voicemail);

        voicemail = new Voicemail("Alyona", "Bring some food", strDate, R.mipmap.ic_launcher_round);
        voicemailList.add(voicemail);

        voicemail = new Voicemail("Dzmitry", "I will call", strDate, R.drawable.ic_menu_camera);
        voicemailList.add(voicemail);

        voicemail = new Voicemail("John", "How are you", strDate, R.drawable.ic_menu_camera);
        voicemailList.add(voicemail);

        voicemail = new Voicemail("Mohammad", "See you!", "2015", R.drawable.ic_menu_camera);
        voicemailList.add(voicemail);

        voicemail = new Voicemail("Gregory", "Hi", strDate, R.drawable.ic_menu_camera);
        voicemailList.add(voicemail);


        mAdapter.notifyDataSetChanged();
    }

    @Override
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.profile, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @SuppressWarnings("StatementWithEmptyBody")
    @Override
    public boolean onNavigationItemSelected(MenuItem item) {
        // Handle navigation view item clicks here.
        int id = item.getItemId();

        if (id == R.id.nav_camera) {
            // Handle the camera action
        } else if (id == R.id.nav_gallery) {

        } else if (id == R.id.nav_slideshow) {

        } else if (id == R.id.nav_manage) {

        } else if (id == R.id.nav_share) {

        } else if (id == R.id.nav_send) {

        } else if (id == R.id.logout) {

            final ProgressDialog progressDialog = new ProgressDialog(ProfileActivity.this, R.style.Theme_AppCompat_Light_Dialog_Alert);
            progressDialog.setIndeterminate(true);
            progressDialog.setMessage("Logging you out securely......");
            progressDialog.show();

            new Handler().postDelayed(new Runnable() {
                @Override
                public void run() {
                    progressDialog.dismiss();

                    Intent intent = new Intent(ProfileActivity.this, LoginActivity.class);
                    startActivity(intent);

                    makeText(getApplicationContext(), "Logged out Successful", LENGTH_LONG).show();
                }
            }, 3000);
        }

        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        drawer.closeDrawer(GravityCompat.START);
        return true;
    }

}
