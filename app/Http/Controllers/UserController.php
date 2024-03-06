<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Response;
use App\Models\Courses;
use App\Models\Topics;
use App\Models\Subtopics;
use Hash;
use DB;
use Auth;

class UserController extends Controller
{


     public function course_view(Request $request){
        $id = base64_decode($request->id);


        $course_detail = Topics::where("topics.course_id", $id)
        ->leftjoin('courses', 'topics.course_id', '=', 'courses.course_id')
        ->get(['topics.topic_id', 'topics.title as topic_title', 'courses.course_id as main_course_id', 'courses.title as course_title']);

        if ($course_detail->count() > 0) {
            $course_title = $course_detail[0]->course_title;
        } else {
            $course_title = '';
        }
        $chapert_list = [];
        foreach ($course_detail as $list) {
            $subtopics = Subtopics::where("subtopics.topic_id", $list->topic_id)
            ->leftJoin('topics', 'topics.topic_id', '=', 'subtopics.topic_id')
            ->select('subtopics.title as chapter_title', 'topics.topic_id as topic_title_id', 'topics.title as topic_title')
            ->get();
            foreach ($subtopics as $subtopic) {
                $chapert_list[$subtopic->topic_title_id][] = [
                    'chapter_title' => $subtopic->chapter_title,
                    'topic_title_id' => $subtopic->topic_title_id,
                    'topic_title' => $subtopic->topic_title
                ];
            }
        }

        $data_onview = array('course_title'=>$course_title,'chapert_list' =>$chapert_list);
      
        return View('Front.course_view')->with($data_onview);
    }

    // public function theory(){
    // 	return view("Front.theory");
    // }
    public function theory(){
        $pdfUrl = Storage::url('uploads/Merchant  Dashboard.csv');
        // echo $pdfUrl;die;
        $pdfContent = Storage::url('uploads/Merchant  Dashboard.csv'); // Get the 
        $headers = ['Content-Type' => 'application/pdf']; // Set the response headers
        $pdfResponse = new Response($pdfContent, 200, $headers); // Create the PDF 

        return view("Front.theory", ['pdfResponse' => $pdfResponse]);
        // return view("Front.theory");
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

    public function exam_builder(){
        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        return view("Front.exam_builder")->with($data);
    }

    public function exam_builder_view(){
        return view("Front.exam_builder_view");
    }

    public function user_status(){
        return view("Front.user_status");
    }

    public function settings(){
        $data['user_data'] = Auth::guard('customer')->user();
        return view("Front.settings")->with($data);
    }

}    