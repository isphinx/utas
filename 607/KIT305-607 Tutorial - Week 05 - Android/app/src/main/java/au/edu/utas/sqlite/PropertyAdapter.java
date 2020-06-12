package au.edu.utas.sqlite;

import android.app.Service;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.List;

public class PropertyAdapter extends ArrayAdapter<Property> {
    private int mLayoutResourceID;
    public PropertyAdapter(Context context, int resource, List<Property> objects)
    {
        super(context, resource, objects);
        this.mLayoutResourceID = resource;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater layoutInflater = (LayoutInflater)getContext().getSystemService(Service.LAYOUT_INFLATER_SERVICE);
        View row = layoutInflater.inflate(mLayoutResourceID, parent, false);
        Property p = this.getItem(position);
//        TextView textView = row.findViewById(android.R.id.text1);
//        textView.setText(p.getPropertyID()+": "+p.getAddress());

        TextView lblAddress = row.findViewById(R.id.lblAddress);
        lblAddress.setText(p.getAddress());
        TextView lblBedrooms = row.findViewById(R.id.lblBedrooms);
        lblBedrooms.setText(""+p.getBedrooms());
        TextView lblPrice = row.findViewById(R.id.lblPrice);
        lblPrice.setText("$"+p.getPrice());
        return row;
    }
}
