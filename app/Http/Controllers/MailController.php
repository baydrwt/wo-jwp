<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReceived;

class MailController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'EMAIL LARAVEL 8',
            'body' => 'Selamat Datang',
        ];

        $tujuan = 'bayu0825.bd@gmail.com';
        Mail::to($tujuan)->send(new OrderReceived($data));
        return 'test';
    }
}
