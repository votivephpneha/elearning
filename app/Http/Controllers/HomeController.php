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
            $user_save = $user->save();

            if($user_save){
                return redirect()->back()->with('success', 'Registered Successfully.');
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
        $user = User::where('email', '=', $request->email)->first();
        //print_r($user);die;
        //echo Auth::guard("customer")->attempt($user_data);die;
        if(Auth::guard("customer")->attempt($user_data))
        {
            
            return redirect()->route('user_dashboard');
            
        }
        else
        {
            return redirect()->back()->with('error', 'Email or Password is incorrect');
        }
    }

    public function user_dashboard(Request $request){
        return view("Front.user_dashboard");
    }
}
