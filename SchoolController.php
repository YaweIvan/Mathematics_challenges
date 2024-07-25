<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }
    public function create()
    {
        return view('admin.manage-schools');
    }
    //the schoolController  stores the inputs requested from the displayed form
    public function store(Request $request)
    {
        $request->validate([
            'schoolRegistrationNumber' => 'required|unique:schools,schoolRegistrationNumber',
            'schoolName' => 'required',
            'district' => 'required',
            'repName' => 'required',
            'repEmail' => 'required|email',
        ]);
        School::create($request->all());

        return redirect()->route('schools.create')
                         ->with('success', 'School created successfully. Add another school.');
    }
    //it helps to edit the details according to the user's demands
    public function edit($schoolRegistrationNumber)
    {
        $school = School::findOrFail($schoolRegistrationNumber);
        return view('schools.edit', compact('school'));
    }
    //it helps to update the details to the user's wants.
    public function update(Request $request, $schoolRegistrationNumber)
    {
        $request->validate([
            'schoolName' => 'required',
            'district' => 'required',
            'repName' => 'required',
            'repEmail' => 'required|email',
        ]);
        $school = School::findOrFail($schoolRegistrationNumber);
        $school->update($request->all());

        return redirect()->route('schools.index')
                         ->with('success', 'School updated successfully.');
    }
    public function destroy($schoolRegistrationNumber)
    {
        $school = School::findOrFail($schoolRegistrationNumber);
        $school->delete();

        return redirect()->route('schools.index')
                         ->with('success', 'School deleted successfully.');
    }
}
