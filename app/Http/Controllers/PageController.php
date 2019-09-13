<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('app.pages.home.home');
    }
    public function items()
    {
        return view('app.pages.items.items');
    }
    public function records()
    {
        return view('app.pages.records.records');
    }
}
