<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
use Session;

class NewslettersController extends Controller
{
    public function newsletter() {
        $email = request('email');
        Newsletter::subscribeOrUpdate($email);
        Session::flash('subscribe', 'Successfully Subscribed.');
        return redirect()->back();
    }
}
