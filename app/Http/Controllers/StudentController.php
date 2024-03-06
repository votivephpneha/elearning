<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Models\Students;
use Session;
use Hash;
use DB;

class StudentController extends Controller
{

    public function __construct(){

        $this->middleware('admin'); // Class admin does not exist

    }
    public function student_list(){
        DB::connection()->enableQueryLog();

        $student_list = DB::table('users')

        ->select('*')
        
        ->whereNull('users.deleted_at') 

        ->orderBy('id', 'desc')

        ->get();

        $data_onview = array('student_list' =>$student_list);
        return View('admin.students.student_list')->with($data_onview);

    }

    public function student_form(Request $request){

        if($request->id){

        $id = base64_decode($request->id);
        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();
        $student_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $data_onview = array('student_detail' =>$student_detail,'id'=>$id,'student_list'=>$student_list);
        return View('admin.students.student_form')->with($data_onview);

        }else{
        $id = 0;
        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();

        $user_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'user_list'=>$user_list,'student_detail'=>$student_detail);
        return View('admin.students.student_form')->with($data_onview);
        
        }
    }

    public function student_action(Request $request)
    {

        $request->all();
        $id = $request->id;

        if($id==0){

            $this->validate($request,["email" => "required|email|unique:students","password" => "required_with:confirm_pasword|same:confirm_pasword"]);
            $studentemail  = DB::table('students')->where('email', '=' , $request->email)->first();
            if(!empty($studentemail)){
                return redirect()->back()->withErrors(["email" => "The email has already been taken."])->withInput();
            }
            $student = new Students;
            $student->first_name = trim($request->fname);
            $student->last_name = trim($request->lname);
            $student->email = trim($request->email);
            $student->save();
            $student_id = $student->id;
            Session::flash('message', 'Student Inserted Sucessfully!');
            return redirect()->to('/admin/studentlist');

        }else
        {   
            // $studentemail  = DB::table('users')->where('email', '=' , $request->email)->where('id','!=',$id)->first();
            //  if(!empty($studentemail)){
            //     return redirect()->back()->withErrors(["email" => "The email has already been taken."])->withInput();
            // }
             DB::table('users')
                ->where('id', $id)
                ->update(['first_name' => trim($request->fname),

                    'last_name'=>  trim($request->lname)


                ]);
            Session::flash('message', 'Student Information Updated Sucessfully!');
            return redirect()->to('/admin/studentlist');
        }

    }


    public function student_delete($id){

        $id = base64_decode($id);

        $students = Students::find($id);
        $students->delete();

        Session::flash('message', 'Student Information Deleted Sucessfully!');

        return Redirect('/admin/studentlist');
    }

        public function subtopic_delete($id){

        $id = base64_decode($id);
        $topics = Subtopics::find($id);
        $topics->delete();
        Session::flash('message', 'Sub-topic Deleted Sucessfully!');
        return Redirect('/admin/subtopiclist');
    }


    public function student_view(Request $request,$id){

        $id  = base64_decode($id);

        if($id){

        $student_detail  = DB::table('users')->where('id', '=' ,$id)->get();
        $student_list  = DB::table('users')->where('id', '!=' ,$id)->get();
        $data_onview = array('student_detail' =>$student_detail,'id'=>$id,'student_list'=>$student_list);
        return View('admin.students.student_view')->with($data_onview);

        }
    }

    public function student_status(Request $request){

    DB::table('users')
                ->where('id', $request->id)
                ->update(
                    ['status' => $request->status]
                );
        return response()->json(['success' => true]);
    }



}
