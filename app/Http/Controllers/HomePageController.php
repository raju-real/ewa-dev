<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class HomePageController extends Controller
{
    /**
     * Home page
     * @return string
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Home page
     * @return string
     */
    public function loginPage()
    {
        return view('frontend.login');
    }

    public function userLogin(Request $request) {
        $this->validate($request,[
            'email_mobile' => 'required',
            'password' => 'required',
        ]);
        $credential = [];
        if(is_numeric($request->get('email_mobile'))){
            $credential = ['mobile'=>$request->get('email_mobile'),'password'=>$request->get('password')];
        } elseif (filter_var($request->get('email_mobile'), FILTER_VALIDATE_EMAIL)) {
            $credential =  ['email' => $request->get('email_mobile'), 'password'=>$request->get('password')];
        }

        if (Auth::guard()->attempt($credential,$request->remember)) {
            $user = Auth::user();
            if($user->approve_status == "no") {
                Auth::logout();
                return redirect()->back()->with('message',"Your request is not approve yet. Please contact with our admin.");
            } else {
                Auth::user()->query()->update(array('online_status' => true));
                return redirect()->intended(route('profile'));
            }
        }
        return redirect()->back()
            ->with('message', 'Your entered credentials is incorrect')
            ->withInput($request->only('email', 'remember'));
    }

    public function memberShipForm() {
        return view('frontend.membership_form');
    }

    public function memberRegistration(Request $request) {
        $this->validate($request,[
            'name' => 'required|max:50',
            'mobile' => 'required|max:11|unique:users',
            'email' => 'max:50|unique:users',
            'from_kaunia' => 'required:max:3',
            'complete_graduation' => 'required|max:3',
            'password' => 'required|max:15',
        ]);
        $user = new User();
        $user->member_id = User::getMemberId();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->complete_graduation = $request->complete_graduation;
        $user->from_kaunia = $request->from_kaunia;
        $user->password = Hash::make($request->password);
        $user->save();
        // saveNotification(adminId(),"New Member Request Placed",$user->name." wants be a member.Please take action.",route('member-requests'));
        return redirect()->route('login')->with('message','Thank you for your interest. Our admin will approve your request as soon as possible.');
    }

    public function sendGuestMessage(Request $request) {
        $data = [
            'name'=> $request->name,
            'email'=> $request->email,
            'subject' => $request->subject,
            'body' => $request->message,
        ];
        Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('mkraju.doorsoft@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('info@ewakaunia.com','Virat Gandhi');
        });
        return response()->json(array('status' => true));
    }
}
