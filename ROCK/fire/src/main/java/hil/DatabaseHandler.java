package hil;

import java.io.PrintWriter;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

import static hil.MathCompetitionServer.getSchoolRegistration;
import static hil.MathCompetitionServer.getUsername;

public class DatabaseHandler {
    private static final String DB_URL = "jdbc:mysql://localhost:3306/mathematics";
    private static final String DB_USER = "root";
    private static final String DB_PASSWORD = "";
    private static final int MAX_QUESTIONS = 10;

    protected static void handleLogin(String loginRequest, PrintWriter output) {
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
    protected static void challenges(PrintWriter output) {
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
    protected static void saveToDatabase(String userDetails, String tableName) {
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
    public static List<String[]> fetchQuestions(String challengeTitle) throws SQLException {
        List<String[]> questions = new ArrayList<>();
        String query = "SELECT q.Content, a.Correct_Answer, q.Marks " +
                "FROM challenges c " +
                "JOIN challenge_questions cq ON c.Challenge_ID = cq.Challenge_ID " +
                "JOIN questions q ON cq.Question_ID = q.Question_ID " +
                "JOIN answers a ON q.Question_ID = a.Question_ID " +
                "WHERE c.Title = ? " +
                "ORDER BY RAND() LIMIT " + MAX_QUESTIONS;
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
    protected static long[] setQuestionTimeLimit() throws SQLException {
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
    protected static boolean recordAttempt(String challengeTitle, int score, long totalChallengeTime) throws SQLException {
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
}
