

@extends('layouts.admin-master')

@section('styles')
<!-- <link rel="stylesheet" href="{{ URL::secure('public/src/css/modal.css') }}" type="text/css"> -->

<link rel="stylesheet" href="{{ URL::to('public/src/css/modal.css') }}" type="text/css">

@endsection		<!-- Note: URL::secure handles URL::to (better when SSL Certificate is used) -->

@section('content')
	<div class="container">
		@include('includes.info-box')

	<!-- ======================== Card 1 for Showing Message: Start ======================== -->

		<div class="card">
			<header>
				<nav>
					<ul>
						<li><a href="{{ route('admin.blog.create_post') }}" class="btn">New Posts</a></li>
						<li><a href="{{ route('admin.blog.index') }}" class="btn">Show all Posts</a></li>
					</ul>
				</nav>
			</header>

			<section>
				<ul>
					@if(count($posts) == 0)
												<!-- if there is no posts -->
						<li>No Posts</li>
					@else

											    <!-- else if posts is present -->

						@foreach($posts as $post)
							
							<li>
								<article>
									<div class="post-info">
										<h3>{{ $post->title }}</h3>
										<span class="info">{{ $post->author }} | {{ $post->created_at }}</span>
									</div>

									<div class="edit">
										<nav>
											<ul>
												<li><a href="{{ route('admin.blog.post', ['post_id' => $post->id, 'end' => 'admin']) }}">View Post</a></li>
												<li><a href="{{ route('admin.blog.post.edit', ['post_id' => $post->id]) }}">Edit</a></li>
												<li><a href="{{ route('admin.blog.post.delete',['post_id' => $post->id] ) }}" class="danger">Delete</a></li>
											</ul>
										</nav>
									</div>
								</article>
							</li>							

						@endforeach



					@endif




				</ul>
			</section>
		</div>
    <!-- ======================== Card 1 for Showing Message: End ========================= -->

	<!-- ======================== Card 2 for Showing Message: Start ======================== --> 

		<div class="card">
			<header>
				<nav>
					<ul>
						<li><a href="" class="btn">Show all Messages</a></li>
					</ul>
				</nav>
			</header>

			<section>
				<ul>
					<!-- If no Messages -->
					@if(count($contact_messages) == 0)
						<li>No Message</li>
					@endif

					

					<!-- If Messages are present -->
					@foreach($contact_messages as $contact_message)
						<li>			<!-- data-message is used for popup for the modal -->
							<article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
								<div class="message-info">
									<h3>{{ $contact_message->subject }}</h3>
									<span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
								</div>

								<div class="edit">
									<nav>
										<ul>
											<li><a href="">View</a></li>
											<li><a href="" class="danger">Delete</a></li>
										</ul>
									</nav>
								</div>
							</article>
						</li>	
					@endforeach

					
				</ul>
			</section>
		</div>

	<!-- ======================== Card 2 for Showing Message: End ======================== -->
	</div>

	 <!-- ========== Now here we have to write the Pop Up of the Modal :Start ==========  --> 

	 <div class="modal" id="contact-message-info">
	 	<button class="btn" id="modal-close">Close</button>
	 </div>
	 <!-- ========== Now here we have to write the Pop Up of the Modal :End ==========  --> 


@endsection
				<!-- Here we will write or link all possible scripts related with this page -->
@section('scripts')

	<script type="text/javascript">
		var token = "{{ Session::token() }}";
	</script>
													<!-- modal.js should be added first -->
	<script type="text/javascript" src="{{ URL::to('public/src/js/modal.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('public/src/js/contact_messages.js') }}"></script>

	
@endsection