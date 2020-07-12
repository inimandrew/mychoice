<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{config('app.name')}} Voting Platform</title>
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
.success{
    color:green;
}
</style>
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w" autocomplete="off" method="POST" action="{{route('submit_pin')}}">
                    <span class="login100-form-title p-b-32" style="font-size:1.5em;font-weight:bold;text-align:center;">
                        <img src="{{asset('voting/logo/vector/default-monochrome-black.svg')}}" width="300px" height="100px" alt="Logo">
					</span>
                        {{ csrf_field() }}
					<span class="txt1 p-b-11">
						Enter your Voting Pin
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Pin is required">
						<input class="input100" type="text" name="voting_pin" placeholder="Enter Voting Pin Here" value="{{old('voting_pin')}}">
                        <span class="focus-input100"></span>
                        <center class ="error">{{ $errors->first('voting_pin') }}</center>

                        <center class ="success">{{ $errors->first('voting_success') }}</center>
					</div>

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
