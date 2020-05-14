package com.example.myfirstapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    public static String USERNAME_KEY = "USERNAME";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button btnEnter = findViewById(R.id.btnEnter);
        btnEnter.setOnClickListener( new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                EditText txtName = findViewById(R.id.txtName);
                String enteredText = txtName.getText().toString();
                Intent i = new Intent(MainActivity.this, SecondActivity.class);
                i.putExtra(USERNAME_KEY, enteredText);
                startActivity(i);


            }
        });
    }
}
