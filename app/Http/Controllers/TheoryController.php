<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Courses;
use App\Models\Topics;
use App\Models\Subtopics;
use App\Models\Theory;




use Session;
use DB;

class TheoryController extends Controller
{

    public function __construct(){

        $this->middleware('admin'); // Class admin does not exist

    }

   
    public function theory_list(){
        DB::connection()->enableQueryLog();
        // $theory_list = Theory::orderBy('theory_id','ASC')->get();


        $theory_list = DB::table('theory')
        ->select('theory.*', 'courses.title as course_title', 'topics.title as topic_title','subtopics.title as subtopic_title' )
        ->leftJoin('courses', 'theory.course_id', '=', 'courses.course_id')
        ->leftJoin('topics','theory.topic_id', '=' , 'topics.topic_id')
        ->leftJoin('subtopics','theory.st_id', '=' , 'subtopics.st_id')
        ->whereNull('theory.deleted_at') 
        ->orderBy('theory.theory_id', 'desc')
        ->get();
        $data_onview = array('theory_list' =>$theory_list);

        return View('admin.theory.theory_list')->with($data_onview);

    }

    public function theory_form(Request $request){

        $id = base64_decode($request->id);
         $course_list = DB::table('courses')
                ->whereNull('deleted_at')
                ->get();   
             
    
        $topic_list  = DB::table('topics')
                ->whereNull('deleted_at')
                ->get(); 
        $chapter_list  = DB::table('subtopics')
                ->whereNull('deleted_at')
                ->get();   
        if($id){

        $id = base64_decode($request->id);
        $theory_detail  = DB::table('theory')->where('theory_id', '=' ,$id)->get();


        $data_onview = array('theory_detail' =>$theory_detail,'id'=>$id,'course_list'=>$course_list,'topic_list'=>$topic_list,'chapter_list'=>$chapter_list);       
       
        return View('admin.theory.theory_edit')->with($data_onview);

        }else{

        $id =0;
        $subtopic_list  = DB::table('subtopics')->where('topic_id', '!=' ,$id)->get();
        $data_onview = array('id'=>$id,'course_id'=>$course_list,'course_list'=>$course_list,'topic_list'=>$topic_list);
         
        return View('admin.theory.theory_form')->with($data_onview);

        }
    }

    public function fetch_chapters(Request $request)
    {

        $data['chapters'] = Subtopics::where("topic_id", $request->topic_id)
                                ->get(["st_id","title"]);
        return response()->json($data);
    }


    public function theory_action(Request $request)
    {


        $request->all();
        $id = $request->id;
        // Validate the incoming request...
        $title = $request->input('title');
        // Generate slug from the title
        $slug = Str::slug($title);
        if($id==0){
            $request->validate([
                'theory_pdf' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg',
                 'title' => 'required|unique:theory,title,NULL,id,deleted_at,NULL|max:255'
            ]);
            $fileName = $request->theory_pdf->getClientOriginalName();
            $filePath = 'uploads/' . $fileName;
            $path = Storage::disk('public')->put($filePath, file_get_contents($request->theory_pdf));
            $path = Storage::disk('public')->url($path);
            $slug = Str::slug($title);

            $theory = new Theory;
            $theory->title = trim($request->title);
            $theory->course_id = trim($request->course_id);
            $theory->topic_id = trim($request->topic_id);
            $theory->st_id = trim($request->st_id);
            $theory->slug = $slug;
            $theory->theory_pdf = $fileName;
            $theory->pdf_path = $path ;
            $theory->status = "1";
            $theory->save();
            $theory_id = $theory->theory_id;
            
                  
            Session::flash('message', 'Theory Inserted Sucessfully!');
            return redirect()->to('/admin/theorylist');

        }else
        {
            if ($request->hasFile('theory_pdf')) {
                $request->validate([
                'theory_pdf' => 'required|mimes:pdf,xlxs,xlx,docx,doc,csv,txt,png,gif,jpg,jpeg',
            ]);
                $fileName = $request->theory_pdf->getClientOriginalName();
                $filePath = 'uploads/' . $fileName;
                $path = Storage::disk('public')->put($filePath, file_get_contents($request->theory_pdf));
                $path = Storage::disk('public')->url($path);
        }
        else{
            $theory_detail  = DB::table('theory')->where('theory_id', '=' ,$id)->first();
            $fileName = $theory_detail->theory_pdf;
            $path     = $theory_detail->pdf_path;
        }
         DB::table('theory')
                ->where('theory_id', $id)
                ->update(['title' => trim($request->title),
                    'slug'=>  $slug,
                    'course_id' =>trim($request->course_id),
                    'topic_id' =>trim($request->topic_id),
                    'st_id' =>trim($request->st_id),
                    'theory_pdf'=> $fileName,
                    'pdf_path' => $path

                    ]);

           
            Session::flash('message', 'Theory Updated Sucessfully!');
            return redirect()->to('/admin/theorylist');
        }


    }



    public function theory_delete($id){

        $id = base64_decode($id);

        $theory = Theory::find($id);
        $theory->delete();
        $theory_check = Theory::find($id);
        if (!$theory_check) {
            Session::flash('message', 'Theory Deleted Successfully!');
        } else {
            Session::flash('error', 'theory not found or could not be deleted!');
        }

        return Redirect('/admin/theorylist');
    }

 

    public function fetch_topics(Request $request)
    {
        $data['topics'] = Topics::where("course_id", $request->country_id)
                                ->get(["topic_id","title"]);
        return response()->json($data);
    }


    public function update_order(Request $request)
    {    
        $courses = Courses::all();
    

        foreach ($courses as $course) {

            foreach ($request->order as $order) {

                if ($order['course_id'] == $course->course_id) {

                    $course->update(['ordering_id' => $order['ordering_id']]);
                }
            }
        }

        return response(['message' => 'Update Successfully'], 200);
    }

    public function theory_status(Request $request){

        $result = DB::table('theory')
                ->where('theory_id', $request->theory_id)
                ->update(
                    ['status' => $request->status]
                );
        if ($result) {
                        return response()->json(['success' => true, 'message' => 'Status updated successfully']);} else {
            return response()->json(['success' => false, 'message' => 'Failed to update status']);
        }
    }


}


