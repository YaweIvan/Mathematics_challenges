package hil;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import java.util.List;

import static hil.Challenge.attemptSpecificChallenge;
import static hil.DatabaseHandler.*;
import static hil.Email.sendEmailNotification;

public class MathCompetitionServer {

    private static final int PORT = 8080;
    private static final String PARTICIPANTS_FILE = "C:\\Users\\hp\\OneDrive\\Desktop\\challenge\\fire\\src\\main\\java\\hil\\Participant.txt";

    protected static BufferedReader input;
    protected static PrintWriter output;

    protected static String schoolRegistrationNumber;
    public static void main(String[] args) {
        System.out.println("Server is starting...");

        try (ServerSocket serverSocket = new ServerSocket(PORT)) {
            System.out.println("Server is listening on port " + PORT);

            while (true) {
                try (Socket socket = serverSocket.accept()) {
                    System.out.println("New client connected.");

                         input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                         output = new PrintWriter(socket.getOutputStream(), true);
                    String role = input.readLine();
                        System.out.println("Chosen role:" + role);

                    String inputLine = input.readLine().trim();
                        System.out.println("Received command: " + inputLine);

                            if (inputLine.equalsIgnoreCase("register")) {
                            receiveRegistrationTable();
                        } else if (inputLine.equalsIgnoreCase("login")) {
                            handleLogin(inputLine);
                        } else if (inputLine.equalsIgnoreCase("viewApplicants")) {
                            viewApplicants();
                        } else if (inputLine.equalsIgnoreCase("confirm")) {
                            handleConfirmation(inputLine, inputLine);
                        } else if(inputLine.equalsIgnoreCase("view challenge")){
                            Challenges();
                        } else if(inputLine.startsWith("attempt challenge")){
                            String challengeTitle = inputLine.substring("attempt challenge".length()).trim();
                            attemptSpecificChallenge(challengeTitle, output, input);
                        }else {
                            // Process participant details
                            processParticipantDetails();
                        }


                    schoolRegistrationNumber = input.readLine();
                    if (schoolRegistrationNumber == null || schoolRegistrationNumber.isEmpty()) {
                        output.println("Invalid School Registration Number");
                        return;
                    }

                } catch (IOException e) {
                    System.out.println("Exception caught when trying to listen on port " + PORT + " or listening for a connection");
                    System.out.println(e.getMessage());
                }
            }
        } catch (IOException e) {
            System.out.println("Could not listen on port: " + PORT);
            System.out.println(e.getMessage());
        }
    }


