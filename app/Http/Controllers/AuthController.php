<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login() {
        return view('front.account.login');
    }

    public function register() {
        return view('front.account.register');
    }

    public function processRegister(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        if($validator->passes()) {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have been registered successfully.');

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function authenticate(Request $request) {

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->passes()) {

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                return redirect()->route('account.profile');

            } else {
                //session()->flash('error','Either email/password is incorrect.');
                return redirect()->route('account.login')
                ->withInput($request->only('email'))
                ->with('error','Either email/password is incorrect.');
            }

        } else {
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }

    }

    public function profile() {
        $user = User::where('id',Auth::user()->id)->first();

        return view('front.account.profile',[
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request) {

        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'phone' => 'required',
        ]);

        if($validator->passes()) {

            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            session()->flash('success','Profile updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    public function showChangePasswordForm(){
        return view('front.account.change-password');
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($validator->passes()) {

            $user = User::select('id','password')->where('id',Auth::user()->id)->first();

            if(!Hash::check($request->old_password,$user->password)){

                session()->flash('error','Your old password is incorrect, please try again.');

                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            session()->flash('success','You have successfully change your password.');

            return response()->json([
                'status' => true,
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')
        ->with('success','You have successfully logged out!');
    }
}
