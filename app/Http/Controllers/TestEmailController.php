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
//        $order = Order::findOrFail($orderId);

        // Ship order...

        Mail::send('emails.reminder', function($message) use ($user) {
            $message->from('phamha.uet@gmail.com', 'Document Mamagement');
            $message->to($user->email)->subject(' This is your account\'s Document Mamagement !');
        });

        Mail::to('chuhue29@gmail.com')->send('balablabal');
//        Mail::to($request->user())->send(new OrderShipped($order));
    }
}
