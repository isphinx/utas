package assessment1;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.io.PrintStream;
import java.io.PrintWriter;
import java.net.Socket;
import java.util.Scanner;
import java.net.UnknownHostException;

import java.util.Random;

class Test {

    public static void main(String[] args) throws Exception {
        // long start = System.currentTimeMillis();
        Thread[] arr = new Thread[300];
        for (int i = 0; i < 300; i++) {
            System.out.println("create thread:" + i);
            arr[i] = new Thread(new MyTest());
            arr[i].start();
        }
        // long end = System.currentTimeMillis();
        // long diff = end - start;
        // System.out.println("Difference is : " + diff);
    }
}

class MyTest implements Runnable {

    public void run() {
        String ipAddr = "0.0.0.0";
        int port = 8888;
        String randomquest = "NewRequest:";
        Random r = new Random();

        for (int i = 0; i < r.nextInt(10000); i++) {
            randomquest += (char) (97 + r.nextInt(26));
        }
        System.out.println(randomquest);
        try {
            // create a socket to connect with server.
            // prepare the reader and writer stream.
            Socket socket = new Socket(ipAddr, port);
            BufferedReader is = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            // Scanner scan = new Scanner(System.in);
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());

            String line = null;
            while (is.ready()) {
                line = is.readLine();
                System.out.println(line);
            }
            out.writeBytes(randomquest + "\n");
            // line = scan.nextLine();
            // out.writeBytes(line + "\n");
            // out.flush();

            line = is.readLine();
            System.out.println(line);
            out.writeBytes("Exit\n");

            out.close();
            // ps.close();
            // scan.close();
            socket.close();
        } catch (IllegalArgumentException e) {
            System.out.print(e.getMessage());
        } catch (UnknownHostException e) {
            System.out.print("unknow host:" + e.getMessage());
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}