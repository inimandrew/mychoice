@extends('template.master')

@section('content')

  <div class="col-md-12 white-box ">
      <h3 style="color:black;font-weight:bold;text-transform:uppercase;">Pins</h3>

      @foreach ($pins as $pin)
          <span class="col-md-1" style="color:black;font-weight:bold;">{{$pin->pin}}</span>
          @endforeach
  </div>

@endsection
