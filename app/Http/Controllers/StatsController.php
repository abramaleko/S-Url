<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\ShortURL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use DB;
use AshAllenDesign\ShortURL\Models\ShortURLVisit;


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

    public function statsInfo(ShortURL $url )
    {
        //if the url is a personalized url
        if ($url->url_type != 2) {
            abort(404,'This url does not have access to this page');
        }

        $stats=array();

        $stats['total_visits']=$this->getTotalVisits($url->visits);

        $grouped_visits_per_day=$this->getGroupedVisits($url);


        $stats['average_clicks']= round($stats['total_visits'] / 7);  //get average click per day

        $stats['clicksHistory']=$this->getClicksHistory($grouped_visits_per_day);

         //checking if the url has any visits then grouping traffic visits based on devices
         $grouped_visits = array();
        if ($url->visits) {
            foreach ($url->visits as $element) {
                $grouped_visits[$element['device_type']][] = $element;
            }
             foreach ($grouped_visits as $key => $visit) {
              $devices_url_count[$key] = count($visit);
             }
             if ($grouped_visits) {
                $value=max($grouped_visits); //sorting which has the highest value of the devicess visits
                $stats['most_used_device']=ucfirst(array_search($value,$grouped_visits));
             }
             else {
                $stats['most_used_device']='NIL';
             }
        }
         $stats['most_used_chart']=$this->getGroupedDeviceVisits($grouped_visits); //data for the pie-chart
         $stats['most_used_browser']=$this->getMostUsedBrowser($url->id,$url->visits);
         $stats['refer_urls']=$this->getMostReferUrl($url->id);
         $stats['ipLocations'] = $this->getIpLocations($url->id);

        return Inertia::render('Url/Statisitcs/UrlInfo',[
            'stats' => $stats,
        ]);
    }


    //returns the number of visits made to a url
    public function getTotalVisits($visits)
    {
          return number_format($visits->count());
    }

    //groups visits by dates and get clicks in each day
    public function getGroupedVisits($url)
    {
        return ShortURLVisit::where('short_url_id',$url->id)
                        -> where('visited_at', '>=', \Carbon\Carbon::now()->subMonth())
                        ->groupBy('date')
                        ->orderBy('date', 'DESC')
                        ->get(array(
                            DB::raw('Date(visited_at) as date'),
                            DB::raw('COUNT(*) as "clicks"')
                        ));
    }

    public function getClicksHistory($clickHistory){

       $clickHistory=$clickHistory->take(7);
       $dataset=[];
       $dataset['labels']=[];
       $dataset['clicks']=[];

       foreach ($clickHistory as $data) {
              array_push($dataset['labels'],\Carbon\Carbon::parse($data['date'])->isoFormat('dddd D'));
              array_push($dataset['clicks'],$data['clicks']);
            }

       return $dataset;

    }

    public function getGroupedDeviceVisits($groupedData)
    {
        $dataset=[];
        $dataset['labels']=[];
        $dataset['device_count']=[];

        foreach ($groupedData as $key => $data) {
            array_push($dataset['labels'],$key);
            array_push($dataset['device_count'],count($data));
        }

        return $dataset;
    }

    public function getMostUsedBrowser($id,$visits){
        $dataset=[];
        if (! $visits->isEmpty()) {
            $browserVisits=ShortURLVisit::where('short_url_id',$id)
            ->select('browser', DB::raw('count(*) as total'))
            ->groupBy('browser')
            ->get();

            $osVisits=ShortURLVisit::where('short_url_id',$id)
            ->select('operating_system', DB::raw('count(*) as os_visits'))
            ->groupBy('operating_system')
            ->get();

            $dataset['browser']=$browserVisits->first()->browser;
            $dataset['os']=$osVisits->first()->operating_system;

            return $dataset;
        }
        else
        return 'NIL';
    }

    public function getMostReferUrl($url_id)
    {
        $refer_urls=ShortURLVisit::where('short_url_id',$url_id)
        ->select('referer_url', DB::raw('count(*) as total'))
        ->groupBy('referer_url')
        ->get()
        ->take(5);

        return $refer_urls;
    }

    public function getIpLocations($url_id)
    {
        $ip_address=ShortURLVisit::where('short_url_id',$url_id)
        ->select('ip_address', DB::raw('count(*) as total'))
        ->groupBy('ip_address')
        ->get();
    }



}
