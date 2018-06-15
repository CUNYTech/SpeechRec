package com.example.kasinets.speechrecandroidapp;

public class User {

    private int id;
    private String phoneNumber, email, firstName, lastName, password;

    public User(int id, String phoneNumber, String email, String firstName, String lastName, String password) {
        this.id = id;
        this.phoneNumber = phoneNumber;
        this.email = email;
        this.firstName = firstName;
        this.lastName = lastName;
        this.password = password;
    }

    public int getId() {
        return id;
    }

    public String getPhoneNumber() {
        return phoneNumber;
    }

    public String getEmail() {
        return email;
    }

    public String getFirstName() {
        return firstName;
    }

    public String getLastName() {
        return lastName;
    }

    public String getPassword() {
        return password;
    }
}
