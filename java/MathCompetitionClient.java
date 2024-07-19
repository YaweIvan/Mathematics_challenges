import java.io.*;
import java.net.Socket;
import java.util.Scanner;

public class MathCompetitionClient {
    protected static final String SERVER_ADDRESS = "localhost";
    protected static final int SERVER_PORT = 8080;
    protected Socket socket;
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
            //closeConnection();
        }
    }
    public static void main(String[] args){
        new MathCompetitionClient();
    }

    private void mainMenu() throws IOException {
        while (true) {
            System.out.println("\nWelcome To the Mathematics Challenge.\n");
            System.out.println("Please Type in an option.");
            System.out.println("Register.");
            System.out.println("View challenges.");
            System.out.println("Confirm/reject students.");
            System.out.println("Exit.");
            System.out.print("Your choice: ");

            String choice = scanner.nextLine().trim();
            writer.println(choice);
            switch (choice.toLowerCase()) {
                case "exit":
                    System.out.println("Exiting program...");
                    break;
                case "register":
                    Student.userRegistration(writer, reader, scanner);
                    break;
                case "confirm/reject students":
                       Representative.confirmRejectStudents(writer, reader, scanner);
                    break;
                case "view challenges":
                    //  viewChallenges();
                    break;
                default:  System.out.println("Invalid option. Please try again.");
            }

        }



/*
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
*/

    }
}
