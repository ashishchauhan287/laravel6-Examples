<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function role()
    {
    	    if (\Gate::allows('isAdmin')) {
        echo 'Admin user role is allowed';
    } else {
        echo 'Admin are not allowed not allowed';
    }
    }

    public function mail()
{
    $user = User::find(1)->toArray();

  //  print_r($user); exit;
    $mail = "asish1073@gmail.com";
    Mail::send('emails.mailEvent', $user, function($message) use ($mail)  {
        $message->to($mail);
        $message->subject('Send Mail From Sendgrid');
    });
    dd('Mail Send Successfully');
}
}
