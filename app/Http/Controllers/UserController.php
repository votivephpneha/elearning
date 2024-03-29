<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\SessionAnalysis;
use App\Models\NewSessionAnalysis;
use Response;
use App\Models\Courses;
use App\Models\Topics;
use App\Models\Subtopics;
use App\Models\Exambuilder;
use Hash;
use Session;
use DB;
use Auth;
use App\Models\QuestionBank;

class UserController extends Controller
{

    public function course_view(Request $request){
        $id = base64_decode($request->id);
        $groupedData = DB::table('courses')
                        ->join('topics', 'courses.course_id', '=', 'topics.course_id')
                        ->leftJoin('subtopics', 'topics.topic_id', '=', 'subtopics.topic_id')
                        ->select('topics.topic_id', 'topics.course_id', 'topics.title AS topic_title', 'courses.title AS course_title','topics.status as status','topics.deleted_at as deleted_at')
                        ->selectRaw('GROUP_CONCAT(subtopics.st_id ORDER BY subtopics.st_id ASC) AS chapter_id')
                        ->selectRaw('GROUP_CONCAT(topics.topic_id) AS topics_id_list')
                        ->selectRaw('GROUP_CONCAT(subtopics.st_id ORDER BY subtopics.st_id ASC) AS subtopics_list')
                        ->where('topics.course_id', $id)
                        
                        ->groupBy('topics.topic_id', 'topics.course_id', 'topics.title', 'courses.title')
                        ->orderBy('topics.ordering_id')
                        ->orderBy('subtopics.ordering_id', 'asc') // assuming subtopics.ordering_id exists
                        ->get();
                        // echo "<pre>";
                        // print_r($groupedData);die;
        $course_title = !empty($groupedData->toArray()) ? $groupedData[0]->course_title : "No Data Found";
        $course_id = $id;
        return view('Front.course_view', compact('groupedData','course_title','course_id'));
    }

    public function course_view1(Request $request){
        $id = base64_decode($request->id);
        $data['topics'] = DB::table("topics")->where("course_id",$id)->where("course_id",$id)->orderBy('ordering_id','asc')->get();
        $data['course_title'] = DB::table("courses")->where("course_id",$id)->first();
        //print_r($data['course_title']);die;

        return view('Front.course_view1')->with($data);
    }

    public function theory(Request $request){
        $id =base64_decode($request->id);
         $data['queries'] = DB::table('theory')
        ->where('st_id', '=', $id)
        ->where('status', '=', 1)
        ->where('deleted_at', '=', NULL)
        ->first();
        //print_r($data['queries']);die;
       
        // $pdfUrl = Storage::url('uploads/{{$queries->theory_pdf}}');
        // // echo $pdfUrl;die;
        // $pdfContent = Storage::url('uploads/{{$queries->theory_pdf}}'); // Get the 
        // $headers = ['Content-Type' => 'application/pdf']; // Set the response headers
        // $pdfResponse = new Response($pdfContent, 200, $headers); // Create the PDF 
        return view("Front.theory")->with($data);
    }

    public function start_quiz(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        $data['course_id'] = $request->course_id;
        $data['topic_id'] = $request->topic_id;
        $data['st_id'] = $request->st_id;
        $quiz = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("status",1)->where("deleted_at",NULL)->groupBy('q_id')->get();
        //print_r($quiz);die;
        $i = 0;
        $marks = 0;
        //$total_time = 0;
        foreach($quiz as $q){
            if($q->quiz_exam == "Quiz" || $q->quiz_exam == "Both"){
                $i = $i+1;
                $marks = $marks+$q->marks;
                //$total_time = $total_time + $q->time_length;
            }
        }

        $get_timer = DB::table("subtopics")->where("st_id",$st_id)->first();
        $total_time = $get_timer->quiz_time;

        $min = $total_time/60;
        $mins = number_format($min, 2, '.', '');
        $mins1 = str_replace(".",":",$mins);
        Session::put("timer", $mins);
        $data['question_count'] = $i;
        $data['marks'] = $marks;
        $data['total_time'] = $mins1;

        $data['course_title'] = DB::table("courses")->where("course_id",$course_id)->first();
        $data['subtopic_data'] = DB::table("subtopics")->where("st_id",$st_id)->first();

        $reference_id = "quiz-".rand(10000,99999);
        $data['reference_id'] = $reference_id;
        Session::put("reference_id",$reference_id);

    	return view("Front.start-quiz")->with($data);
    }

