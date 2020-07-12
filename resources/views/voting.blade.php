<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty of Education Voting Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('voting/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('voting/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('voting/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{url('voting/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{url('voting/css/main.css')}}">
<!--===============================================================================================-->
<style>
.error{
    color:red;
}
option{
    color:black;
    font-weight: bold;
    font-size:1em;
}
.txt1{
    color:green;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-weight: bold;
}
</style>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" autocomplete="off" method="POST" action="{{route('submit_vote')}}">
					<span class="login100-form-title p-b-32" style="font-size:1.5em;font-weight:bold;">
						<center>FACULTY OF EDUCATION VOTING PLATFORM</center>
					</span>
                        {{ csrf_field() }}
                        <input type="hidden" name="campaign" value="{{$campaign}}">
                        <input type="hidden" name="pin" value="{{$pin}}">
                        @foreach ($positions as $position)
                        <span class="txt1 p-b-11">
                            {{$position->name}}
                        </span>
                        <div class="wrap-input100 validate-input m-b-36" data-validate = "Pin is required">
                            <select class="input100" name="votes[]" required >
                                    <option value="">Select a Contestant</option>
                                @foreach ($position->contestants as $contestant)
                                    <option value="{{$contestant->id}}">{{$contestant->firstname}} {{$contestant->lastname}} - {{$contestant->department}}</option>
                                @endforeach
                            </select>
                            <span class="focus-input100"></span>
                            <center class ="error">{{ $errors->first('votes.*') }}</center>
                        </div>
                        @endforeach


					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Submit
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
    <script src="{{url('voting/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('voting/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{url('voting/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{url('voting/js/main.js')}}"></script>

</body>
</html>
