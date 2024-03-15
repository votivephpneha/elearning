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

	public function add_questions_bank(Request $request){

		return view("admin.add_questions_bank");
	}

	public function edit_questions_bank(Request $request){
		

		$id = base64_decode($request->id);

		if($id){
		  $question_details  = DB::table("question_bank")->where('question_id','=',$id)->first();
          $options  = DB::table("question_bank")->where('q_id','=',$question_details->q_id)->get();
          $data_onview = array('id'=>$id,'question_details'=>$question_details,'options'=>$options);
          return view("admin.edit_questions_bank")->with($data_onview);
		 }
	}

	public function fetch_subtopics(Request $request){
		$data['subtopics'] = DB::table("subtopics")->where("course_id", $request->course_id)->where("topic_id", $request->topic_id)
                                ->get(["st_id","title"]);
        return response()->json($data);
	}

	public function post_questions_bank(Request $request){

		// echo "<pre>";
		// dd($request);die;

            

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
		//print_r($correct_answer_check);die;
		//echo $correct_answer_check[3];die;
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
		$data['questions_data'] = DB::table("question_bank")->orderBy('ordering_id', 'ASC')
            ->groupBy('q_id')->get();

		return view("admin.show_questions")->with($data);
	}

	public function question_delete(Request $request){
		$id = base64_decode($request->id);
		$question_bank = QuestionBank::find($id);
        $question_bank->delete();
        $question = QuestionBank::find($id);
        if (!$question) {
            Session::flash('message', 'Question Information Deleted Successfully!');
        } else {
            Session::flash('error', 'Question not found or could not be deleted!');
        }
        return Redirect('/admin/show_questions');

	}

	public function question_status(Request $request){
       $result = DB::table('question_bank')
                    ->where('question_id', $request->question_id)
                    ->update(['status' => $request->status]);
                    if ($result) {
                    	return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
        	return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }

    }

public function post_questions_bank_edit(Request $request){

			$options = $request->options;

			echo "<pre>";

				// print_r($options);die;

    $correct_answer_check = $request->correct_answer_check;

	  DB::table('question_bank')
                ->where('question_id', $request->question_id)
                ->update([
                	'title' => trim($request->question_title),
                	'quiz_exam' => $request->question_exam,
                	'course_id'        => $request->course,
                	'topic_id'        => $request->topics,
                	'chapter_id'       => $request->chapter,
                	'correct_answer_explanation' => $request->correct_answer_check,
                	'time_length'         => $request->time_length,
                	'difficulty_level' => $request->difficulty_level,
                	'marks' => $request->marks
                ]);
                // Update options
    foreach($options as  $index=>$op){


        $option->is_correct = in_array($index, $correct_answer_check);


      




        $option->save();
    }

    Session::flash('message', 'Question updated successfully');
    return redirect()->to('/admin/show_questions');
}

public function update_questionorder(Request $request)
    {    
        $questions = QuestionBank::all();
    

        foreach ($questions as $questionsVal) {

            foreach ($request->order as $order) {

                if ($order['question_id'] == $questionsVal->question_id) {

                    $questionsVal->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

}	