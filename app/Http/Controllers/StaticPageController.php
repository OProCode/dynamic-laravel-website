<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class StaticPageController extends Controller
{

    public function home(): View
    {
        return view('static.home');
    }

    public function privacy(): View
    {
        return view('static.privacy');
    }

    public function contact(): View
    {
        return view('static.contact');
    }

    public function welcome(): View
    {
        return view('static.welcome');
    }

}
