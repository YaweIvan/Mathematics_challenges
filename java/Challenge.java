import java.io.*;
import java.net.Socket;
import java.net.SocketException;
import java.util.Scanner;

public class Challenge {


    protected static void viewChallenges(PrintWriter writer, BufferedReader reader, Scanner scanner) {

        try {
            System.out.print("Enter Username: ");
            String userName = scanner.nextLine().trim();
            writer.println(userName);

            String accessResponse = reader.readLine();
            if ("Access denied".equalsIgnoreCase(accessResponse)) {
                System.out.println("Access denied.");
                return;
            }
            System.out.println("Access granted. Challenges:");
        }
catch (IOException e){
            e.printStackTrace();
}
    }
}
