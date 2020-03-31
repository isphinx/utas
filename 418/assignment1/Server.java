package assessment1;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.security.Key;
import java.security.MessageDigest;
import java.util.HashMap;
import java.util.concurrent.ArrayBlockingQueue;

public class Server {
    public static void main(String[] args) throws Exception {
        // default number of worker and port if no parameters follow the command
        int port = 8888;
        int numOfWorker = 5;
        // read parameters from the command line
        if (args.length == 2) {
            port = Integer.parseInt(args[0]);
            numOfWorker = Integer.parseInt(args[1]);
        }

        // start listen port for worker connection.
        WorkerServer ws = new WorkerServer(9999, numOfWorker);
        ws.start();

        // start listen port for client.
        System.out.println("listening port :" + port);
        ServerSocket server = new ServerSocket(port);
        while (true) {
            // accept client
            Socket socket = server.accept();
            System.out.println("accept one client ");
            new MyReader(socket, ws).start();
        }
    }
}

// connecion with work server.
class WorkerServer extends Thread {
    private Integer port;
    public WorkerReader wr;
    private int numOfWorker;

    public WorkerServer(int port, int num) {
        this.port = port;
        this.numOfWorker = num;
    }

    public void run() {

        System.out.println("listening port :" + this.port.toString());
        ServerSocket server;
        try {
            server = new ServerSocket(this.port);

            while (true) {
                // accept worker server connection.
                Socket socket = server.accept();
                System.out.println("accept one worker ");
                wr = new WorkerReader(socket, this.numOfWorker);
                wr.start();
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
}

class WorkerReader extends Thread {
    private Socket socket;
    private DataOutputStream output;

    // queue for check the number of worker which is available.
    private ArrayBlockingQueue<Integer> workerQ;

    // store the client reader for reply the result.
    private HashMap<Integer, MyReader> resultHandle;

    // init worker reader
    public WorkerReader(Socket socket, int count) {
        this.socket = socket;
        try {
            output = new DataOutputStream(socket.getOutputStream());
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
        // lock = new Object();
        this.workerQ = new ArrayBlockingQueue<Integer>(count);
        for (int i = 0; i < count; i++) {
            workerQ.add(i);
        }
        this.resultHandle = new HashMap<Integer, MyReader>();
    }

    // send a string to worker to calculate the highest frequent character.
    public synchronized void Sendwork(MyReader mr, String str) {
        try {
            while (workerQ.isEmpty()) {
                Thread.sleep(10);
            }

            Integer workerID = workerQ.poll();
            this.resultHandle.put(workerID, mr);
            output.writeBytes(str + "*" + workerID.toString() + "\n");
            System.out.println(String.format("worker ID: %d start...", workerID));
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }

    public void run() {
        System.out.println("worker reader running...");
        try {
            BufferedReader br = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            String line;
            // read from worker server the highest frequent number.
            while ((line = br.readLine()) != null) {
                System.out.println(line);
                int i = line.indexOf("*");
                int workid = Integer.parseInt(line.substring(0, i));
                String result = line.substring(i + 1);

                String counts = result.replace(']', ',').replace('[', ' ');
                int[] d = new int[26];
                int count = 0;
                while (true) {
                    int idx = counts.indexOf(',');
                    d[count++] = Integer.parseInt(counts.substring(0, idx).trim());
                    if (counts.length() == 2)
                        break;
                    counts = counts.substring(idx + 2);
                }

                MyReader mr = this.resultHandle.get(workid);
                for (int j = 0; j < 26; j++) {
                    mr.result[j] += d[j];
                }
                this.workerQ.add(workid + 5);

                System.out.println(String.format("worker ID: %d finish...", workid));
                // lock.notifyAll();
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
            e.printStackTrace();
        }
    }
}

class MyReader extends Thread {

    private Socket socket;
    private String key;
    private WorkerServer wr;
    private HashMap<String, int[]> history;
    // static Object lock = new Object();
    public int[] result;

    public MyReader(Socket socket, WorkerServer wr) {
        this.socket = socket;
        this.wr = wr;
        this.result = new int[26];
        this.key = "";
        this.history = new HashMap<String, int[]>();
    }

    public void run() {
        try {
            // PrintWriter pw = new PrintWriter(socket.getOutputStream());
            // pw.println("Welcome to CharFreqServer\n" + "Type any of the following
            // options: \n"
            // + "NewRequest <INPUTSTRING>\n" + "StatusRequest <passcode>\n" + "Exit\n");
            // prepare read and write stream.
            BufferedReader br = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());
            out.writeBytes("Welcome to CharFreqServer\n" + "Type any of the following options: \n"
                    + "NewRequest: <INPUTSTRING>\n" + "StatusRequest: <passcode>\n" + "Exit\n");
            out.flush();
            // read from client input
            String line = null;
            while ((line = br.readLine()) != null) {
                System.out.println("server received：" + line);

                // handle the new request from the user.
                if (line.startsWith("NewRequest:") == true) {
                    if (key != "") {
                        history.put(key, result);
                        key = "";
                        this.result = new int[26];
                    }
                    // key
                    String input = line.substring(11);
                    input = input.replaceAll("[^a-zA-Z]", "").toLowerCase();
                    if (input.length() == 0) {
                        out.writeBytes("input does not contain one character!!!!");
                    } else if (input.length() < 50) {
                        this.key = this.GetKey(input);

                        out.writeBytes("key is (" + this.key + ")\n");

                        this.result = this.freC(input);

                    } else if (input.length() < 100) {
                        this.key = this.GetKey(input);

                        out.writeBytes("key is (" + this.key + ")\n");

                        this.wr.wr.Sendwork(this, input);

                    } else {
                        this.key = this.GetKey(input);

                        out.writeBytes("key is (" + this.key + ")\n");

                        int length = 50;
                        int numDivided = input.length() / length;
                        numDivided = (input.length() % length != 0) ? numDivided + 1 : numDivided;
                        for (int i = 0; i < numDivided; i++) {
                            int begin = i * length;
                            int end = Math.min((i + 1) * length, input.length());
                            String slice = input.substring(begin, end);

                            this.wr.wr.Sendwork(this, slice);
                        }
                    }

                    // check status with passcode got from the client.
                } else if (line.startsWith("StatusRequest:") == true) {
                    String input = line.substring(14);
                    // this.result[this.key] = f;
                    if (input.equals(this.key)) {
                        Character reply = '*';
                        int max = 0;
                        int maxIdx = 0;
                        for (int i = 1; i < 26; i++) {
                            if (result[i] > max) {
                                max = result[i];
                                maxIdx = i;
                            }
                        }
                        reply = (char) (maxIdx + 97);
                        if (reply != '*') {
                            // handle
                            String strout = String.format("high frequent character is (%c)(%d)", reply, result[maxIdx]);
                            out.writeChars(strout + "\n");
                        } else {
                            out.writeBytes("waiting");
                        }
                    } else if (this.history.get(input) != null) {
                        Character reply = '*';
                        int result[] = this.history.get(input);
                        int max = 0;
                        int maxIdx = 0;
                        for (int i = 1; i < 26; i++) {
                            if (result[i] > max) {
                                max = result[i];
                                maxIdx = i;
                            }
                        }
                        reply = (char) (maxIdx + 97);
                        if (reply != '*') {
                            // handle
                            String strout = String.format("high frequent character is (%c)(%d)", reply, result[maxIdx]);
                            out.writeChars(strout + "\n");
                        } else {
                            out.writeBytes("waiting");
                        }
                    } else {
                        System.out.println(input);
                        System.out.println(this.key);
                        out.writeBytes("invalid posscode! try again!\n");
                    }
                    // client exit
                } else if (line.startsWith("Exit") == true) {
                    break;
                    // client input is not correct.
                } else {
                    System.out.println("INVALID OPTION!! PLEASE SPECIFY OPTION AGAIN.");
                }
            }
            this.socket.close();
        } catch (Exception e) {
            System.out.println(e.getMessage());
            System.out.println("client lost connection!");
        }
    }

    // calculate the highest number of character
    private int[] freC(String str) {
        int[] counts = new int[26];
        for (char c : str.toCharArray()) {
            int i = c - 97;
            counts[i]++;
        }
        return counts;
    }

    // generate passcode for one request.
    private String GetKey(String line) {
        try {
            String input = line;
            byte[] secretBytes = MessageDigest.getInstance("md5").digest(input.getBytes());

            // BigInteger bigint = new BigInteger(1, secretBytes);
            // String md5code = bigint.toString();
            String md5code = "";
            for (int i = 0; i < secretBytes.length; i++) {
                md5code += Integer.toHexString((0x000000ff & secretBytes[i]) | 0xffffff00).substring(6);
            }
            return md5code;
        } catch (Exception e) {

            return "";
        }
    }
}
