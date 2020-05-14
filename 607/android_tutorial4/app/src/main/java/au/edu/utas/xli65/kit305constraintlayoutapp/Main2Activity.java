package au.edu.utas.xli65.kit305constraintlayoutapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.Arrays;

public class Main2Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main2);

//        ArrayList<String> items = new ArrayList<String>();
//        items.add("Rick");
//        items.add("Morty");
//        items.add("Beth");
//        items.add("Summer");
//        items.add("Not Jerry");

        final String[] list_items = getResources().getStringArray(R.array.list_items);
        ArrayList<String> items = new ArrayList<>(Arrays.asList(list_items));

        ArrayAdapter<String> myListAdapter = new ArrayAdapter<String>(
                getApplicationContext(),
                android.R.layout.simple_list_item_1,
                items);

        ListView myList = findViewById(R.id.myList);
        myList.setAdapter(myListAdapter);

        myList.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                AlertDialog.Builder builder = new AlertDialog.Builder(Main2Activity.this);
                builder.setMessage(list_items[i])
                        .setTitle("Item Tapped").setNegativeButton("Ok thanks mate",
                        null);
                AlertDialog dialog = builder.create(); dialog.show();
                dialog.getButton(AlertDialog.BUTTON_NEGATIVE).setTextColor(Color.RED);
            }
        });
    }
}
