package hil;
import java.util.LinkedHashMap;
import java.util.Map;

import static hil.MathCompetitionClient.*;
public class Student {
    protected static void studentMenu() {
        boolean running = true;
        while (running) {
            System.out.println("\nStudent Menu! \nPlease select your choice:");
            System.out.println("'Register' to register.");
            System.out.println("'View Challenge' to view challenges.");
            System.out.println("'Exit' to exit.");
            System.out.print("Your choice: ");
            String choice = scanner.nextLine().trim();

            if ("Register".equalsIgnoreCase(choice)) {
                userRegistration();
            } else if ("View Challenge".equalsIgnoreCase(choice)) {
              // viewChallenge();
            }  else if ("Exit".equalsIgnoreCase(choice)) {
               // sendChoiceToServer("Exit");
                System.out.println("Exiting program...");
                //closeConnection();
                running = false;
                System.exit(0);
            } else {
                System.out.println("Invalid choice. Please type 'Register', 'View Challenge', 'Attempt Challenge', or 'Exit'.");
            }
        }
    }
    private static void userRegistration() {
        Map<String, String> userDetails = new LinkedHashMap<>();

        // Prompt for user input for each field and collect data
        System.out.println();
        System.out.println("Register!");
        System.out.println("Please enter your details separated by ' , ' in the following order:");
        System.out.println("Username , First Name , Last Name , Email Address , Date of Birth (dd-mm-yyyy) , School Registration Number , image_file.png");
        System.out.print("Your registration details: ");
        String input = scanner.nextLine().trim();

        // Split the input string by " , "
        String[] values = input.split("\\s*\\,\\s*");
        if (values.length != fieldPrompts.size()) {
            System.out.println("Invalid input format. Please ensure you enter all required details separated by ' , '.");
            return; // Exit the method if the input format is incorrect
        }

        // Map the split values to the corresponding fields
        int i = 0;
        for (String key : fieldPrompts.keySet()) {
            userDetails.put(key, values[i++]);
        }

        // Concatenate the user details into a single string
        StringBuilder userDetailsLine = new StringBuilder();
        for (Map.Entry<String, String> entry : userDetails.entrySet()) {
            userDetailsLine.append(entry.getKey()).append(": ").append(entry.getValue()).append(" , ");
        }
        // Remove the last comma and space
        if (userDetailsLine.length() > 0) {
            userDetailsLine.setLength(userDetailsLine.length() - 2);
        }

        // Display the formatted user details in a table
        System.out.println();
        System.out.println("+-------------------------------------------------------------------------------------------------------------------------------------+");
        System.out.println("| " + userDetailsLine.toString() + " |");
        System.out.println("+-------------------------------------------------------------------------------------------------------------------------------------+");

        // After adding user details to the registration table
        registrationTable.add(userDetails);

        // Now send the table to the server
        sendTableToServer();

        // Assuming the last value is the path to the image file
        String imagePath = values[values.length - 1];
        saveImage(imagePath);
    }
}
