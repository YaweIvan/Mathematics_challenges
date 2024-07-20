<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Administrator;
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
        // Check if the user is authenticated via session or Auth
        return view('index');
    }
    public function logout()
    {
        // Log out from session and Auth
        session()->forget('user');
        Auth::logout();
        return redirect()->route('login');
    }
}
