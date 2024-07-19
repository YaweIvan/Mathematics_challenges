import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class Representative {

    protected static void confirmRejectStudents(PrintWriter writer, BufferedReader reader, Scanner scanner) {


        try {
            // Handle school representative login
            System.out.print("Enter Representative Details: ");
            String representativeData = scanner.nextLine().trim();
            writer.println(representativeData);



            String loginResponse = reader.readLine();
            if ("Authentication failed. Disconnecting.".equalsIgnoreCase(loginResponse)) {
                System.out.println(loginResponse);
                return;
            }

            System.out.println(loginResponse); // Authentication successful message

            String student;
            while ((student = reader.readLine()) != null && !student.isEmpty()) {
                System.out.println(student);
                System.out.print("Enter 'A' to accept or 'R' to reject: ");
                String decision = scanner.nextLine().trim();
                writer.println(decision);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

}