    private static void receiveRegistrationTable() {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(PARTICIPANTS_FILE, true))) {
            String line = input.readLine();
            System.out.println("Receiving registration table..." + line);
        while (line != null && !line.equals("END_OF_TABLE")) {
            writer.write(line);
            writer.newLine();
        }

            output.println("Registration table received and stored successfully.");
            System.out.println("Registration table stored successfully."); // Debug statement
        } catch (IOException e) {
            output.println("An error occurred while receiving the registration table: " + e.getMessage());
            System.out.println("Error while receiving the registration table: " + e.getMessage()); // Debug statement
        }
    }

    protected static void processParticipantDetails() throws IOException {
        List<String> lines = new ArrayList<>();
        try (BufferedReader fileReader = new BufferedReader(new FileReader(PARTICIPANTS_FILE))) {
            String line;
            while ((line = fileReader.readLine()) != null) {
                lines.add(line);
            }
        }

        List<String> remainingLines = new ArrayList<>();
        for (String line : lines) {
            String userDetails = formatUserDetails(line);
            String username = userDetails.split("\n")[0].split(": ")[1];
            String email = userDetails.split("\n")[3].split(": ")[1];

            output.println(userDetails);
            output.println("Type 'yes' to confirm or 'no' to reject this participant:");
            output.flush();

            String confirmation = input.readLine();
            if ("yes".equalsIgnoreCase(confirmation)) {
                saveToDatabase(userDetails, "participants");
                output.println("Participant confirmed.");
                sendEmailNotification(email, username, "confirmed", output);
            } else if ("no".equalsIgnoreCase(confirmation)) {
                saveToDatabase(userDetails, "rejected_applicants");
                output.println("Participant rejected.");
                sendEmailNotification(email, username, "rejected", output);
            } else if ("exit".equalsIgnoreCase(confirmation)) {
                remainingLines.add(line);
                break;
            } else {
                remainingLines.add(line);
            }
        }

        // Clear the file after processing
        new PrintWriter(PARTICIPANTS_FILE).close();

        output.println("End of file reached.");
    }

    protected static void viewApplicants() throws IOException {
        try (BufferedReader fileReader = new BufferedReader(new FileReader(PARTICIPANTS_FILE))) {
            String line;
            while ((line = fileReader.readLine()) != null) {
                String userDetails = formatUserDetails(line);
                output.println(userDetails);
                output.println("Type 'yes' to confirm or 'no' to reject this participant:");

                String confirmation = input.readLine();
                handleConfirmation(confirmation,userDetails);
            }
            output.println("End of applicants list.");
        }
    }

    protected static void handleConfirmation(String confirmation, String userDetails) throws IOException {
        String[] details = userDetails.split("\n");

        if (details.length < 7) {
            output.println("Error: Insufficient user details provided.");
            output.flush();
            return;
        }

        String username = details[0].split(": ")[1].trim();
        String email = details[3].split(": ")[1].trim();

        if ("yes".equalsIgnoreCase(confirmation)) {
            saveToDatabase(userDetails, "participants"); // For confirmed participants
            output.println("Participant confirmed.");
            sendEmailNotification(email, username, "confirmed", output);
        } else if ("no".equalsIgnoreCase(confirmation)) {
            saveToDatabase(userDetails, "rejected"); // For rejected participants
            output.println("Participant rejected.");
            sendEmailNotification(email, username, "rejected", output);
        } else {
            output.println("Invalid input. Please type 'yes' to confirm or 'no' to reject.");
        }
        output.flush();
    }

    private static String formatUserDetails(String userDetailsLine) {
        String[] details = userDetailsLine.split(",");

        // Ensure the correct number of details
        if (details.length != 7) {
            return "Invalid user details format.";
        }

        // Format user details
        StringBuilder formattedDetails = new StringBuilder();
        formattedDetails.append(details[0].trim()).append("\n");
        formattedDetails.append(details[1].trim()).append("\n");
        formattedDetails.append(details[2].trim()).append("\n");
        formattedDetails.append(details[3].trim()).append("\n");
        formattedDetails.append(details[4].trim()).append("\n");
        formattedDetails.append(details[5].trim()).append("\n");
        formattedDetails.append(details[6].trim()).append("\n");

        return formattedDetails.toString();
    }
    // Your calculateScore method
    protected static int calculateScore(String correctAnswer, String givenAnswer, double fullMarks) {
        if (givenAnswer.equals("-")) {
            return 0;
        } else if (givenAnswer.equalsIgnoreCase(correctAnswer)) {
            return (int) fullMarks;
        } else {
            return -3;
        }
    }
// A summary report generated to be displayed on the commandline after the student answers
    protected static void generateSummaryReport(String schoolRegistrationNumber, List<String[]> questionDetails, int totalScore, long totalChallengeTime) {
        // Define the maximum length for the question text
        int maxQuestionLength = 50;
        output.println("\nMath Challenge Summary Report for: " + schoolRegistrationNumber);
        output.println(String.format("%-50s %-15s %-15s %-10s %-15s", "Question", "Your Answer", "Correct Answer", "Score", "Time Taken (s)"));
        output.println("----------------------------------------------------------------------------------------------------------");

        for (int i = 0; i < questionDetails.size(); i++) {
            String[] details = questionDetails.get(i);
            String questionText = details[0];

            List<String> questionLines = new ArrayList<>();
            while (questionText.length() > maxQuestionLength) {
                questionLines.add(questionText.substring(0, maxQuestionLength));
                questionText = questionText.substring(maxQuestionLength);
            }
            questionLines.add(questionText);

            output.println(String.format("%-50s %-15s %-15s %-10s %-15s",
                questionLines.get(0),
                details[1],
                details[2],
                details[3],
                details[4]));

            // Print the remaining lines of the question text
            for (int j = 1; j < questionLines.size(); j++) {
                output.println(String.format("%-5s %-50s", "", questionLines.get(j)));
            }
        }

        output.println("----------------------------------------------------------------------------------------------------------");
        output.println("Total Score: " + totalScore);
        output.println("Total Time Taken: " + (totalChallengeTime / 1000) + " seconds");
        output.println("End of summary report.");
    }

}
