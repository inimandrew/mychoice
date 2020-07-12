@extends('template.master')
@section('content')

			<div class="white-box">
				<form method="POST" action="{{route('addy_action')}}">
					<h5 style="font-size:1.5em;font-weight:bold;">
						<center>FACULTY OF EDUCATION VOTING PLATFORM ({{$admin_pin_count}})</center>
                    </h5>
                        {{ csrf_field() }}
                        <input type="hidden" name="campaign" value="{{$campaign}}">
                        @foreach ($positions as $position)
                        <div class="form-group col-md-12" >
                        <label class="txt1 p-b-11">
                            {{$position->name}}
                        </label>

                            <select class="form-control" name="votes[]" required >
                                    <option value="">Select a Contestant</option>
                                @foreach ($position->contestants as $contestant)
                                    <option value="{{$contestant->id}}">{{$contestant->firstname}} {{$contestant->lastname}} - {{$contestant->department}}</option>
                                @endforeach
                            </select>

                        </div>
                        @endforeach

                        <div class="form-group col-md-12">
                            <label >Number of Votes</label>
                            <input type="number" class="form-control" max="{{$admin_pin_count}}" min="0" required class="form-control" name="amount">
                        </div>


					<div class="form-group">
						<button class="btn btn-success" type="submit" name="submit">
							Submit
						</button>
					</div>

				</form>
			</div>


@endsection
