package au.edu.utas.sqlite;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import java.util.ArrayList;

public class PropertyTable {
    public static final String TABLE_NAME      = "property";
    public static final String KEY_PROPERTY_ID = "property_id";
    public static final String KEY_ADDRESS     = "address";
    public static final String KEY_PRICE       = "price";
    public static final String KEY_BEDROOMS    = "bedrooms";

    public static final String CREATE_STATEMENT = "CREATE TABLE    "
            + TABLE_NAME
            + "    (" + KEY_PROPERTY_ID + " integer primary key autoincrement, "
            + KEY_ADDRESS + " string not null, "
            + KEY_PRICE + " int not null, "
            + KEY_BEDROOMS + " string not null "
            +");";

    public static void insert(SQLiteDatabase db, Property p) {

        ContentValues values = new ContentValues();
        values.put(KEY_ADDRESS, p.getAddress());
        values.put(KEY_PRICE, p.getPrice());
        values.put(KEY_BEDROOMS, p.getBedrooms());
        db.insert(TABLE_NAME, null, values);
    }

    public static ArrayList<Property> selectAll(SQLiteDatabase db)
    {
        ArrayList<Property> results = new ArrayList<Property>();
        Cursor c = db.query(TABLE_NAME, null, null, null, null, null, null);
        if (c != null)
        {
            //make sure the cursor is at the start of the list
            c.moveToFirst();
            //loop through until we are at the end of the list
            while (!c.isAfterLast())
            {
                Property p = createFromCursor(c);
                results.add(p);
                //increment the cursor
                c.moveToNext();
            }
        }
        return results;
    }

    public static Property createFromCursor(Cursor c)
    {
        if (c == null || c.isAfterLast() || c.isBeforeFirst())
        {
            return null;
        }
        else
        {
            Property p = new Property();
            p.setPropertyID(c.getInt(c.getColumnIndex(KEY_PROPERTY_ID)));
            p.setAddress(c.getString(c.getColumnIndex(KEY_ADDRESS)));
            p.setPrice(c.getInt(c.getColumnIndex(KEY_PRICE)));
            p.setBedrooms(c.getInt(c.getColumnIndex(KEY_BEDROOMS)));
            return p;
        }
    }

    public static Property getByID(SQLiteDatabase db, int id)
    {
        Cursor c = db.query(TABLE_NAME, null, KEY_PROPERTY_ID + "=" + id, null, null, null, null);
        c.moveToFirst();
        return createFromCursor(c);
    }

    public static void update(SQLiteDatabase db, Property p)
    {
        ContentValues values = new ContentValues();
        values.put(KEY_PROPERTY_ID, p.getPropertyID());
        values.put(KEY_ADDRESS, p.getAddress());
        values.put(KEY_PRICE, p.getPrice());
        values.put(KEY_BEDROOMS, p.getBedrooms());
        db.update(TABLE_NAME, values, KEY_PROPERTY_ID+"= ?",
                new String[]{ ""+p.getPropertyID() });
    }
}
