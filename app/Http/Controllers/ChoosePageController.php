<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChoosePageController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'super-admin') {
            return redirect()->route('super-admin.home');
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route('admin.home');
        } elseif (Auth::user()->role == 'student') {
            return redirect()->route('student.home');
        } elseif (Auth::user()->role == 'teacher') {
            return redirect()->route('teacher.home');
        } elseif (Auth::user()->role == 'data-operator') {
            return redirect()->route('data-operator.home');
        } else {
            abort(403);
        }
    }        
}
