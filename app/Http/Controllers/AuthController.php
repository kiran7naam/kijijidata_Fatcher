<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerUser(Request $request)
    {        
        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return back()->with('success','Register sucessfully');
    }

    public function login()
    {
        return view('login');
    }

    public function loginUser(Request $request)
    {
        $credentials  = [
            'email'  => $request->email,
            'password'  => $request->password
        ];
       
        if(Auth::attempt($credentials)){
            return redirect('/home')->with('success','Logged in Successfully');
        }
        return back()->with('error','Wrong User name or Password');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function edit_user(Request $request, $id)
    {
        $user = User::find($request->user_id);        
        $user->name  = $request->user_name;
        $user->email = $request->user_email;
        if(isset($request['change_password'])){
            if($request['user_password'] != ''){
                $user->password = Hash::make($request->user_password);
            }            
        }
        $user->save();
        return redirect()->route('view-users')->with('success','User Profile updated sucessfully');
    }

    public function view_users(){

        $users = User::all();
        return view('view-users',['users_data'=>$users])->render();
    }
    public function user_profile(Request $request){
        $id = $request['id'];
        $user_data = User::find($id);
        return view('user-profile',compact('user_data'));

    }
    public function delete_user(Request $request){
        $data = json_decode($request->getContent(),true); 
        $id  = $data['user_id'];
        $user = User::find($id)->delete();

        if($user){
            return response()->json([
                'status' => 'success',
                'message' => 'User has been deleted successfully!'
            ],200);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'There is something wrong with this entry!'
            ],500);
        }

    }


}
