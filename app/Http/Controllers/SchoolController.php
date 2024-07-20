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
    public function edit($schoolRegistrationNumber)
    {
        $school = School::findOrFail($schoolRegistrationNumber);
        return view('schools.edit', compact('school'));
    }
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
