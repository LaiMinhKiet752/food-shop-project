<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function PrivacyPolicy()
    {
        return view('frontend.page_privacy_policy');
    } //End Method

    public function About()
    {
        return view('frontend.page_about');
    } //End Method
}
