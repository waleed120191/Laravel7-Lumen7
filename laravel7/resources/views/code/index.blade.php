@extends('template')
@section('content')
<form id='form'>
	@csrf
	  <div class="form-group">
		<input id="quantity" type="number" class="form-control form-control-lg" required>
	  </div>
	  
	  <button type="submit" class="btn btn-primary">SUBMIT</button>
	  
	  <div class="form-group">
		  <label id="basicUsage" class="form-check-label label-timer" for="timer">
			TIMER
		  </label>
	  </div>
</form>

<script>
		
		$(function() {
			$( "#form" ).submit(function( event ) {
				event.preventDefault();
				
				var quantity = $('#quantity').val();
				
				var timer = new easytimer.Timer();
				$('#basicUsage').css("color", "red");
				timer.start({precision: 'secondTenths'});

				timer.addEventListener('secondTenthsUpdated', function (e) {
					$('#basicUsage').html(timer.getTimeValues().toString(['hours', 'minutes', 'seconds', 'secondTenths']));
				});
				

				var request = $.ajax({
				  url: "{{route('codes.store')}}",
				  method: "POST",
				  data: { quantity : quantity },
				  dataType: "json"
				});
				 
				request.done(function( data ) {
					timer.pause();
					if(data.status != 200){
						alert('Something went wrong.');
					}else{
						$('#basicUsage').css("color", "green");
					}
				});
				 
				request.fail(function( jqXHR, textStatus ) {
					timer.pause();
				  alert( "Request failed: " + textStatus );
				});
			});
		});
		
	</script>

@endsection
