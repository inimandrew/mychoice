@extends('template.master')
@section('content')
<div class="white-box col-md-12" style="text-align:center;font-size:2em;text-transform:uppercase;font-weight:bold;">
        <span>{{$title}}</span>
</div>
<div class="white-box col-md-12" style="text-align:center;font-size:2em;text-transform:uppercase;font-weight:bold;">
        <span>Total Votes: {{$total_votes}}</span>
</div>
@foreach ($positions as $position)

<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-inverse">
        <div class="panel-heading" style="text-align:center;text-transform:uppercase;font-weight:bold;">{{$position->name}}</div>
        <div class="panel-wrapper collapse in">
            <table class="table table-borderless table-hover">

                <tbody>
                        @foreach ($position->contestants as $contestant)
                    <tr style="color:black;font-weight:bold;">
                        <td>{{$contestant->firstname}}</td>
                        <td>{{$contestant->lastname}}</td>
                        <td>{{$contestant->department}}</td>
                        <td>{{$contestant->votes->count()}}</td>
                    </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endforeach

@endsection
