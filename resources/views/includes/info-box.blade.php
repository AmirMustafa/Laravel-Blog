@section('styles')					<!-- This blog will have special style to section -->

		<link rel="stylesheet" href="{{ URL::to('public/src/css/common.css') }}" type="text/css">

@append  <!-- This will inject section contact.blade.php line 7 to 9, so inject there and append whereever required -->


@if(Session::has('fail'))			<!-- This is not validation fail but personal fail message -->

	<section class="info-box fail">
		{{ Session::get('fail') }}
	</section>

@endif

@if(Session::has('success'))				<!-- This is for success message -->

	<section class="info-box success">
		{{ Session::get('success') }}
	</section>

@endif

@if(count($errors) > 0)						<!-- This is for validation error -->

	<section class="info-box fail">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</section>

@endif