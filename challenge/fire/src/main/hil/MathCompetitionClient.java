package hil;

import java.io.*;
import java.net.Socket;
import java.net.SocketException;
import java.util.*;

import static hil.Representative.schoolRepMenu;

public class MathCompetitionClient {
    protected static Socket socket;
    protected static BufferedReader reader;
    protected static PrintWriter writer;
    protected  static Scanner scanner;
    protected  static BufferedReader consoleReader;
    protected static List<Map<String, String>> registrationTable;
    protected static Map<String, String> fieldPrompts;

    private static final String SERVER_ADDRESS = "localhost";
    private static final int SERVER_PORT = 8080;

    private boolean isLoggedIn = false;

    public MathCompetitionClient() {
        scanner = new Scanner(System.in);
        registrationTable = new ArrayList<>();
        fieldPrompts = new LinkedHashMap<>();

        // Initialize field prompts
        fieldPrompts.put("username", "Username");
        fieldPrompts.put("firstname", "First Name");
        fieldPrompts.put("lastname", "Last Name");
        fieldPrompts.put("emailaddress", "Email Address");
        fieldPrompts.put("dateofbirth(dd-mm-yyyy)", "Date of Birth (dd-mm-yyyy)");
        fieldPrompts.put("schoolregistrationnumber", "School Registration Number");
        fieldPrompts.put("imagepath", "image_file.png");

        try {
            socket = new Socket(SERVER_ADDRESS, SERVER_PORT);
            System.out.println("Connected to server!");
            reader = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            writer = new PrintWriter(socket.getOutputStream(), true);
            consoleReader = new BufferedReader(new InputStreamReader(System.in));
        } catch (IOException e) {
            e.printStackTrace();
            System.exit(1); // Exit program on connection error
        }

        while (true) {
            mainMenu(); // Call main menu function
        }
    }
// direct each role to either student or representative menu
    private void mainMenu() {
        System.out.println("\nWelcome To the Mathematics Challenge!");
        System.out.println("\nPlease type: \n'Student' if you are a student.  \n'School Representative' if you are a school representative.");
        System.out.print("Your role: ");
        String role = scanner.nextLine().trim();
         writer.println(role);
        if ("Student".equalsIgnoreCase(role)) {
            Student.studentMenu();
        } else if ("School Representative".equalsIgnoreCase(role)) {
            schoolRepMenu(isLoggedIn);
        } else {
            System.out.println("Invalid role. Please type 'Student' or 'School Representative'.");
        }
    }


    protected static void sendChoiceToServer(String choice) {
        writer.println(choice);
        try {
            String response = reader.readLine();
            System.out.println(response);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }



    protected static void sendTableToServer() {
        if (registrationTable.isEmpty()) {
            System.out.println("No registration data to send.");
            return;
        }

        try {
            // Send each user detail line
            for (Map<String, String> userDetails : registrationTable) {
                StringBuilder userDetailsLine = new StringBuilder();
                for (Map.Entry<String, String> entry : userDetails.entrySet()) {
                    userDetailsLine.append(entry.getKey()).append(": ").append(entry.getValue()).append(" , ");
                }
                // Remove the last comma and space
                if (userDetailsLine.length() > 0) {
                    userDetailsLine.setLength(userDetailsLine.length() - 2);
                }

                // Send the user details line to the server
                writer.println(userDetailsLine.toString());
            }

            // Send "END_OF_TABLE" to signal the end of the data
            writer.println("END_OF_TABLE");

            System.out.println("Registration table sent to the server for processing.");
        } catch (Exception e) {
            System.out.println("An error occurred while sending the table to the server: " + e.getMessage());
        }
    }

    protected static void saveImage(String imagePath) {
        File imageFile = new File(imagePath);
        if (imageFile.exists()) {
            File destinationFile = new File(imageFile.getName());
            try (InputStream is = new FileInputStream(imageFile);
                 OutputStream os = new FileOutputStream(destinationFile)) {
                byte[] buffer = new byte[1024];
                int length;
                while ((length = is.read(buffer)) > 0) {
                    os.write(buffer, 0, length);
                }
                System.out.println("Image saved successfully.");
            } catch (IOException e) {
                System.out.println("An error occurred while saving the image: " + e.getMessage());
            }
        } else {
            System.out.println("Image file not found: " + imagePath);
        }
    }



    protected static void receiveChallengeList() {
        writer.println("view challenge");
        try {
            String serverResponses;
            while ((serverResponses = reader.readLine()) != null) {
                if (serverResponses.equals(" ")) {
                    break;
                }
                System.out.println(serverResponses);
            }
        } catch (SocketException e) {
            System.out.println("Connection lost: " + e.getMessage());
        } catch (IOException e) {
            System.out.println("Error reading from server: " + e.getMessage());
            e.printStackTrace();
        }
    }

    protected static void receiveChallengeData(BufferedReader reader, Scanner scanner) throws IOException {
        String serverResponse;
        boolean isChallengeClosed = false;

        while ((serverResponse = reader.readLine()) != null) {
            System.out.println(serverResponse);
            if (serverResponse.startsWith("Challenge Closed")) {
                isChallengeClosed = true;
                break;
            }
            if (serverResponse.startsWith("Question")) {
                if (isChallengeClosed) {
                    System.out.println("Challenge Closed");
                    break;
                }
                // Read the question
                System.out.println(reader.readLine()); // Read the actual question
                System.out.print("Your answer: ");
                String answer = scanner.nextLine();
                writer.println(answer);
                // Read the time taken for the question
                String timeTaken = reader.readLine();
                System.out.println(timeTaken);
                System.out.println();
            } else if (serverResponse.startsWith("Total score for this attempt:") || serverResponse.startsWith("Challenge Report")) {
                // Continue reading the summary report until the end
                while ((serverResponse = reader.readLine()) != null) {
                    System.out.println(serverResponse);
                }
                break;
            }
        }
    }






    protected static void closeConnection( ) {
        try {
            if (socket != null) {
                socket.close();
            }
            if (reader != null) {
                reader.close();
            }
            if (writer != null) {
                writer.close();
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public static void main(String[] args) {
        new MathCompetitionClient();
    }
}
