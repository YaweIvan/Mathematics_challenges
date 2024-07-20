import java.io.IOException;
import java.net.Socket;
import java.util.*;
import java.io.*;
public class Student {


    protected static void userRegistration( PrintWriter writer, BufferedReader reader, Scanner scanner) throws IOException {

        try {
            System.out.println("Enter your details in this format ");
            System.out.println("Username,FirstName,LastName,EmailAdress,DateOfBirth,SchoolRegistrationNumber ");
            String userData= scanner.nextLine().trim();
            // Sending registration data to the server
            writer.println(userData);
            // Receiving confirmation from the server
            String response = reader.readLine();
            System.out.println(response);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
