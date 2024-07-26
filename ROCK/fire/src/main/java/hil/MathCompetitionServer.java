package hil;

import java.util.Properties;
import javax.mail.*;
import javax.mail.internet.*;

import java.io.*;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

import static hil.Email.sendEmailNotification;

public class MathCompetitionServer {
    
    private static final int PORT = 8080;
    private static final String PARTICIPANTS_FILE = "C:\\Users\\hp\\OneDrive\\Desktop\\ROCK\\fire\\src\\main\\java\\hil\\Participant.txt";

    private static final String DB_URL = "jdbc:mysql://localhost:3306/mathematics";
    private static final String DB_USER = "root";
    private static final String DB_PASSWORD = "";
    
    private static final int MAX_QUESTIONS = 10;
    private static String schoolRegistrationNumber;
    private static String username;
    public static void main(String[] args) {
        System.out.println("Server is starting...");

        try (ServerSocket serverSocket = new ServerSocket(PORT)) {
            System.out.println("Server is listening on port " + PORT);

            while (true) {
                try (Socket socket = serverSocket.accept()) {
                    System.out.println("New client connected.");

                    BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                    PrintWriter output = new PrintWriter(socket.getOutputStream(), true);

                    

                    String inputLine;

                    while ((inputLine = input.readLine()) != null) {

                        inputLine = inputLine.trim();
                        System.out.println("Received command: " + inputLine);

                        if (inputLine.startsWith("REGISTER")) {
                            receiveRegistrationTable(input, output);
                        } else if (inputLine.startsWith("LOGIN")) {
                            handleLogin(inputLine, output);
                        } else if (inputLine.startsWith("viewApplicants")) {
                            viewApplicants(output, input);
                        } else if (inputLine.startsWith("confirm")) {
                            handleConfirmation(inputLine, inputLine, output);
                        } else if(inputLine.startsWith("view challenge")){
                            challenges(output);
                        } else if(inputLine.startsWith("attempt challenge")){
                            String challengeTitle = inputLine.substring("attempt challenge".length()).trim();
                            attemptSpecificChallenge(challengeTitle, input, output);
                        }else {
                            // Process participant details
                            processParticipantDetails(input, output);
                        }
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

    private static void handleLogin(String loginRequest, PrintWriter output) {
        System.out.println("Processing login request: " + loginRequest); 
        String[] parts = loginRequest.split(" ");
        if (parts.length >= 3) {
            String email = loginRequest.substring(6, loginRequest.lastIndexOf(" ")).trim();
            String password = parts[parts.length - 1].trim();
    
            String sql = "SELECT * FROM schools WHERE Email = ? AND School_Registration_Number = ?";
            try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
                 PreparedStatement pstmt = conn.prepareStatement(sql)) {
    
                pstmt.setString(1, email);
                pstmt.setString(2, password);
    
                ResultSet rs = pstmt.executeQuery();
                if (rs.next()) {
                    output.println("LOGIN_SUCCESS");
                } else {
                    output.println("LOGIN_FAILURE Invalid email, or password.");
                }
            } catch (SQLException e) {
                e.printStackTrace();
                output.println("LOGIN_FAILURE Database error.");
            }
        } else {
            output.println("LOGIN_FAILURE Invalid login format. Use 'LOGIN email password'.");
        }
    }

    private static void receiveRegistrationTable(BufferedReader input, PrintWriter output) {
        try (BufferedWriter writer = new BufferedWriter(new FileWriter(PARTICIPANTS_FILE, true))) {
            String line;
            System.out.println("Receiving registration table...");
            while ((line = input.readLine()) != null && !line.equals("END_OF_TABLE")) {
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

    private static void processParticipantDetails(BufferedReader input, PrintWriter output) throws IOException {
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
    
        // Write remaining lines back to the file
        try (BufferedWriter fileWriter = new BufferedWriter(new FileWriter(PARTICIPANTS_FILE))) {
            for (String remainingLine : remainingLines) {
                fileWriter.write(remainingLine);
                fileWriter.newLine();
            }
        }
    
        output.println("End of file reached.");
    }    

    private static void viewApplicants(PrintWriter output, BufferedReader input) throws IOException {
        try (BufferedReader fileReader = new BufferedReader(new FileReader(PARTICIPANTS_FILE))) {
            String line;
            while ((line = fileReader.readLine()) != null) {
                String userDetails = formatUserDetails(line);
                output.println(userDetails);
                output.println("Type 'yes' to confirm or 'no' to reject this participant:");
    
                String confirmation = input.readLine();
                handleConfirmation(confirmation,userDetails,output);
            }
            output.println("End of applicants list.");
        }
    }

    private static void handleConfirmation(String confirmation, String userDetails, PrintWriter output) throws IOException {
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

    private static void saveToDatabase(String userDetails, String tableName) {
        String[] details = userDetails.split("\n");
        if (details.length < 7) {
            System.out.println("Error: Expected 7 elements in userDetails, but got " + details.length);
            for (int i = 0; i < details.length; i++) {
                System.out.println("details[" + i + "]: " + details[i]);
            }
            return;
        }

        String sql = "INSERT INTO " + tableName + " (Username, First_Name, Last_Name, Email_Address, Date_of_Birth, School_Registration_Number, Image_File) VALUES (?, ?, ?, ?, ?, ?, ?)";
        try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement pstmt = conn.prepareStatement(sql)) {

            pstmt.setString(1, details[0].split(": ")[1].trim());
            pstmt.setString(2, details[1].split(": ")[1].trim());
            pstmt.setString(3, details[2].split(": ")[1].trim());
            pstmt.setString(4, details[3].split(": ")[1].trim());
            pstmt.setString(5, details[4].split(": ")[1].trim());
            pstmt.setString(6, details[5].split(": ")[1].trim());
            pstmt.setString(7, details[6].split(": ")[1].trim());

            pstmt.executeUpdate();
        } catch (SQLException e) {
            System.out.println("Database error: " + e.getMessage());
        }
    }  



    private static void challenges(PrintWriter output) {
        String query = "SELECT Challenge_ID, Title, Start_Date, End_Date FROM challenges";
        try(Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
            PreparedStatement statement = conn.prepareStatement(query);
            ResultSet resultSet = statement.executeQuery();) {

            Date currentDate = new Date(System.currentTimeMillis());
            Date zeroDate = Date.valueOf("1970-01-01");

            output.println(String.format("%-5s %-30s %-15s %-15s %-10s", "ID", "Title", "Start Date", "End Date", "Status"));
            output.println("---------------------------------------------------------------------------------");

            while (resultSet.next()) {
                int challengeId = resultSet.getInt("Challenge_ID");
                String title = resultSet.getString("Title");
                Date startDate = null;
                Date endDate = null;

                try {
                    startDate = resultSet.getDate("Start_Date");
                } catch (SQLException e) {
                    if (e.getMessage().contains("Zero date value prohibited")) {
                        startDate = null;
                    } else {
                        throw e;
                    }
                }

                try {
                    endDate = resultSet.getDate("End_Date");
                } catch (SQLException e) {
                    if (e.getMessage().contains("Zero date value prohibited")) {
                        endDate = null;
                    } else {
                        throw e;
                    }
                }

                // Handle zero date values
                if (startDate != null && startDate.toString().equals("0000-00-00")) {
                    startDate = null;
                }
                if (endDate != null && endDate.toString().equals("0000-00-00")) {
                    endDate = null;
                }

                String status;
                if (startDate == null || endDate == null || startDate.equals(zeroDate) || endDate.equals(zeroDate)) {
                    status = "Closed";
                } else {
                    status = endDate.after(currentDate) ? "Open" : "Closed";
                }

                output.println(String.format("%-5s %-30s %-15s %-15s %-10s", challengeId, title, startDate != null ? startDate : "N/A", endDate != null ? endDate : "N/A", status));
            }
            output.println("---------------------------------------------------------------------------------"); // End of data marker
            output.println(" ");
        } catch (SQLException e) {
            System.err.println("Error fetching challenges: " + e.getMessage());
            e.printStackTrace();
        }
    }

    private static void attemptSpecificChallenge(String challengeTitle, BufferedReader input, PrintWriter output) {
        try {
            if (!isChallengeOpen(challengeTitle)) {
                output.println("This challenge is closed");
                return;
            }
    
            // Get the challenge duration and number of questions
            long[] challengeDetails = setQuestionTimeLimit();
            long duration = challengeDetails[0];
            int numberOfQuestions = (int) challengeDetails[1];
            long QUESTION_TIME_LIMIT_MS = duration / numberOfQuestions;
    
            List<String[]> questions = fetchQuestions(challengeTitle);
            if (questions.isEmpty()) {
                output.println("No questions available for this challenge.");
                return;
            }
    
            int score = 0;
            long totalChallengeTime = 0;
            List<String[]> questionDetails = new ArrayList<>();
    
            for (int i = 0; i < questions.size(); i++) {
                String[] question = questions.get(i);
                output.println("Question " + (i + 1) + ": ");
                output.println(question[0]); // Display question content
    
                long startTime = System.currentTimeMillis();
                String answer = input.readLine();
                long endTime = System.currentTimeMillis();
                long timeTaken = endTime - startTime;
                totalChallengeTime += timeTaken;
    
                // Calculate the score for the current question
                int questionScore = calculateScore(question[1], answer, Double.parseDouble(question[2]));
                score += questionScore;
                output.println("Time taken for this question: " + (timeTaken / 1000) + " seconds");
                questionDetails.add(new String[]{question[0], answer, question[1], String.valueOf(questionScore), String.valueOf(timeTaken / 1000)});
                output.println();
    
                if (timeTaken > QUESTION_TIME_LIMIT_MS) {
                    continue; // Move to the next question
                }
    
                // Check if the total challenge time exceeds the allowed duration
                if (totalChallengeTime > duration) {
                    output.println("Challenge duration exceeded. Terminating the challenge.");
                    break;
                }
            }
    
            output.println("Total score for this attempt: " + score);
            output.println("Total time taken for this challenge: " + (totalChallengeTime / 1000) + " seconds");
    
            // Record the attempt in the database
            if (recordAttempt(challengeTitle, score, totalChallengeTime)) {
                // Generate and send the summary report
                generateSummaryReport(challengeTitle, questionDetails, score, totalChallengeTime, output, input);
            } else {
                output.println("Failed to record the attempt.");
            }
        } catch (SQLException | IOException e) {
            System.err.println("Error during challenge attempt: " + e.getMessage());
            e.printStackTrace();
        }
    }    
    
    private static long[] setQuestionTimeLimit() throws SQLException {
        String query = "SELECT Duration, Number_of_Questions FROM challenges LIMIT 1";
        try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = conn.prepareStatement(query);
             ResultSet resultSet = statement.executeQuery()) {
    
            if (resultSet.next()) {
                long duration = resultSet.getLong("Duration");
                int numberOfQuestions = resultSet.getInt("Number_of_Questions");
                return new long[]{duration, numberOfQuestions};
            } else {
                // Default to 30 seconds if no data is found
                return new long[]{30000, 1};
            }
        } catch (SQLException e) {
            System.err.println("Error during set question time: " + e.getMessage());
            throw e; // Re-throw the exception to ensure it is handled by the caller
        }
    }
        
    // Your calculateScore method
    private static int calculateScore(String correctAnswer, String givenAnswer, double fullMarks) {
        if (givenAnswer.equals("-")) {
            return 0;
        } else if (givenAnswer.equalsIgnoreCase(correctAnswer)) {
            return (int) fullMarks;
        } else {
            return -3;
        }
    }    
    
    private static boolean recordAttempt(String challengeTitle, int score, long totalChallengeTime) throws SQLException {
        String query = "INSERT INTO Attempts (Challenge_Title, Score, Time_Taken, School_Registration_Number, Username) VALUES (?, ?, ?, ?, ?)";
        try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = conn.prepareStatement(query)){
                statement.setString(1, challengeTitle);
                statement.setInt(2, score);
                statement.setLong(3, totalChallengeTime);
                statement.setString(4, getSchoolRegistration());
                statement.setString(5, getUsername());
                
            statement.executeUpdate();
            return true;
        } catch (SQLException e) {
            System.err.println("Error during recording attempts: " + e.getMessage());
            throw e;
        }
        
    }

    public static String getSchoolRegistration(){
        return schoolRegistrationNumber;
    }

    public static String getUsername(){
        return username;
    }

    public static List<String[]> fetchQuestions(String challengeTitle) throws SQLException {
        List<String[]> questions = new ArrayList<>();
        String query = "SELECT q.Content, a.Correct_Answer, q.Marks " +
                       "FROM challenges c " +
                       "JOIN challenge_questions cq ON c.Challenge_ID = cq.Challenge_ID " +
                       "JOIN questions q ON cq.Question_ID = q.Question_ID " +
                       "JOIN answers a ON q.Question_ID = a.Question_ID " +
                       "WHERE c.Title = ? " +
                       "ORDER BY RAND() LIMIT " + MathCompetitionServer.MAX_QUESTIONS;
        try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = conn.prepareStatement(query)) {
            statement.setString(1, challengeTitle);
            try (ResultSet resultSet = statement.executeQuery()) {
                while (resultSet.next()) {
                    String question = resultSet.getString("Content");
                    String answer = resultSet.getString("Correct_Answer");
                    String marks = resultSet.getString("Marks");
                    questions.add(new String[]{question, answer, marks});
                }
            }
        } catch (SQLException e) {
            System.err.println("SQL error while fetching questions: " + e.getMessage());
            e.printStackTrace();
        }
        System.out.println("Fetched " + questions.size() + " questions for challenge: " + challengeTitle);
        return questions;
    }    

    private static boolean isChallengeOpen(String challengeTitle) throws SQLException {
        String query = "SELECT End_Date FROM challenges WHERE Title = ?";
        try (Connection conn = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = conn.prepareStatement(query)) {
            statement.setString(1, challengeTitle);
            try (ResultSet resultSet = statement.executeQuery()) {
                if (resultSet.next()) {
                    Date endDate = resultSet.getDate("End_Date");
                    return endDate == null || endDate.after(new Date(System.currentTimeMillis()));
                }
            }
        }
        return false;
    }
    
    private static void generateSummaryReport(String schoolRegistrationNumber, List<String[]> questionDetails, int totalScore, long totalChallengeTime, PrintWriter output, BufferedReader input) {
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
