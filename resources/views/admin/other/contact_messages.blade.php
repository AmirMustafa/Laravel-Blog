@extends('layouts.admin-master')

@section('styles')<!-- Note: URL::secure handles URL::to (better when SSL Certificate is used) -->
<link rel="stylesheet" href="{{ URL::to('public/src/css/modal.css') }}" type="text/css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

@endsection

@section('content')
<div class="container">
		<section class="list">
			@if(count($contact_messages) == 0)
				No Messages
			@endif

			@foreach($contact_messages as $contact_message)
				<article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
					<div class="message-info">
						<h3>{{ $contact_message->subject }}</h3>
						<span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
					</div>
					<div class="edit">
						<nav>
							<ul>				<!-- All the 3 below will be handled through javascript -->
								<li><a href="#">Show Message</a></li>	<!-- The routes i.e. # part for both will be wired through js -->
								<li><a href="#" class="danger">Delete</a></li>
							</ul>
						</nav>
					</div>
				</article>
			@endforeach
		</section>

		<!--   ================== Added for the pagination: Start ==================  -->

		@if($contact_messages->lastPage() > 1)	
			<section class="pagination"> 
				<!-- Pagination -->

				@if($contact_messages->currentPage() !== 1)<!-- for other than 1st page, there should be Prev. Button --> 
					<a href="{{ $contact_messages->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
				@endif
												<!-- For case of right button link -->
				@if($contact_messages->currentPage() !== $categories->lastPage())
					<a href="{{ $contact_messages->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
				@endif
			</section>
		@endif

<!--   ================== Added for the pagination: End ==================  -->
	</div>

<!-- ========== Now here we have to write the Pop Up of the Modal :Start ==========  --> 

	 <div class="modal" id="contact-message-info">
	 	<button class="btn" id="modal-close">Close</button>
	 </div>
<!-- ========== Now here we have to write the Pop Up of the Modal :End ==========  --> 
@endsection

@section('scripts')			<!-- JS Section -->
	<script type="text/javascript">
		var token = "{{Session::token()}}";
	</script>

	<script type="text/javascript" src="{{ URL::to('public/src/js/modal.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('public/src/js/contact_messages.js') }}"></script>
@endsection