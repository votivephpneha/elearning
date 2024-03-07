<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\Questions;
use App\Models\QuestionBank;
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

	public function fetch_subtopics(Request $request){
		$data['subtopics'] = DB::table("subtopics")->where("course_id", $request->course_id)->where("topic_id", $request->topic_id)
                                ->get(["st_id","title"]);
        return response()->json($data);
	}

	public function post_questions_bank(Request $request){

		$question_title = $request->question_title;
		$question_exam = $request->question_exam;
		$course = $request->course;
		$topics = $request->topics;
		$chapter = $request->chapter;
		$answer_explanation = $request->answer_explanation;
		$options = $request->options;
		$correct_answer_check = $request->correct_answer_check;
		$time_length = $request->time_length;
		$difficulty_level = $request->difficulty_level;
		$marks = $request->marks;

		$questions_data = QuestionBank::all()->last();
		//print_r($correct_answer_check);die;
		if(!empty($questions_data)){
			$new_q_id = $questions_data->q_id+1;
		}else{
			$new_q_id = 1;
		}
		
		$i = 0;
		foreach($options as $op){
			$questions_model = new QuestionBank();

			$questions_model->q_id = $new_q_id; 
			$questions_model->title = $question_title; 
			$questions_model->quiz_exam = $question_exam; 
			$questions_model->course_id = $course; 
			$questions_model->topic_id = $topics; 
			$questions_model->chapter_id = $chapter; 
			$questions_model->correct_answer_explanation = $answer_explanation; 
			$questions_model->Options = $op; 
			$questions_model->correct_answer = $correct_answer_check[$i]; 
			$questions_model->time_length = $time_length; 
			$questions_model->difficulty_level = $difficulty_level; 
			$questions_model->marks = $marks; 
			
			$questions_model->save();
			$i++;
		}	
		Session::flash('message', 'Question added successfully');
		//return route()->redirect("show_questions");
		return redirect()->to('/admin/show_questions');
		

	}

	public function show_questions(){
		$data['questions_data'] = DB::table("question_bank")->orderBy('title')
            ->groupBy('q_id')->get();

		return view("admin.show_questions")->with($data);
	}
}	