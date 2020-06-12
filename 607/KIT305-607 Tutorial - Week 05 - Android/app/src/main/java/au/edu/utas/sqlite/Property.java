package au.edu.utas.sqlite;

import android.content.ContentValues;
import android.database.sqlite.SQLiteDatabase;

public class Property {
    private int mPropertyID;
    private String mAddress;
    private int mPrice, mBedrooms;

    public int getPropertyID() { return mPropertyID; }
    public void setPropertyID(int s) { this.mPropertyID = s; }
    public String getAddress() { return mAddress; }
    public void setAddress(String s) { this.mAddress = s; }
    public int getPrice() { return mPrice; }
    public void setPrice(int s) { this.mPrice = s; }
    public int getBedrooms() { return mBedrooms; }
    public void setBedrooms(int s) { this.mBedrooms = s; }

}
