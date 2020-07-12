@extends('template.master')

@section('content')
<div class="white-box">
<form method="POST" class="form" action="{{route('register_position_action')}}" autocomplete="off">
    <div class="form-row>">
          {{csrf_field()}}
          <div class="row">

              <div class="form-group col-md-12 col-xs-12">
                  <label for="">Position Name</label>
                  <input type="text" class="form-control" name="position_name" placeholder="Enter Position Name" required value="{{old('position_name')}}" >
                  <center class ="error">{{ $errors->first('position_name') }}</center>
              </div>


              <div class="form-group col-md-12 col-xs-12">
                  <button class="btn btn-primary" name="submit" type="submit">Register Position</button>
                       </div>
          </div>    </div>

  </form>
</div>
<?php $i = 1;?>
  <div class="col-md-6 white-box">
      <h3 style="color:black;font-weight:bold;text-transform:uppercase;">Registered Positions</h3>
      <table class="table" >
          <thead>
              <tr>
                  <th></th>
                  <th>Position Name</th>
              </tr>
          </thead>
          <tbody style="color:black;text-transform:uppercase;">
              @foreach ($positions as $position)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$position->name}}</td>
                </tr>
              @endforeach
          </tbody>
      </table>
  </div>
@endsection
