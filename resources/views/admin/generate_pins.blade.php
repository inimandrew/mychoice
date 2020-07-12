@extends('template.master')

@section('content')
<div class="white-box">
<form method="POST" class="form" action="{{route('generate_pins_action')}}" autocomplete="off">
    <h3 style="color:black;font-weight:bold;text-transform:uppercase;">{{$title}} - ({{$pins_total}})</h3>
    <div class="form-row>">
          {{csrf_field()}}
          <div class="row">

              <div class="form-group col-md-12 col-xs-12">
                  <label for="">Total Amount of Pins to be Generated</label>
                  <input type="number" class="form-control" name="pins_amount" placeholder="Enter Total Amount" required >
                  <center class ="error">{{ $errors->first('pins_amount') }}</center>
              </div>
              <input type="hidden" name="campaign" value="{{$campaign}}">

              <div class="form-group col-md-12 col-xs-12">
                  <button class="btn btn-primary" name="submit" type="submit">Generate Pins</button>
                  <a class="btn btn-success" href="{{route('show_pins',[$campaign])}}">View Pins</a>
                       </div>
          </div>    </div>

  </form>
</div>


@endsection
