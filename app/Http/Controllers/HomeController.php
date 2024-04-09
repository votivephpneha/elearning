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
use Illuminate\Support\Str;
use Mail;

class HomeController extends Controller
{
    public function index(){
    	return view("Front.login");
    }

    public function register(){
    	return view("Front.register");
    }

    public function submit_registration(Request $request){
    	$name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $c_password = $request->c_password;

        $checkUserEmail = DB::table("users")->where("email",$email)->first();
        //print_r($checkUserEmail);die;
        if(empty($checkUserEmail)){
            $user = new User();

            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->role = "student";
            $user->status = "1";
            $user_save = $user->save();

            if($user_save){
                $user_data = array(
                  'email'  => $request->get('email'),
                  'password' => $request->get('password')
                );
                $data = array('name'=>"xxxx");
                Mail::send("Front.registration_email", $data, function($message) {
                     $message->to('votivephp.neha@gmail.com', 'Tutorials Point')->subject
                        ('Laravel Basic Testing Mail');
                     $message->from('votivephp.neha@gmail.com','xxx');
               });
                if(Auth::guard("customer")->attempt($user_data))
                {
                    
                    return redirect()->route('user_dashboard');
                    
                }
                //return redirect()->back()->with('success', 'Registered Successfully.');
            }else{
                return redirect()->back()->with('error', 'Server error');
            }
        }else{
            return redirect()->back()->with('error', 'Email already exist');
        }
    }

    public function submit_login(Request $request){
        $user_data = array(
          'email'  => $request->get('email'),
          'password' => $request->get('password')
        );
        $user = User::where('email', '=', $request->email)->where("role","student")->first();
        //print_r($user);die;
        //echo Auth::guard("customer")->attempt($user_data);die;
        if(Auth::guard("customer")->attempt($user_data) and $user->status == 1 and $user->deleted_at == NULL and !empty($user_data))
        {
            //echo Auth::guard("customer")->user()->name;
            return redirect()->route('user_dashboard');
            
        }
        else
        {
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }

    public function user_dashboard(Request $request){
        $data['course_data'] = DB::table("courses")->orderBy('ordering_id', 'ASC')->get();
        return view("Front.user_dashboard")->with($data);
    }

    public function change_password(){
        return view("Front.change_password");
        
    }

    public function postuser_ChangePassword(Request $request)
    {
        $auth = Auth::user();
        if (!Hash::check($request->get('old_password'), $auth->password)) 
        {
            session::flash('password_error', 'Current password is invalid');
            return redirect()->route('user_ChangePassword');
        }else{
            $user_id = Auth::User()->id;
            $user = User::find($user_id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            session::flash('password_success', 'Password updated successfully');
            return redirect()->route('user_ChangePassword');
        }
    }

    public function user_logout(){
        Auth::guard("customer")->logout();
        return redirect()->route('login');
    }
}
