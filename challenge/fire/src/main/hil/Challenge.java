package hil;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import static hil.DatabaseHandler.*;
import static hil.DatabaseHandler.recordAttempt;
import static hil.MathCompetitionServer.*;

public class Challenge {
    protected static void attemptSpecificChallenge(String challengeTitle, PrintWriter output, BufferedReader input) {
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
                // Parse the marks from the question data

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
            if (recordAttempt(schoolRegistrationNumber, score, totalChallengeTime)) {
                // Generate and send the summary report
                generateSummaryReport(challengeTitle, questionDetails, score, totalChallengeTime);
            } else {
                output.println("Failed to record the attempt.");
            }
        } catch (SQLException | IOException e) {
            System.err.println("Error during challenge attempt: " + e.getMessage());
            e.printStackTrace();
        }
    }
}
