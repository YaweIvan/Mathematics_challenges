import java.io.*;
import java.net.*;
import java.util.*;

public class MathCompetitionServer {
    private static final int PORT = 8080;




    public static void main(String[] args) {


        System.out.println("Server is starting...");

        try (ServerSocket serverSocket = new ServerSocket(PORT)) {
            System.out.println("Server is listening on port " + PORT);

            while (true) {
                try (Socket socket = serverSocket.accept()) {
                    System.out.println("New client connected.");
                    handleClient(socket);
                } catch (IOException e) {
                    System.out.println("Exception caught when trying to listen on port " + PORT + " or listening for a connection");
                    e.printStackTrace();
                }
            }
        } catch (IOException e) {
            System.out.println("Could not listen on port: " + PORT);
            e.printStackTrace();
        }
    }

    private static void handleClient(Socket socket) {
        try (BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
             PrintWriter output = new PrintWriter(socket.getOutputStream(), true)) {

            String choice = input.readLine();
            System.out.println("Menu Item: " + choice);

            switch (choice.toLowerCase()) {
                case "register":
                    handleRegistration(input, output);
                    break;
                case "confirm/reject students":
                    handleConfirmation(input, output);
                    break;
                case "view challenges":
                    DatabaseHandler.handleAccess(input, output);
                    break;
                default:
                    output.println("Invalid option. Please try again.");
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

        protected static void handleRegistration (BufferedReader input, PrintWriter output){
        try {

            String userData = input.readLine();
            System.out.println("Student Details:" + userData);
            MathCompetitionServer.saveRegistration(userData);
            output.println("Registration received. Thank you!");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static void saveRegistration(String userData) {
        try (BufferedWriter out = new BufferedWriter(new FileWriter("C:\\Users\\hp\\OneDrive\\Desktop\\mathematics-challenge\\java\\registered_students.txt", true))) {
            out.write(userData);
        } catch (IOException e) {
            e.printStackTrace();
        }
        System.out.println("Data written to file");
    }

    private static void handleConfirmation(BufferedReader input, PrintWriter output) {
        try {
            // Authentication
            String representativeData = input.readLine();
            System.out.println("Log In Info:" + representativeData);
            String[] repData= representativeData.split(" ", 2);
            String representativeID= repData[0];
            String representativeName= repData[1];

            if (!DatabaseHandler.authenticateRepresentative(representativeID, representativeName)) {
                output.println("Authentication failed. Disconnecting.");
                return;
            }

            output.println("Authentication successful.");

            List<String> students = new ArrayList<>();
            try (BufferedReader reader = new BufferedReader(new FileReader("C:\\Users\\hp\\OneDrive\\Desktop\\mathematics-challenge\\java\\registered_students.txt"))) {
                String line;
                while ((line = reader.readLine()) != null) {
                    students.add(line);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            for (String student : students) {
                output.println(student);
                String decision = input.readLine().trim();
                if ("A".equalsIgnoreCase(decision)) {
                    DatabaseHandler.saveToDatabase(student, "participants", representativeID);
                } else if ("R".equalsIgnoreCase(decision)) {
                    DatabaseHandler.saveToDatabase(student, "rejected", representativeID);
                }
            }

            // Clear the temporary file after processing
            new PrintWriter("C:\\Users\\hp\\OneDrive\\Desktop\\mathematics-challenge\\java\\registered_students.txt").close();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }


}
