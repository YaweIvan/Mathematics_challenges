<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\AttemptQuestion;
use App\Models\Challenge; // Ensure this is imported
use PDF;
use Mail;

class ReportController extends Controller
{
    // Method to generate reports at the close of a challenge
    public function generateReports($challengeID)
    {
        $participants = Participant::all();

        foreach ($participants as $participant) {
            $attempts = AttemptQuestion::where('challengeID', $challengeID)
                                       ->where('participantID', $participant->id) // Ensure 'participantID' matches your schema
                                       ->get();

            $data = [
                'participant' => $participant,
                'attempts' => $attempts,
            ];

            $pdf = PDF::loadView('reports.participant_report', $data);
            $pdf->save(storage_path('app/reports/' . $participant->username . '_report.pdf')); // Use 'username' or 'id' as needed

            // Send email with PDF attachment
            Mail::send('emails.report', $data, function($message) use ($participant, $pdf) {
                $message->to($participant->participantEmail)
                        ->subject('Challenge Report')
                        ->attachData($pdf->output(), 'report.pdf');
            });
        }
    }

    // Method to display report in the admin section
    public function showReports($challengeID)
    {
        $attempts = AttemptQuestion::where('challengeID', $challengeID)->get();
        return view('admin.reports', compact('attempts'));
    }

    // Method to pass challenges to the view
    public function someControllerMethod()
    {
        $challenges = Challenge::all(); // Fetch all challenges
        return view('path.to.your.view', compact('challenges'));
    }
}
