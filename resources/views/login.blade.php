<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Voting System">
<meta name="author" content="Inim Andrew">
<title>Administrator - Login</title>
<!-- Bootstrap Core CSS -->
<link href="{{url('assets/css/bootstrap.css')}}" rel="stylesheet">
<!-- animation CSS -->
<link href="{{url('assets/css/animate.css')}}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{url('assets/css/style.css')}}" rel="stylesheet">
<!-- color CSS -->
<link href="{{url('assets/css/colors/default.css')}}" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
.logout{
    color:green;
    font-weight: bold;
}
.error{
    color: red;
    font-weight: bold;
}
</style>
</head>
<body>

<section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
              <div class="inner-panel">
                  <div class="lg-content">
                      <h2>ADMINISTRATOR - lOGIN</h2>
                  </div>
              </div>
      </div>
      <div class="new-login-box">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Sign In to Admin</h3>
                    <small>Enter your details below</small>
                  <form class="form-horizontal new-lg-form" autocomplete="off" method="POST" action="{{route('login_action')}}"  >
                    {{ csrf_field() }}
                    <div class="form-group  m-t-20">
                      <div class="col-xs-12">
                        <label>Email Address</label>
                        <input class="form-control" type="email" name="email" required placeholder="Email Address" value="{{old('email')}}">
                        <center class ="error">{{ $errors->first('email') }}</center>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-xs-12">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required placeholder="Password" value="{{old('password')}}">
                        <center class ="error">{{ $errors->first('password') }}</center>
                        <center class ="logout">{{ $errors->first('logout') }}</center>
                      </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                      <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
                      </div>
                    </div>

                  </form>

                </div>
      </div>


</section>
<!-- jQuery -->
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{url('assets/js/sidebar-nav.min.js')}}"></script>

<!--slimscroll JavaScript -->
<script src="{{url('assets/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{url('assets/js/waves.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{url('assets/js/custom.min.js')}}"></script>
</body>
</html>
