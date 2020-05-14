package com.example.myfirstapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

public class SecondActivity extends AppCompatActivity {
    public static String USERNAME_KEY = "USERNAME";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_second);

        TextView lblEnteredText = findViewById(R.id.lblEnteredText);
        Bundle extras = getIntent().getExtras();
        lblEnteredText.setText(extras.getString(MainActivity.USERNAME_KEY));
    }
}
