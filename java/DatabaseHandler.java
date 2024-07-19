import java.io.*;
import java.net.*;
import java.sql.*;
import java.util.*;
public class DatabaseHandler {
    private static final String DB_URL = "jdbc:mysql://localhost:3306/mathematics";
    private static final String DB_USER = "root";
    private static final String DB_PASSWORD = "";

    protected static boolean authenticateRepresentative(String representativeID, String representativeName) {
        String query = "SELECT * FROM schoolrepresentative WHERE representativeID = ? AND representativeName = ?";
        try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setString(1, representativeID);
            statement.setString(2, representativeName);
            try (ResultSet resultSet = statement.executeQuery()) {
                return resultSet.next();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    protected static void saveToDatabase(String student, String tableName, String representativeID) {
        String[] fields = student.split(",");
        if (fields.length == 6) {
            String query = "INSERT INTO " + tableName + " (userName, firstName, lastName, email, dateOfBirth, representativeID, schoolRegistrationNumber) VALUES (?, ?, ?, ?, ?, ?, ?)";
            try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
                 PreparedStatement statement = connection.prepareStatement(query)) {
                statement.setString(1, fields[0]);
                statement.setString(2, fields[1]);
                statement.setString(3, fields[2]);
                statement.setString(4, fields[3]);
                statement.setString(5, fields[4]);
                statement.setString(6, representativeID);
                statement.setString(7, fields[5]);

                statement.executeUpdate();
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

    protected static void handleAccess(BufferedReader input, PrintWriter output) {
        try {
            // Authentication
            String userName = input.readLine();
            if (!authenticateStudent(userName)) {
                output.println("Access denied");
                return;
            }
            output.println("Access Granted.");
            fetchAndSendChallenges(output);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    protected static boolean authenticateStudent(String userName) {
        String query = "SELECT * FROM participants WHERE userName= ?";
        try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             PreparedStatement statement = connection.prepareStatement(query)) {
            statement.setString(1, userName);
            try (ResultSet resultSet = statement.executeQuery()) {
                return resultSet.next();
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    protected static void fetchAndSendChallenges(PrintWriter output) {
        String query = "SELECT * FROM challenges";
        try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD);
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(query)) {
            while (resultSet.next()) {
                String challenge = resultSet.getString("challengeDescription");
                output.println(challenge);
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

}
