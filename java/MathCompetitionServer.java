import java.io.*;
import java.net.*;
import java.sql.*;
import java.util.*;

public class MathCompetitionServer {
    private static final int PORT = 8080;
    private static final String DB_URL = "jdbc:mysql://localhost:3306/mathematics";
    private static final String DB_USER = "root";
    private static final String DB_PASSWORD = "";

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
                    System.out.println(e.getMessage());
                }
            }
        } catch (IOException e) {
            System.out.println("Could not listen on port: " + PORT);
            System.out.println(e.getMessage());
        }
    }

    private static void handleClient(Socket socket) {
        try {
            BufferedReader input = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            PrintWriter output = new PrintWriter(socket.getOutputStream(), true);

            String choice = input.readLine();

            if ("Register".equalsIgnoreCase(choice)) {
                String userData = input.readLine();
                saveRegistration(userData);
                output.println("Registration received. Thank you!");
            } else if ("ConfirmReject".equalsIgnoreCase(choice)) {
                handleConfirmation(input, output);
            }

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static void saveRegistration(String userData) {
        try (PrintWriter out = new PrintWriter(new BufferedWriter(new FileWriter("registered_students.txt", true)))) {
            out.println(userData);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static void handleConfirmation(BufferedReader input, PrintWriter output) {
        try {
            // Authentication
            String representativeID = input.readLine();
            String representativeName = input.readLine();

            if (!authenticateRepresentative(representativeID, representativeName)) {
                output.println("Authentication failed. Disconnecting.");
                return;
            }

            output.println("Authentication successful.");

            List<String> students = new ArrayList<>();
            try (BufferedReader reader = new BufferedReader(new FileReader("registered_students.txt"))) {
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
                    saveToDatabase(student, "participants", representativeID);
                } else if ("R".equalsIgnoreCase(decision)) {
                    saveToDatabase(student, "rejected", representativeID);
                }
            }

                // Clear the temporary file after processing
                new PrintWriter("registered_students.txt").close();

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private static boolean authenticateRepresentative(String representativeID, String representativeName) {
        try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD)) {
            String query = "SELECT * FROM schoolrepresentative WHERE representativeID = ? AND representativeName = ?";
            try (PreparedStatement statement = connection.prepareStatement(query)) {
                statement.setString(1, representativeID);
                statement.setString(2, representativeName);
                try (ResultSet resultSet = statement.executeQuery()) {
                    return resultSet.next();
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    private static void saveToDatabase(String student, String tableName, String representativeID) {
        String[] fields = student.split(",");
        if (fields.length == 6) {
            try (Connection connection = DriverManager.getConnection(DB_URL, DB_USER, DB_PASSWORD)) {
                String query = "INSERT INTO " + tableName + " (userName, firstName, lastName, email, dateOfBirth, representativeID, schoolRegistrationNumber) VALUES (?, ?, ?, ?, ?, ?, ?)";
                try (PreparedStatement statement = connection.prepareStatement(query)) {
                    statement.setString(1, fields[0]);
                    statement.setString(2, fields[1]);
                    statement.setString(3, fields[2]);
                    statement.setString(4, fields[3]);
                    statement.setString(5, fields[4]);
                    statement.setString(6, representativeID);
                    statement.setString(7, fields[5]);

                    statement.executeUpdate();
                }
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
    }

}
