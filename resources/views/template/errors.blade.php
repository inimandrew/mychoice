@foreach($errors->all() as $error)

		@if(Session::has('green'))
		<div class ="alert alert-success alert-dismissable" >
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<center style="color:black;">{{$error}}</center>
		</div>
		@elseif(Session::has('red'))
		<div class ="alert alert-danger alert-dismissable" >
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<center style="color:black;">{{$error}}</center>
		</div>
		@endif
	@endforeach
	<?php Session::forget('red'); Session::forget('green');  ?>
