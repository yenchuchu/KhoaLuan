<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use App\AnswerQuestion;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function ship()
    {

        return view('emails.messages-noti');
//        $data = []; // Empty array
//        Mail::send('emails.welcome', $data, function($message)
//        {
//            $message->to('chuhonghue@gmail.com', 'Jon Doe')->subject('Welcome!');
//        });

    }
}
