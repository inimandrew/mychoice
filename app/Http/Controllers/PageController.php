<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\LoadController as MainController;
use Illuminate\Support\Facades\Crypt;
use App\Models\Pins;
use App\Models\Positions;

class PageController extends Controller
{
    public function __construct(MainController $user)
    {
        $this->user = $user;
    }
    public function landingPage(Request $request){
        return view('index');
    }

    public function votePage(Request $request,$pin){
        $decrypt['voting_pin'] = Crypt::decryptString($pin);
        $validation = $this->user->validatePin($decrypt);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
        }else{
            $pin = Pins::where('pin',$decrypt['voting_pin'])->first();

            if($pin->used == '1'){
                return redirect()->route('index')->withErrors(['voting_pin' => 'This Pin has been used already.'])->withInput();
            }else if($pin->campaign->status == '2'){
                return redirect()->route('index')->withErrors(['voting_pin' => 'Voting has Ended.'])->withInput();
            }else if($pin->campaign->status == '0'){
                return redirect()->route('index')->withErrors(['voting_pin' => 'Voting has been Paused. Check Back in a short while'])->withInput();
            }else{
                $campaign_id = $pin->campaign_id;
                $positions = $this->getContestants($campaign_id);

                return view('voting',['positions'=>$positions,'campaign'=>$campaign_id,'pin' => $pin->id]);
            }
        }

    }

    public function getContestants($campaign){
        $positions = Positions::whereHas('contestants', function($query)use($campaign){
            $query->whereHas('campaign',function($query2) use($campaign){
                $query2->where('id',$campaign);
            });
    })->with('contestants')->get();

    return $positions;
    }


}
