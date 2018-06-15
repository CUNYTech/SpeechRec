package com.example.kasinets.speechrecandroidapp;


public class Voicemail {

    private String name;
    private String message;
    private String date;
    private int image;

    public Voicemail() {
    }

    public Voicemail(String name, String message, String date, int image) {
        this.name = name;
        this.message = message;
        this.date = date;
        this.image = image;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public int getImage() {
        return image;
    }

    public void setImage(int image) {
        this.image = image;
    }
}
