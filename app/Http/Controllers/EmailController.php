<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function kirim()
    {
      Mail::to('asep_her@sienrgisukseslogistik.com')->send(new Email);
        //return new Email();
    }
}
