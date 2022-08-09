<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ShortURL;
use Illuminate\Support\Facades\Auth;



class StatsController extends Controller
{
    //

    public function __construct()
    {
       return $this->middleware('auth');
    }

    public function statsList()
    {
        return Inertia::render('Url/Statisitcs/UrlList',[
            'urls' => ShortURL::with('visits')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get()
        ]);
    }
}
