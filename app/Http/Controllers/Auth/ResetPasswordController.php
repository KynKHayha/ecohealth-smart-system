<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    | Controller ini menangani proses penggantian password lama ke yang baru.
    */

    use ResetsPasswords;

    // Setelah berhasil ganti password, arahkan kembali ke login
    protected $redirectTo = '/login';
}