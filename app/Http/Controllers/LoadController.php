<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Pins;
use App\Models\Votes;
use Illuminate\Support\Facades\Crypt;

class LoadController extends Controller
{
    public function validatePin(array $data){
        return Validator::make($data,[
            'voting_pin' => 'required|exists:pins,pin'
        ],[
            'voting_pin.exists' => 'This Pin is Invalid'
        ]);
    }



    public function submitPin(Request $request){
        try{
            $data = $request->except('_token');
            $validation = $this->validatePin($data);
                if($validation->fails()){
                    return redirect()->back()->withErrors($validation->getMessageBag())->withInput();
                }else{
                    $pin = Pins::where('pin',$data['voting_pin'])->first();

                    if($pin->used == '1'){
                        return redirect()->back()->withErrors(['voting_pin' => 'This Pin has been used already.'])->withInput();
                    }else{
                        $encrypted = Crypt::encryptString($data['voting_pin']);
                        return redirect()->route('vote_page',[$encrypted]);
                    }

                }
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['voting_pin'=>"Oops, An Error occured, Please try it later."]);
        }

    }

    public function validateVotes(array $data){
        return Validator::make($data,[
            'votes.*' => 'required|integer|exists:contestants,id',
        ]);
    }

    public function submitVote(Request $request){
        try{
            $validation = $this->validateVotes($request->except('_token'));

            if($validation->fails()){
                return redirect()->route('index')->withErrors(['voting_pin'=>"Oops, An Error occured, Please try it later."]);
            }else{
                foreach($request['votes'] as $vote){
                    Votes::create(['campaign_id' => $request['campaign'],'contestant_id' => $vote,'pin_id'=>$request['pin']]);
                }
                $pin = Pins::find($request['pin']);
                $pin->used = '1';
                $pin->save();
                return redirect()->route('index')->withErrors(['voting_success'=>"Thanks for Voting, your vote has been casted successfully"]);
            }

        }catch(\Exception $e){
            return redirect()->route('index')->withErrors(['voting_pin'=>"Oops, An Error occured, Please try it later."]);
        }
    }
}
