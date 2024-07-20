<?php

// In app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        // Manually specify the admin credentials
        $adminUsername = 'admin';
        $adminPassword = 'password123';
        if ($request->username === $adminUsername && $request->password === $adminPassword) {
            // Store the admin user in the session
            Session::put('admin', true);
            return redirect()->route('dashboard'); // Change this to your dashboard route
        } else {
            return back()->withErrors(['Invalid username or password.']);
        }
    }
}