    public function start_quiz_exam(Request $request){
        
        $reference_id = base64_decode($request->reference_id);

        $exam_data = DB::table("exam_builder")->where("reference_id",$reference_id)->first();

        $get_exam_data = $exam_data->topics_id;

        $topic_ids = explode(",",$get_exam_data);

        $question_array = array();
        
        $question_count = 0;
        $question_time = 0;
        foreach($topic_ids as $topic_id){

            $question_data = DB::table("question_bank")->where("course_id",$exam_data->course_id)->where("topic_id",$topic_id)->where("difficulty_level",$exam_data->difficulty_level)->get();

            
            
            foreach ($question_data as $q_data) {
                $question_array[] = $q_data;
            }
           
            
        }
        shuffle($question_array);
        $question_time = 0;
        $marks = 0;
        $qu_array = array();
        foreach ($question_array as $q_array) {
            //echo $q_array->time_length."<br>";
            $qu_array[] = $q_array; 
            $question_time = $question_time + $q_array->time_length;
            $marks = $marks + $q_array->marks;
            //echo $question_time."<br>";
            if($exam_data->session_length == "Short"){
                if($question_time >= 600 && $question_time <= 1200){
                    break;
                }
            }
            if($exam_data->session_length == "Medium"){
                if($question_time >= 1800 && $question_time <= 3600){
                    break;
                }
            }
            if($exam_data->session_length == "Long"){
                if($question_time >= 7200 && $question_time <= 10800){
                    break;
                }
            }
        }
        if($exam_data->session_length == "Short"){
            $total_time = $question_time/60;
        }
        if($exam_data->session_length == "Medium"){
            $total_time = $question_time/60;
        }
        if($exam_data->session_length == "Long"){
            $total_time = $question_time/3600;
        }
        $data['total_time'] = $total_time;
        $data['marks'] = $marks;
        $data['question_count'] = count($qu_array);
        
        
        
        // echo $question_count."<br>";
        // echo $question_time/60;
        // echo "<pre>";
        // print_r($question_array[0]);
        $data['course_title'] = DB::table("courses")->where("course_id",$exam_data->course_id)->first();
        
        return view("Front.start_quiz_exam")->with($data);

    }

    public function quiz(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        
        $data['reference_id'] = Session::get("reference_id");
        
        $data['course_id'] = base64_decode($request->course_id);
        $data['topic_id'] = base64_decode($request->topic_id);
        $data['st_id'] = base64_decode($request->st_id);
        $data['timer'] = Session::get("timer");
        $data['quiz'] = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->orderBy('ordering_id', 'ASC')->groupBy('q_id')->get();
        $data['subtopic_data'] = DB::table("subtopics")->where("st_id",$st_id)->first();

        // echo "<pre>";
        // print_r($data['quiz']);die;
    	return view("Front.quiz")->with($data);
    }

