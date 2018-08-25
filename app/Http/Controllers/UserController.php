<?php 
namespace App\Http\Controllers; 

use App\User; 
use App\Drum; 
use App\Bookmark;  

use DB; 
use Illuminate\Http\Request; 
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller { 

    public function getDashboard() { 
        $drums = Drum::orderBy('created_at', 'desc')->get(); 
        $bookmarks = Bookmark::orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get(); 
        return view('dashboard' , ['drums' => $drums, 'bookmarks' => $bookmarks]); 
    } 
    
    /* 
    public function getDashboard() { 
        // if (Auth::check()) { // user is logged in }  
        return view('dashboard');    
    } */ 

    public function postSignup(Request $request) { 
        
		$this->validate($request, [
            'email' => 'required|email|unique:users', 
            'username' => 'required|min:8|max:16|unique:users', 
			'password' => 'required|min:8|max:32'
		]); 
	    $email = $request['email']; 
        $username = $request['username']; 
        $password = bcrypt($request['password']); 

        $user = new User(); 
        $user->email = $email; 
        /* 
        if ($user->username == "") { 
            $user->username = $email // remove the "@doamin" 
            // if less than 8 characters concatenate a unique-id/random-number 
        } */ 
        $user->username = $username; // tempoary (replace with above when able to)
        $user->password = $password; 
        $user->save(); 
        Auth::login($user); 
        return redirect()->route('dashboard'); 
    } 

    public function postSignin(Request $request) { 
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']]) 
        || Auth::attempt(['username' => $request['email'], 'password' => $request['password']])) { // checks if email is expected email or username 
            return redirect()->route('dashboard'); 
        } 
        return redirect()->back(); 
    } 

    public function getSignout(Request $request) { 
        Auth::logout(); 
        return redirect()->route('drums'); 
    }
} 
