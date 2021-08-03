<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required', 'max:2048',
        ]);

        $random_number = intval(rand(0,9).rand(0,9));
        $random_string = chr(rand(65,90));

        $user = User::create([
            'fID' => $random_number.$random_string,
            'role' => $request->input('role'),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        if ($request->input('role') == 'student') {
            return redirect()->route('unpaid');
        } elseif ($request->input('role') == 'teacher') {
            return redirect()->route('teacher.home');
        } elseif ($request->input('role') == 'data-operator') {
            return redirect()->route('data-operator.home');
        } else {
            abort(403);
        }
    }
}
