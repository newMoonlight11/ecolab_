<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendTestEmail (){
        echo 'se enviará un email';
        Mail::to('prueba@prueba.com')->send(new TestMail());
        return 'se ha enviado exitosamente';
    }
}
