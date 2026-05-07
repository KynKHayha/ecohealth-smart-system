<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    | Controller ini menangani pengiriman link reset password ke email user.
    */

    use SendsPasswordResetEmails;
}