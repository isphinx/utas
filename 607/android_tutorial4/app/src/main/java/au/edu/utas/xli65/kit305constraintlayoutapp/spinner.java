package au.edu.utas.xli65.kit305constraintlayoutapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.ArrayAdapter;
import android.widget.Spinner;

import java.util.ArrayList;
import java.util.Arrays;

public class spinner extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_spinner);

        Spinner spinner=findViewById(R.id.spinner);
        spinner.setPrompt("请选择季节");

        final String[] list_items = getResources().getStringArray(R.array.dropdownItems);
        ArrayList<String> items = new ArrayList<>(Arrays.asList(list_items));

        ArrayAdapter<String> adapter=new ArrayAdapter<String>(this,android.R.layout.simple_spinner_dropdown_item,items);
        spinner.setAdapter(adapter);
    }
}