    public function submit_quiz(Request $request){

        $reference_id = $request->reference_id;
        $q_id = $request->q_id;
        //echo $request->total_time;die;
        $questions_data = QuestionBank::where("q_id",$q_id)->orderBy('ordering_id', 'ASC')->get();
        //echo "<pre>";
        //print_r($questions_data);die;
        $session_data = NewSessionAnalysis::where("question_id",$q_id)->where("reference_id",$reference_id)->get();
        // echo count($session_data);die;
        // print_r($session_data);
        $reference_id = Session::get("reference_id");
        if(count($session_data) == 0){
            //echo "hello";
            foreach($questions_data as $q_data){
                $new_session_analysis = new NewSessionAnalysis();
                $new_session_analysis->student_id = Auth::guard("customer")->user()->id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->question_id = $q_data->q_id;
                $new_session_analysis->option_id = $q_data->option_id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->topic_id = $q_data->topic_id;
                $new_session_analysis->chapter_id = $q_data->chapter_id;
                $new_session_analysis->questions = $q_data->title;
                $new_session_analysis->options = $q_data->Options;
                $new_session_analysis->correct_answer = $q_data->correct_answer;
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->reference_id = $reference_id;
                $new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->save();
            }

            $session_analysis = new SessionAnalysis();
            $session_analysis->student_id = Auth::guard("customer")->user()->id;
            $session_analysis->course_id = $request->course_id;
            $session_analysis->topic_id = $request->topic_id;
            $session_analysis->subtopic_id = $request->subtopic_id;
            $session_analysis->total_questions = $request->total_questions;
            $session_analysis->attempted_questions = $request->attempted_questions;
            //$session_analysis->quiz_json = $request->quiz_json;
            $session_analysis->reference_id = $reference_id;
            $session_analysis->time_spent_seconds = $request->total_time;

            $session_analysis->save();
        }else{
            
            foreach($session_data as $s_data){
                $new_session_analysis = NewSessionAnalysis::find($s_data->analysis_id);
                
                
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->save();
                
            }
             
        }
    }

    public function submit_question_answer(Request $request){
        $reference_id = $request->reference_id;
        $q_id = $request->q_id;
        //echo $request->answer_val1;die;
        $questions_data = QuestionBank::where("q_id",$q_id)->orderBy('ordering_id', 'ASC')->get();
        $session_data = NewSessionAnalysis::where("question_id",$q_id)->where("reference_id",$reference_id)->get();
        // echo count($session_data);die;
        // print_r($session_data);
        $reference_id = Session::get("reference_id");
        if(count($session_data) == 0){
            foreach($questions_data as $q_data){
                $new_session_analysis = new NewSessionAnalysis();
                $new_session_analysis->student_id = Auth::guard("customer")->user()->id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->question_id = $q_data->q_id;
                $new_session_analysis->option_id = $q_data->option_id;
                $new_session_analysis->course_id = $q_data->course_id;
                $new_session_analysis->topic_id = $q_data->topic_id;
                $new_session_analysis->chapter_id = $q_data->chapter_id;
                $new_session_analysis->questions = $q_data->title;
                $new_session_analysis->options = $q_data->Options;
                $new_session_analysis->correct_answer = $q_data->correct_answer;
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->reference_id = $reference_id;
                $new_session_analysis->time_spent_seconds = $request->ans_time;
                $new_session_analysis->save();
            }

            // $session_analysis = new SessionAnalysis();
            // $session_analysis->student_id = Auth::guard("customer")->user()->id;
            // $session_analysis->course_id = $request->course_id;
            // $session_analysis->topic_id = $request->topic_id;
            // $session_analysis->subtopic_id = $request->subtopic_id;
            // $session_analysis->total_questions = $request->total_questions;
            // $session_analysis->attempted_questions = $request->attempted_questions;
            // //$session_analysis->quiz_json = $request->quiz_json;
            // $session_analysis->reference_id = $reference_id;
            // $session_analysis->time_spent_seconds = $request->total_time;
            // $session_analysis->save();
        }else{
            
            foreach($session_data as $s_data){
                $new_session_analysis = NewSessionAnalysis::find($s_data->analysis_id);
                
                
                $new_session_analysis->student_answer = $request->answer_val1;
                $new_session_analysis->attempted_status = $request->answer_val1;
                $new_session_analysis->time_spent_seconds = $request->ans_time;

                $new_session_analysis->save();
                
            }
             
        }

        

    }



    public function session_analysis(Request $request){
        $course_id = base64_decode($request->course_id);
        $topic_id = base64_decode($request->topic_id);
        $st_id = base64_decode($request->st_id);
        $data['st_id'] = $st_id;
        $data['reference_id'] = Session::get("reference_id");
        $data['questions'] = QuestionBank::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->groupBy('q_id')->get();
        $data['session_analysis'] = NewSessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("chapter_id",$st_id)->where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->orderBy('analysis_id', 'ASC')->groupBy('question_id')->get();
        $data['session_analysis1'] = SessionAnalysis::where("course_id",$course_id)->where("topic_id",$topic_id)->where("subtopic_id",$st_id)->where("reference_id",$data['reference_id'])->where("student_id",Auth::guard("customer")->user()->id)->first();

        
    	return view("Front.session_analysis")->with($data);
    }

