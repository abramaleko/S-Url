<?php

namespace App\Http\Controllers;

use App\Models\Urls;
use App\Models\ShortURL;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Classes\Builder as urlBuilder;

class UrlController extends Controller
{
    public function __construct()
    {
       return $this->middleware('auth');
    }

    public function index()
    {
      //check if the user has reach the maximum trial of 3 url
      $checkMaximum=Urls::where('user_id',Auth::user()->id)->count();

        return Inertia::render('Url/Index',[
            'app_url' => env('APP_URL'),
            'trialMax' => $checkMaximum >= 3 ? true : false
        ]);
    }

    public function checkAvailabilty(Request $request)
    {
        //check if the url  already exists in the database
        $check=ShortURL::findByKey($request->url);

     return $check;
    }

    public function generateRandomUrl($length)
    {
      //set max length to 15
      $length >= 15 ? $length=15 : $length ;

       $url=$this->generateRandomString($length);

       //returns true if the url key has already been taken
       while (ShortUrl::findByKey($url)) {
           //recreates another url key
          $url=$this->generateRandomString($length);
       }

       return $url;
    }

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function saveUrl(Request $request)
    {
        $this->validate($request,[
        'short_url' => 'required|string',
        'redirect_to' => 'required|url',
        'months' => 'required|integer'
      ]);

      $expiredate=Carbon::now()->addMonth($request->months);

    $urlObject=new urlBuilder();
    $urlObject->destinationUrl($request->redirect_to)
                ->urlKey($request->short_url)
                ->trackVisits( $request->url_type==1 ? false : true) //if url is random disable tracking if it's personalized or single use enable tracking
                ->deactivateAt($expiredate)
                ->setUrlType($request->url_type)
                ->secure()
                ->make();

      return Redirect::route('url-all');

    }

    public function allUrls()
    {
        return Inertia::render('Url/All',[
            'urls' => ShortURL::where('user_id',Auth::user()->id)->orderBy('id','desc')->get()
        ]);
    }

    public function urlDetails(ShortURL $url)
    {
        //getting total count for url visits
        $url->total_visits=number_format($url->visits->count());

        //grouping traffic visits based on devices
        if ($url->total_visits) {
            $grouped_visits = array();

            foreach ($url->visits as $element) {
                $grouped_visits[$element['device_type']][] = $element;
            }
             foreach ($grouped_visits as $key => $visit) {
              $devices_url_count[$key] = count($visit);
             }
             $value=max($grouped_visits); //sorting which has the highest value of the devicess visits
             $url->most_used_device=ucfirst(array_search($value,$grouped_visits));
        }


        return Inertia::render('Url/Details',[
            'url' => $url,
             'app_url' => env('APP_URL')
        ]);
    }

    public function editUrl(ShortURL $url)
    {
        return Inertia::render('Url/Edit',[
            'url' => $url,
            'app_url' => env('APP_URL')
        ]);
    }

    public function updateUrl(ShortURL $url,Request $request)
    {
        $this->validate($request,[
            'short_url' => 'required|string',
          ]);

          $url->url_key= $request->short_url;
          $url->save();

          return Redirect::route('url-details',$url->id)->with('message','Successfully Updated Url');

    }

    public function updateStatus(Request $request)
    {
         $url=Urls::find($request->id);
         $url->status=$request->status;
         $url->save();

         return Redirect::route('url-details',$request->id)->with([
             'url' => $url
         ]);
    }

    public function deleteUrl(ShortURL $url)
    {
       $url->visits ?? $url->visits->delete();
       $url->delete();
       return Redirect::route('url-all');
    }
}
