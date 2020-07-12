@extends('template.master')

@section('content')
<div class="white-box">
<form method="POST" class="form" action="{{route('register_contestant_action')}}" autocomplete="off">
    <div class="form-row">
          {{csrf_field()}}
          <div class="row">

              <div class="form-group col-md-6 col-xs-12">
                  <label for="">Contestant First-Name</label>
                  <input type="text" class="form-control" name="firstname" placeholder="Enter Contestant First Name" required value="{{old('firstname')}}" >
                  <center class ="error">{{ $errors->first('firstname') }}</center>
              </div>

              <div class="form-group col-md-6 col-xs-12">
                <label for="">Contestant Last-Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Enter Contestant Last Name" required value="{{old('lastname')}}" >
                <center class ="error">{{ $errors->first('lastname') }}</center>
            </div>

            <div class="form-group col-md-6 col-xs-12">
                    <label for="">Contestant Department</label>
                    <input type="text" class="form-control" name="department" placeholder="Enter Contestant Department" required value="{{old('department')}}" >
                    <center class ="error">{{ $errors->first('department') }}</center>
                </div>

            <div class="form-group col-md-6 col-xs-12">
                    <label for="">Select a Position</label>
                    <select name="position" class="form-control" required>
                        <option value="" style="color:red;">Select a Position</option>
                        @foreach ($positions as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                        @endforeach
                    </select>
                    <center class ="error">{{ $errors->first('position') }}</center>
                </div>

                <div class="form-group col-md-6 col-xs-12">
                        <label for="">Select a Campaign</label>
                        <select name="campaign" class="form-control" required>
                            <option value="" style="color:red;">Select a Campaign</option>
                            @foreach ($campaigns as $campaign)
                                <option value="{{$campaign->id}}">{{$campaign->name}}</option>
                            @endforeach
                        </select>
                        <center class ="error">{{ $errors->first('campaign') }}</center>
                    </div>



              <div class="form-group col-md-12 col-xs-12">
                  <button class="btn btn-primary" name="submit" type="submit">Register Position</button>
                       </div>
          </div>    </div>

  </form>
</div>
@endsection
