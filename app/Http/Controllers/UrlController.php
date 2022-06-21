<?php

namespace App\Http\Controllers;

use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Contracts\Service\Attribute\Required;

class UrlController extends Controller
{
    public function __construct()
    {
       return $this->middleware('auth');
    }

    public function index()
    {
        return Inertia::render('Url/Index');
    }

    public function checkAvailabilty(Request $request)
    {
        //check if the url  already exists in the database
      $check=Urls::where('short_url',$request->url)->exists();

     return $check;
    }

    public function saveUrl(Request $request)
    {
      $validatedData=$this->validate($request,[
        'short_url' => 'required|string',
        'redirect_to' => 'required|string'
      ]);

      Urls::create($validatedData);

      return Redirect::route('url-create')->with('message','Url Created Successfully');

    }

    public function allUrls()
    {
        return Inertia::render('Url/All',[
            'urls' => Urls::orderBy('id','desc')->get()
        ]);
    }

    // public function redirectUrl(Urls $url)
    // {
    //     //check if the url has expired
    //     if ($url->expired_on->isPast()) {

    //         //dispatch event for exprired url which will send an email notification
    //         // ExpiredUrl::dispatch($shortUrl->user_id);

    //         return 'Sorry, This url has expired';
    //     }

    //     //check if the url is active
    //     if (! $url->status) {
    //         return 'Sorry, This url has been disabled';
    //     }

    //     // return Redirect::to($shortUrl->redirect_url);

    // }

}
