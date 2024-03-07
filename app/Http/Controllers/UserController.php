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
use Session;
use DB;
use Auth;

class UserController extends Controller
{

    public function course_view(Request $request){
        $id = base64_decode($request->id);
       $groupedData = DB::table('courses')
                        ->join('topics', 'courses.course_id', '=', 'topics.course_id')
                        ->leftJoin('subtopics', 'topics.topic_id', '=', 'subtopics.topic_id')
                       ->select('topics.topic_id','topics.course_id','topics.title AS topic_title','courses.title AS course_title',DB::raw('GROUP_CONCAT(subtopics.st_id) as chapter_id'),DB::raw('GROUP_CONCAT(topics.topic_id) as topics_id_list'),DB::raw('GROUP_CONCAT(subtopics.title) as subtopics_list'))
                        ->where('topics.course_id', $id)
                        ->groupBy('topics.topic_id', 'topics.course_id', 'topics.title', 'courses.title')
                        ->get();
        $course_title = !empty($groupedData->toArray()) ? $groupedData[0]->course_title : "No Data Found";
        return view('Front.course_view', compact('groupedData','course_title'));
    }

    // public function theory(){
    // 	return view("Front.theory");
    // }
    public function theory(Request $request){
        $id =base64_decode($request->id);
         $queries = DB::table('theory')
        ->where('st_id', '=', $id)
        ->get();
        // print_r($queries);die;
       
        $pdfUrl = Storage::url('uploads/{{$queries->theory_pdf}}');
        // echo $pdfUrl;die;
        $pdfContent = Storage::url('uploads/{{$queries->theory_pdf}}'); // Get the 
        $headers = ['Content-Type' => 'application/pdf']; // Set the response headers
        $pdfResponse = new Response($pdfContent, 200, $headers); // Create the PDF 
        return view("Front.theory", ['pdfResponse' => $pdfResponse]);
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
        DB::table('users')
                ->where('id', $id)
                ->update([
                    'first_name' => trim($request->first_name),
                    'last_name' => trim($request->last_name),
                    'profile_img'=> $imageName,

                ]);
            Session::flash('message', 'Profile Updated Sucessfully!');
            return redirect()->to('/user/user_dashboard');

    }


}    