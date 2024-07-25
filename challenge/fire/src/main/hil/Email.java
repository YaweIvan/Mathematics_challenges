package hil;
import javax.mail.*;
import javax.mail.internet.*;
import java.io.PrintWriter;
import java.util.Properties;

public class Email {
    protected static void sendEmailNotification(String email, String username, String status, PrintWriter output) {
        String host = "smtp.gmail.com";
        final String from = "themathcompetition@gmail.com";
        final String password = "mathcompetition123"; // Use an app password for Gmail

        Properties properties = new Properties();
        properties.put("mail.smtp.host", host);
        properties.put("mail.smtp.port", "587");
        properties.put("mail.smtp.auth", "true");
        properties.put("mail.smtp.starttls.enable", "true");
        properties.put("mail.smtp.ssl.protocols", "TLSv1.2"); // Explicitly set TLS version


        // Set TLS protocols
        System.setProperty("https.protocols", "TLSv1.2");

        Session session = Session.getInstance(properties, new javax.mail.Authenticator() {
            protected PasswordAuthentication getPasswordAuthentication() {
                return new PasswordAuthentication(from, password);
            }
        });

        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(from));
            message.setRecipients(Message.RecipientType.TO, InternetAddress.parse(email));
            message.setSubject("Participant Status Notification");

            String emailContent = "Dear " + username + ",\n\n" +
                    "Your participation status is: " + status + ".\n\n" +
                    "Thank you,\n" +
                    "Mathematics Challenge Team";
            message.setText(emailContent);

            Transport.send(message);
            System.out.println("Email sent successfully to " + username);
        } catch (MessagingException e) {
            e.printStackTrace();
            output.println("EMAIL_FAILURE An error occurred while sending the email.");
        }
    }

}
