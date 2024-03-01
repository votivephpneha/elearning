<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Hash;
use DB;
use Auth;

class UserController extends Controller
{
    public function course_view(){
    	return view("Front.course_view");
    }

    public function theory(){
    	return view("Front.theory");
    }

    public function start_quiz(){
    	return view("Front.start-quiz");
    }

    public function quiz(){
    	return view("Front.quiz");
    }

    public function session_analysis(){
    	return view("Front.session_analysis");
    }

}    