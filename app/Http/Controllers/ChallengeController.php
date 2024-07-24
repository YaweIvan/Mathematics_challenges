<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Imports\ImportAnswers;
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

    public function editChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('admin.edit-challenge', compact('challenge'));
    }

    public function updateChallenge(Request $request, $id)
    {
        $request->validate([
            'openingDate' => 'required|date',
            'closingDate' => 'required|date|after_or_equal:openingDate',
            'number_of_questions' => 'required|integer|min:1',
        ]);

        $challenge = Challenge::findOrFail($id);
        $challenge->openingDate = $request->input('openingDate');
        $challenge->closingDate = $request->input('closingDate');
        $challenge->number_of_questions = $request->input('number_of_questions');
        $challenge->save();

        return redirect()->route('admin.view-challenge')->with('success', 'Challenge updated successfully');
    }

    public function destroyChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();

        return redirect()->route('admin.view-challenge')->with('success', 'Challenge deleted successfully');
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
        Excel::import(new ImportAnswers, $file);
        return redirect()->route('admin.upload-excel-answers')->with('success', 'Answers have been successfully uploaded.');
    }
}
