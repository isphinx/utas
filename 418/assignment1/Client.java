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

import javax.swing.plaf.basic.BasicInternalFrameTitlePane.SystemMenuBar;

// import sun.security.x509.IPAddressName;

public class Client {

    public static void main(String[] args) throws Exception {
        // default ip address and port if no parameters follow the command
        String ipAddr = "0.0.0.0";
        int port = 8888;
        // read parameters from the command line
        if (args.length == 2) {
            ipAddr = args[0];
            port = Integer.parseInt(args[1]);
        }

        try {
            // create a socket to connect with server.
            // prepare the reader and writer stream.
            Socket socket = new Socket(ipAddr, port);
            BufferedReader is = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            Scanner scan = new Scanner(System.in);
            DataOutputStream out = new DataOutputStream(socket.getOutputStream());

            String line = null;
            while (is.ready()) {
                line = is.readLine();
                System.out.println(line);
            }
            while (true) {
                line = scan.nextLine();
                out.writeBytes(line + "\n");
                out.flush();

                line = is.readLine();
                if (line == null) {
                    break;
                }
                System.out.println(line);
            }
            out.close();
            // ps.close();
            scan.close();
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
