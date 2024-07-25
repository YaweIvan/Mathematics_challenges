package hil;

import hil.MathCompetitionClient.*;

import java.io.IOException;

import static hil.MathCompetitionClient.*;

public class Representative {

    private static boolean isLoggedIn = false; // Class-level variable

    protected static void schoolRepMenu() {
        boolean running = true;
        while (running) {
            System.out.println("\nSchool Representative Menu:");
            if (!isLoggedIn) {
                System.out.println("'Login' to login as the school representative");
            }
            if (isLoggedIn) {
                System.out.println("'View Applicants' to view new applicants.");
            }
            System.out.println("'Exit' to exit the program.");
            System.out.print("Enter choice: ");
            String choice = scanner.nextLine().trim();

            if ("login".equalsIgnoreCase(choice) && !isLoggedIn) {
                login();
            } else if ("view applicants".equalsIgnoreCase(choice) && isLoggedIn) {
                viewApplicants();
            } else if ("exit".equalsIgnoreCase(choice)) {
                sendChoiceToServer("Exit");
                System.out.println("Exiting program...");
                closeConnection();
                running = false;
                System.exit(0);
            } else {
                System.out.println("Invalid choice. Please try again.");
            }
        }
    }

    protected static void login() {
        System.out.println();
        System.out.println("****LOGIN****");
        System.out.print("Enter your email: ");
        String email = scanner.nextLine().trim();
        System.out.print("Enter your password: ");
        String password = scanner.nextLine().trim();

        writer.println("LOGIN " + email + " " + password);
        try {
            String response = reader.readLine();
            if ("LOGIN_SUCCESS".equals(response)) {
                isLoggedIn = true; // Update the class-level variable
                System.out.println("Login successful!");
            } else {
                System.out.println(response);
            }

        } catch (IOException e) {
            System.out.println("An error occurred during login.");
            e.printStackTrace();
        }
    }

    protected static void viewApplicants() {
        writer.println("viewApplicants");

        try {
            String serverResponse;
            while (true) {
                serverResponse = reader.readLine();
                if (serverResponse == null) {
                    System.out.println("Server response is null. Exiting loop.");
                    break;
                }

                // Print the details received from the server
                System.out.println(serverResponse);

                // Prompt for the confirmation command if the server is expecting it
                if (serverResponse.contains("Type 'yes' to confirm or 'no' to reject this participant:")) {
                    System.out.print("Enter 'yes' to confirm or 'no' to reject: ");
                    String confirmation = consoleReader.readLine();
                    writer.println(confirmation); // Send the confirmation to the server
                }

                // Check if the end of applicants list has been reached
                if ("End of applicants list.".equals(serverResponse)) {
                    break;
                }
            }
        } catch (IOException e) {
            System.out.println("An error occurred while viewing applicants: " + e.getMessage());
        }
    }

}
