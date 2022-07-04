<?php

namespace App\Http\Controllers;

use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class UrlRedirectController extends Controller
{
    //

    public function namedRedirectUrl(Urls $urls)
    {
       //check if the url has expired
       if (! $this->checkExpiriy($urls->expires_on)) {
          return 'Sorry this url has expired' ;
       }

       //check if the url is active
       if(! $this->checkStatus($urls->status) ){
          return 'Sorry this url has been disabled';
       }

    //    return Redirect::to($urls->redirect_to);

          return view('redirect')->with('url',$urls->redirect_to);


    }

    protected function checkExpiriy($date)
    {
        if ($date->isPast()) {
            //dispatch event for exprired url which will send an email notification
            // ExpiredUrl::dispatch($shortUrl->user_id);
            return false;
        }
        return true;
    }

    protected function checkStatus($status)
    {
        if (! $status) {
            return false;
        }
        return true;
    }
}


// public function redirectUrl(shortUrl $shortUrl)
// {
//     //check if the url has expired
//     if ($shortUrl->expired_on->isPast()) {

//         //dispatch event for exprired url which will send an email notification
//         ExpiredUrl::dispatch($shortUrl->user_id);

//         return 'Sorry, This url has expired';
//     }

//     //check if the url is active
//     if (! $shortUrl->status) {
//         return 'Sorry, This url has been disabled';
//     }

//     return Redirect::to($shortUrl->redirect_url);

// }
