<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\Questions;
use DB,Validator;
use Hash;
use Auth;

class AdminquesController1 extends Controller{

    public function __construct(){

    	$this->middleware('admin'); // Class admin does not exist

    }

	public function index(){
		return view("admin.add_questions");
	}

	public function post_questions(Request $request){
		$questions = $request->questions1;
		$options = $request->options;
		$correct_answer = $request->correct_answer;
		$marks = $request->marks;
		$time = $request->time;

		$options_value = implode(",",$options);

		$questions_model = new Questions();

		$questions_model->question = $questions; 
		$questions_model->options = $options_value; 
		$questions_model->correct_answer = $correct_answer; 
		$questions_model->default_marks = $marks; 
		$questions_model->default_time = $time; 
		$questions_model->save();

		
	}

	public function add_questions_bank(){
		return view("admin.add_questions_bank");
	}
}	