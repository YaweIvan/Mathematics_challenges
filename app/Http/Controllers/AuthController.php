<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Models\Question;
use App\Models\School;
use App\Models\Challenge;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $admin = Administrator::where('username', $credentials['username'])->first();   
        if (!$admin) {
            return back()->withErrors(['username' => 'wrong username.']);
        }
        // Verify the password
        if ($credentials['password'] !== $admin->password) {
            return back()->withErrors(['password' => 'The provided password does not match our records.']);
        }
        // Authenticate the admin
        session(['user' => $admin->username]);
        return redirect()->route('dashboardss');
    }
    public function Showdashboard()
    {
        $totalSchools = School::count();
        $totalQuestions = Question::count();
        // Current date
    $currentDate = now();

    // Fetch counts for challenge statuses based on dates
    $ongoingChallenges = \App\Models\Challenge::where('openingDate', '<=', $currentDate)
                                               ->where('closingDate', '>=', $currentDate)
                                               ->count();
    $upcomingChallenges = \App\Models\Challenge::where('openingDate', '>', $currentDate)->count();
    $finishedChallenges = \App\Models\Challenge::where('closingDate', '<', $currentDate)->count();
                                             
        // Pass the counts to the view
        return view('index', compact('totalSchools','totalQuestions','ongoingChallenges','upcomingChallenges','finishedChallenges'));
    }
    public function logout()
    {
        // Log out from session and Auth
        session()->forget('user');
        Auth::logout();
        return redirect()->route('login');
    }
}
