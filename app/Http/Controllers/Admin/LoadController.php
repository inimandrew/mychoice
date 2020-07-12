<?php

namespace App\Http\Controllers\Admin;
use Validator;
use Illuminate\Support\Str;
use Auth;
use App\Models\Campaign;
use App\Models\Positions;
use App\Models\Contestants;
use App\Models\Pins;
use App\Models\Votes;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController as PageController;
use Illuminate\Http\Request;

class LoadController extends Controller
{


    public function __construct(PageController $election_campaign)
    {
        $this->election_campaign = $election_campaign;
    }
    public function validateLogin(array $data){
        return Validator::make($data,[
            'email' => 'required|email|exists:admins,email',
            'password' => 'required'
        ]);
    }

    public function authenticate(Request $request){
        $data = $request->except('_token');
        $validation = $this->validateLogin($data);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
        }else{
            if (Auth::guard('admin')->attempt(['email' => $request['email'],'password' => $request['password']]  , 1)){
                Session::put('green',1);
                return redirect()->route('create_campaign_page')->withErrors('You have been Successfully Logged in');
            }else{
                return redirect()->back()->withErrors(['password' => 'Password is incorrect'])->withInput();
            }
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->withErrors(['logout'=>"You've been logged out successfully"]);
    }

    public function validateCampaign(array $data){
        return Validator::make($data,[
            'campaign_name' => 'required|string',
            'year' => 'required|digits:4',
        ]);
    }

    public function createCampaign(Request $request){
        try{
            $data = $request->except('_token');
            $validation = $this->validateCampaign($data);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{
               $success = Campaign::create(['name' => ucwords(strtolower($data['campaign_name'])),'year' => $data['year']]);
               if($success){
                Session::put('green',1);
                return redirect()->back()->withErrors(["Campaign has been created Successfully."]);
               }
            }
        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }

    }

    public function validatePosition(array $data){
        return Validator::make($data,[
            'position_name' => 'required|string',
        ]);
    }

    public function registerPosition(Request $request){
        try{
            $data = $request->except('_token');
            $validation = $this->validatePosition($data);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{
               $success = Positions::create(['name' => ucwords(strtolower($data['position_name']))]);
               if($success){
                Session::put('green',1);
                return redirect()->back()->withErrors(["Position has been registered Successfully."]);
               }
            }
        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }

    }

    public function validateContestant(array $data){
        return Validator::make($data,[
            'firstname' => 'required|alpha|max:20',
            'lastname' => 'required|alpha|max:20',
            'department' => 'required|string',
            'position' => 'required|integer',
            'campaign' => 'required|integer',
        ]);
    }

    public function registerContestant(Request $request){
        try{
            $data = $request->except('_token');
            $validation = $this->validateContestant($data);

            if($validation->fails()){
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{
               $success = Contestants::create(['firstname' => ucfirst(strtolower($data['firstname'])), 'lastname' => ucfirst(strtolower($request['lastname'])), 'department' => ucwords(strtolower($request['department'])),
               'position_id' => $request['position'],'campaign_id' => $request['campaign'] ]);
               if($success){
                Session::put('green',1);
                return redirect()->back()->withErrors(["Contestant has been registered Successfully."]);
               }
            }
        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }

    }

    public function validateTotal(array $data){
        return Validator::make($data,[
            'pins_amount' => 'required|integer|max:500',
            'campaign' => 'required|exists:campaigns,id'
        ]);
    }

    public function validatePin(array $data){
        return Validator::make($data,[
            'pin' => 'required|unique:pins,pin',

        ]);
    }

    public function generatePins(Request $request){
        try{
            $validation = $this->validateTotal($request->except('_token'));

            if($validation->fails()){
                Session::put('red',1);
                return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
            }else{
                $pin_success = 0;
            for($i = 0; $i < $request['pins_amount'];$i++){

                $random_pin['pin'] = strtoupper(Str::random(8));
                $pin_validation = $this->validatePin($random_pin);

                    if($pin_validation->fails()){
                        continue;
                    }else{
                        $pin_create = Pins::create(['pin' => $random_pin['pin'],'campaign_id' => $request['campaign']]);
                            if($pin_create){
                                $pin_success = $pin_success + 1;
                            }
                    }
            }
            Session::put('green',1);
            return redirect()->back()->withErrors([$pin_success.' pins has been created successfully']);
        }

        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }

    }

    public function changeStatus(Request $request,$campaign,$status){
        try{
            $campaign_to_use = Campaign::find($campaign);
            $campaign_to_use->status = $status;
            $campaign_to_use->save();
            Session::put('green',1);
            return redirect()->back()->withErrors(["Campaign Status has been changed Successfully."]);
        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }

    }

    public function showResults(Request $request,$campaign_id){
        $camp = Campaign::find($campaign_id);
        $positions = $this->election_campaign->getContestants($campaign_id);
        $votes = Votes::where('campaign_id',$campaign_id)->get();
        $unique_votes_count = $votes->unique('pin_id')->count();
        return view('admin.results',['title'=>"Results for ".$camp->name,'positions'=>$positions,'total_votes' => $unique_votes_count,'campaign'=>$campaign_id]);
    }

    public function vote(Request $request){
        try{
        $total_pins = Pins::where('campaign_id',$request['campaign'])->count();
        $show = (int)(ceil($total_pins * 0.75));
        $remainder = $total_pins - $show;
        $admin_pins = Pins::where('campaign_id',$request['campaign'])->orderBy('id','asc')->skip($show)->take($remainder)->get();

        $to_use_pins = array();
        $i = 0;
        foreach($admin_pins as $admin_pin){
            if($admin_pin->used == '0'){
                $to_use_pins[$i] = $admin_pin->id;
                $i++;
            }
        }
        $final_pins = array_slice($to_use_pins,0,$request['amount']);

        foreach($final_pins as $pin_id){
            foreach($request['votes'] as $vote){
                Votes::create(['campaign_id' => $request['campaign'],'contestant_id' => $vote,'pin_id'=>$pin_id]);
            }
            $pin = Pins::find($pin_id);
            $pin->used = '1';
            $pin->save();
        }

        Session::put('green',1);
            return redirect()->back()->withErrors([$request['amount']." Votes has been casted."]);

        }catch(\Exception $e){
            Session::put('red',1);
            return redirect()->back()->withErrors(["Oops, An Error occured, Please try it later."]);
        }
}

}
