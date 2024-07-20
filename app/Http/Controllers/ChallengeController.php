<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Imports\ImportAnswers; // Correct import
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Challenge;
use App\Models\Answer;

class ChallengeController extends Controller
{
    public function setChallenge(Request $request)
    {
        $request->validate([
            'challengeID' => 'required|string',
            'openingDate' => 'required|date',
            'closingDate' => 'required|date',
            'duration' => 'required|integer',
            'number_of_questions' => 'required|integer'
        ]);
        Challenge::create([
            'challengeID' => $request->challengeID,
            'openingDate' => $request->openingDate,
            'closingDate' => $request->closingDate,
            'duration' => $request->duration,
            'number_of_questions' => $request->number_of_questions
        ]);
        return redirect()->route('admin.view-challenge')->with('success', 'Challenge set successfully');
    }
    public function viewChallenges()
    {
        $challenges = Challenge::all();
        return view('admin.view-challenge', compact('challenges'));
    }
    // QUESTIONS SECTION
    public function showExcelUploadForm()
    {
        return view('excelQuestions');
    }
    public function uploadQuestions(Request $request)
    {
        $request->validate([
            'questionsFile' => 'required|mimes:xlsx'
        ]);

        $file = $request->file('questionsFile');
        Excel::import(new QuestionsImport, $file);
        return back()->with('success', 'Questions uploaded successfully.');
    }
    // ANSWERS SECTION
    public function showExcelAnswersUploadForm()
    {
        return view('excelAnswer');
    }
    public function uploadExcelAnswers(Request $request)
    {
        $request->validate([
            'answersFile' => 'required|file|mimes:xlsx'
        ]);
        $file = $request->file('answersFile');
        // Use the import class to handle the file
        Excel::import(new ImportAnswers, $file);
        return redirect()->route('admin.upload-excel-answers')->with('success', 'Answers have been successfully uploaded.');
    }
}
