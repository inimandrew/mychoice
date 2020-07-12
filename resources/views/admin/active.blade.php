@extends('template.master')
@section('content')
<div class="col-md-12 white-box table-responsive">
    <h3 style="color:black;font-weight:bold;text-transform:uppercase;">Active Campaigns</h3>
    <table class="table" >
        <thead>
            <tr>
            <?php $i = 1;?>
                <th>#</th>
                <th>Name</th>
                <th>Year</th>
                <th>Time of Creation</th>
                <th>Pins Generated</th>
                <th>Pins Used</th>
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
                  <td>{{$campaign->pins()->count()}}</td>
                  <td>{{$campaign->pins()->where('used','1')->count()}}</td>
                  <td><a href="{{route('addy',[$campaign->id])}}" class="btn btn-primary btn-sm btn-outline">Vote</a></td>
              </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
