<?php

namespace App\Http\Controllers\Admin;
use App\Models\Positions;
use App\Models\Campaign;
use App\Models\Pins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController as MainController;
use Auth;

class PageController extends Controller
{
    public function __construct(MainController $user)
    {
        $this->user = $user;
    }

    public function loginPage(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect()->route('create_campaign_page');
        }else{
            return view('login');
        }

    }

    public function homePage(Request $request){
        $title = "Home";
        return view('admin.home',['title'=>$title]);
    }

    public function createCampaign(Request $request){
        $title = "Create Campaign";
        $campaigns = Campaign::all();
        return view('admin.create_campaign',['title'=>$title,'campaigns'=> $campaigns]);
    }

    public function registerPosition(Request $request){
        $title = "Register Position";
        $positions = Positions::all();
        return view('admin.register_position',['title'=>$title,'positions'=>$positions]);
    }

    public function registerContestant(Request $request){
        $title = "Register Contestants";
        $positions = Positions::all();
        $campaigns = Campaign::all();

        return view('admin.register_contestants',['title'=>$title,'positions'=>$positions,'campaigns' =>$campaigns]);
    }

    public function activeCampaign(Request $request){
        $title = "Active Campaign";
        $active_campaigns = Campaign::where('status','1')->get();
        return view('admin.active',['title'=>$title,'campaigns'=>$active_campaigns]);
    }

    public function votingPage(Request $request,$campaign){
        $title = "Admin Voting";
        $total_pins = Pins::where('campaign_id',$campaign)->count();
        $show = (int)(ceil($total_pins * 0.75));
        $remainder = $total_pins - $show;
        $admin_pins = Pins::where('campaign_id',$campaign)->orderBy('id','asc')->skip($show)->take($remainder)->get();
        $i = 0;
        foreach($admin_pins as $admin_pin){
            if($admin_pin->used == '0'){
                $i++;
            }
        }
        return view('admin.voting',['title'=>$title,'campaign' => $campaign,'positions'=> $this->user->getContestants($campaign),'admin_pin_count'=>$i]);
    }

    public function generatePinsPage(Request $request,$campaign){
        $campaign = Campaign::find($campaign);
        $pins_created_for_campaign = Pins::where('campaign_id',$campaign->id)->count();
        $title = 'Generate Pins for '.$campaign->name;

        return view('admin.generate_pins',['title'=>$title,'campaign'=>$campaign->id,'pins_total' => $pins_created_for_campaign]);
    }

    public function showPins(Request $request,$campaign){
        $show_pins = Pins::where('campaign_id',$campaign)->orderBy('id','asc')->get();

        return view('admin.pins',['pins'=>$show_pins,'title'=>'Shows Pins']);
    }
}
