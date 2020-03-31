package assessment1;

import java.util.Arrays;
import java.net.Socket;
import java.util.HashMap;
import java.util.LinkedList;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.io.BufferedReader;

class ServerWorker {

    public static void main(String[] args) throws Exception {
        // default number of worker and port if no parameters follow the command
        String ipAddr = "0.0.0.0";
        int port = 9999;
        // read parameters from the command line
        if (args.length == 2) {
            ipAddr = args[0];
            port = Integer.parseInt(args[1]);
        }

        //
        Socket socket = new Socket(ipAddr, port);
        BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
        DataOutputStream out = new DataOutputStream(socket.getOutputStream());

        String line;
        while ((line = input.readLine()) != null) {
            System.out.println("receive:" + line);
            new Worker(line, out).start();
        }
        socket.close();
    }
}

class Worker extends Thread {
    String content;
    DataOutputStream out;
    static Object lock = new Object();

    public Worker(String str, DataOutputStream out) {
        this.content = str;
        this.out = out;
        // System.out.println("thread create id:" + id);
    }

    // @Override
    public void run() {
        // System.out.println("thread begin id:" + id);
        int index = this.content.indexOf("*");
        String str = this.content.substring(0, index);
        Integer id = Integer.parseInt(this.content.substring(index + 1));
        int[] counts = freC(str);
        // Character counts = FrequentCharacterFinder(str);
        String result = id.toString() + "*" + Arrays.toString(counts);
        try {
            synchronized (lock) {
                this.out.writeBytes(result + "\n");
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
        System.out.println(result);
        System.out.println("receive:" + this.content + ":finish");
    }

    private int[] freC(String str) {

        int[] counts = new int[26];
        for (char c : str.toCharArray()) {
            int i = c - 97;
            counts[i]++;
        }
        return counts;
    }

    // FrequentCharacterFinder(String T)
    // {
    // Remove all non-alphabet character from String T and make all uppercase letter
    // to lowercase, call the resultant string ‘t’
    // Let l=number of characters in String t
    // Let sum=0;
    // Let Pos(k) function returns the position number of a given alphabet //e.g.
    // Pos(‘z’)=26, Pos(‘a’)=1
    // Let Alpha(n) function returns the alphabet whose position is the closest to
    // ‘n’.
    // For each character ‘c’
    // sum=sum+Pos(c)
    // End For
    // Return Alpha(sum/l)
    // }
    private Character FrequentCharacterFinder(String str) {
        int l = str.length();
        int sum = 0;

        for (Character c : str.toCharArray()) {
            sum += Pos(c);
        }

        return Alpha(sum / l);
    }

    private int Pos(Character c) {
        return (c - 96);
    }

    private Character Alpha(int c) {
        return (char) (c + 96);
    }
}