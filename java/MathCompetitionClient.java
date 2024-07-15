import java.io.*;
import java.net.Socket;
import java.util.Scanner;

public class MathCompetitionClient {
    private static final String SERVER_ADDRESS = "localhost";
    private static final int SERVER_PORT = 8080;
    private Socket socket;
    private BufferedReader reader;
    private PrintWriter writer;
    private Scanner scanner;

    public MathCompetitionClient() {
        scanner = new Scanner(System.in);
        try {
            socket = new Socket(SERVER_ADDRESS, SERVER_PORT);
            reader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            writer = new PrintWriter(socket.getOutputStream(), true);
            System.out.println("Connected to server!");
            mainMenu();
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            closeConnection();
        }
    }

    private void mainMenu() {
        while (true) {
            System.out.println("\nWelcome To the Mathematics Challenge.\n");
            System.out.println("Please Type in an option.");
            System.out.println("'R' - to register.");
            System.out.println("'V' - to view challenges.");
            System.out.println("'C' - for school representatives to confirm/reject students.");
            System.out.println("'Exit' - to exit.");
            System.out.print("Your choice: ");

            String choice = scanner.nextLine().trim();

            if ("Exit".equalsIgnoreCase(choice)) {
                writer.println("Exit");
                System.out.println("Exiting program...");
                break;
            } else if ("R".equalsIgnoreCase(choice)) {
                userRegistration();
            } else if ("C".equalsIgnoreCase(choice)) {
                confirmRejectStudents();
            } else if ("V".equalsIgnoreCase(choice)) {
                viewChallenges();
            } else {
                System.out.println("Invalid option. Please try again.");
            }
        }
    }

    private void userRegistration() {
        try {
            System.out.print("Enter username: ");
            String userName = scanner.nextLine().trim();

            System.out.print("Enter first name: ");
            String firstName = scanner.nextLine().trim();

            System.out.print("Enter last name: ");
            String lastName = scanner.nextLine().trim();

            System.out.print("Enter email: ");
            String email = scanner.nextLine().trim();

            System.out.print("Enter date of birth (yyyy-mm-dd): ");
            String dateOfBirth = scanner.nextLine().trim();

            System.out.print("Enter school registration number: ");
            String schoolRegistrationNumber = scanner.nextLine().trim();

            // Sending registration data to the server
            writer.println("Register");
            writer.println(userName + "," + firstName + "," + lastName + "," + email + "," + dateOfBirth + "," + schoolRegistrationNumber);

            // Receiving confirmation from the server
            String response = reader.readLine();
            System.out.println(response);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void confirmRejectStudents() {
        writer.println("ConfirmReject");

        try {
            // Handle school representative login
            System.out.print("Enter Representative Id: ");
            String representativeID = scanner.nextLine().trim();
            writer.println(representativeID);

            System.out.print("Enter Representative Name: ");
            String representativeName = scanner.nextLine().trim();
            writer.println(representativeName);

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

    private void viewChallenges() {
        writer.println("ViewChallenges");
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
            String challenge;
            while ((challenge = reader.readLine()) != null && !challenge.isEmpty()) {
                System.out.println(challenge);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void closeConnection() {
        try {
            if (reader != null) reader.close();
            if (writer != null) writer.close();
            if (socket != null) socket.close();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        new MathCompetitionClient();
    }
}