    public function exam_builder(){
        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        return view("Front.exam_builder")->with($data);
    }

    public function exam_builder_view(Request $request){
        $course_id = base64_decode($request->course_id);
        $data['topic_data'] = DB::table("topics")->where("course_id",$course_id)->orderBy('ordering_id', 'ASC')->get();
        $data['course_id'] = $course_id;
        return view("Front.exam_builder_view")->with($data);
    }

    public function submit_exam_builder(Request $request){
        $course_id = $request->course_id;
        $topics = implode(",",json_decode($request->topics));
        $question_type = $request->question_type;
        $difficulty_level = $request->difficulty_level;
        $session_length = $request->session_length;
        $reference_id = "exam-".rand(10000,99999);

        $exambuilder = new Exambuilder();
        $exambuilder->course_id = $course_id;
        $exambuilder->topics_id = $topics;
        $exambuilder->question_type = $question_type;
        $exambuilder->difficulty_level = $difficulty_level;
        $exambuilder->session_length = $session_length;
        $exambuilder->reference_id = $reference_id;
        $exambuilder->quiz_type = "exam";
        $exambuilder->save();
        
        return base64_encode($reference_id);
        
    }

    public function user_status(){
        return view("Front.user_status");
    }

    public function settings(){
        $data['user_data'] = Auth::guard('customer')->user();
        return view("Front.settings")->with($data);
    }

    public function theoryOrnot($course_id, $topic_id, $st_id)
    {
        $queries = DB::table('theory')
        ->where('course_id', '=', $course_id)
        ->where('topic_id', '=', $topic_id)
        ->where('st_id', '=', $st_id)
        ->first();
        $check = !empty($queries) ? "Theory" : "";
        $theory_id   =   !empty($queries) ? $queries->theory_id : "";
        $data_onview = array('check'=>$check,'theory_id'=>$theory_id);
        return ($data_onview);
    }

    public function quizOrnot($course_id, $topic_id, $st_id)
    {
        $queries = DB::table('question_bank')
        ->where('course_id', '=', $course_id)
        ->where('topic_id', '=', $topic_id)
        ->where('st_id', '=', $st_id)
        ->first();
        $check = !empty($queries) ? "Quiz" : "";
        $question_id   =   !empty($queries) ? $queries->question_id : "";
        $data_onview = array('check'=>$check,'theory_id'=>$theory_id);
        return ($data_onview);
    }

    public function showPasswordForm(){
        $data['user_data'] = Auth::guard('customer')->user();
        return view("Front.changepassword")->with($data);
    }

    public function change_password(Request $request){


        $user_id = Auth::guard('customer')->user()->id;
        $credentials = [
                'password' => $request->old_password,
                'id' =>  $user_id
            ];
        if(Auth::guard('customer')->attempt($credentials))

        {
            $this->validate($request,["password" => "required_with:confirm_password|same:confirm_password"]);
            DB::table('users')
            ->where('id', $user_id)
            ->update(['password' =>  Hash::make($request->password)]);
            Session::flash('success_message', 'Password Update Sucessfully.');
            return redirect()->to('/user/change_password');

        }else{
            Session::flash('error_message', 'Old Password Not Match.');
            return redirect()->to("/user/change_password");
        }

    }

    public function profile_action(Request $request){

        $id = $request->id;
        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $imageName = "stu".time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/uploads/users'), $imageName);
        }
        else{
            $user_detail  = DB::table('users')->where('id', '=' ,$id)->first();
            $imageName = $user_detail->profile_img;
        }
        $name = trim($request->first_name).' '.trim($request->last_name);
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'name'       => $name,
                    'first_name' => trim($request->first_name),
                    'last_name'  => trim($request->last_name),
                    'profile_img'=> $imageName
                ]);
            Session::flash('message', 'Profile Updated Sucessfully!');
            return redirect()->to('/user/user_dashboard');

    }


}    