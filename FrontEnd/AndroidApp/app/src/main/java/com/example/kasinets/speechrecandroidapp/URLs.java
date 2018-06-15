package com.example.kasinets.speechrecandroidapp;

public class URLs {

        private static final String ROOT_URL = "http://ec2-18-219-242-118.us-east-2.compute.amazonaws.com/master.php?apicall=";
        //java.net.URLEncoder.encode(paramValue, "UTF-8")

        public static final String URL_SIGNUP = ROOT_URL + "signup";
        public static final String URL_LOGIN= ROOT_URL + "login";

        public static final String URL_JOB_SUBMIT = ROOT_URL + "jobsubmit";
        public static final String URL_TRANSCRIPT_REQ = ROOT_URL + "transcriptrequest";
}
