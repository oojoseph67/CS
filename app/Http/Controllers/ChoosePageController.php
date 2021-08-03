<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChoosePageController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'student') {
            return redirect()->route('student.home');
        } elseif (Auth::user()->role == 'hod') {
            return redirect()->route('hod.home');
        } elseif (Auth::user()->role == 'pg-officer') {
            return redirect()->route('pg-officer.home');
        } else {
            abort(403);
        }
    }        
}
