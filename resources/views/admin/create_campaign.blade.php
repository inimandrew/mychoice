@extends('template.master')

@section('content')
<div class="white-box">
<form method="POST" class="form" action="{{route('create_campaign_action')}}" autocomplete="off">
    <div class="form-row>">
          {{csrf_field()}}
          <div class="row">

              <div class="form-group col-md-6 col-xs-12">
                  <label for="">Campaign Name</label>
                  <input type="text" class="form-control" name="campaign_name" placeholder="Enter Campaign Name" required value="{{old('campaign_name')}}" >
                  <center class ="error">{{ $errors->first('campaign_name') }}</center>
              </div>

              <div class="form-group col-md-6 col-xs-12">
                  <label for="">Year</label>
                  <input type="number" maxlength="4" min="2019" class="form-control" name="year" placeholder="Enter Year of Campaign" required value="{{old('year')}}" >
                  <center class ="error">{{ $errors->first('year') }}</center>
              </div>


              <div class="form-group col-md-6 col-xs-12">
                  <button class="btn btn-primary" name="submit" type="submit">Create Campaign</button>
                       </div>
          </div>    </div>

  </form>
</div>


<?php $i = 1;
    function returnStatus($status){

        if($status == '0'){
            $response = ['Inactive','danger'];
        }else if($status == '1'){
            $response = ['Active','warning'];
        }else{
            $response = ['Completed','success'];
        }
        return $response;
    }


?>
  <div class="col-md-12 white-box table-responsive">
      <h3 style="color:black;font-weight:bold;text-transform:uppercase;">Campaigns</h3>
      <table class="table" >
          <thead>
              <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Time of Creation</th>
                  <th>Status</th>
                  <th>Pins Generated</th>
                  <th>Manage</th>
                  <th></th>
              </tr>
          </thead>
          <tbody style="color:black;text-transform:uppercase;">
              @foreach ($campaigns as $campaign)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$campaign->name}}</td>
                    <td>{{$campaign->year}}</td>
                    <td>{{str_replace(' ',' @ ',$campaign->created_at)}}</td>
                    <?php $stat = returnStatus($campaign->status);?>
                    <td><span class="label label-{{$stat['1']}}">{{$stat['0']}}</span></td>
                    <td>{{$campaign->pins()->count()}}</td>
                    <td>
                        @unless($campaign->status == '2')
                        <a href="{{route('generate_pin',[$campaign->id])}}" data-toggle="tooltip" title="Generate Pins for {{$campaign->name}}" class="btn btn-info btn-circle btn-md m-r-5"><i class="ti-pin"></i></a>
                        @unless($campaign->status == '0')
                        <a href="{{route('change_status',[$campaign->id,'0'])}}" data-toggle="tooltip" title="Mark as Inactive" class="btn btn-primary btn-circle btn-md m-r-5"><i class="ti-unlink"></i></a>
                        @endif
                        @unless($campaign->status == '1')
                        <a href="{{route('change_status',[$campaign->id,'1'])}}" data-toggle="tooltip" title="Mark as Active" class="btn btn-warning btn-circle btn-md m-r-5"><i class="ti-unlock"></i></a>
                        @endif
                        @unless($campaign->status == '2')
                        <a href="{{route('change_status',[$campaign->id,'2'])}}" data-toggle="tooltip" title="Mark as Completed" class="btn btn-success btn-circle btn-md m-r-5"><i class="ti-close"></i></a>
                        @endif
                        @endif
                    </td>
                    <td><a href="{{route('show_results',[$campaign->id])}}" class="btn btn-primary btn-sm btn-outline">View Results</a></td>
                </tr>
              @endforeach
          </tbody>
      </table>
  </div>

@endsection
