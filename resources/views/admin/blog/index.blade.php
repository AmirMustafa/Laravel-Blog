@extends('layouts.admin-master')

@section('styles')
<!-- <link rel="stylesheet" href="{{ URL::secure('public/src/css/modal.css') }}" type="text/css"> -->

<link rel="stylesheet" href="{{ URL::to('public/src/css/modal.css') }}" type="text/css">

@endsection		<!-- Note: URL::secure handles URL::to (better when SSL Certificate is used) -->

@section('content')

	<div class="container">
		@include('includes.info-box')

		<section id="post-admin"> 
			<a href="{{ route('admin.blog.create_post') }}" class="btn">New Post</a>
		</section>
			<section class="list">
				
					@if(count($posts) == 0)
												<!-- if there is no posts -->
						No Posts
					@else

											    <!-- else if posts is present -->

						@foreach($posts as $post)
							
							
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
													

						@endforeach



					@endif




				
			</section>

<!--   ================== Added for the pagination: Start ==================  -->

		@if($posts->lastPage() > 1)	
			<section class="pagination"> 
				<!-- Pagination -->

				@if($posts->currentPage() !== 1)<!-- for other than 1st page, there should be Prev. Button --> 
					<a href="{{ $posts->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
				@endif
												<!-- For case of right button link -->
				@if($posts->currentPage() !== $posts->lastPage())
					<a href="{{ $posts->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
				@endif
			</section>
		@endif

<!--   ================== Added for the pagination: End ==================  -->
	</div>

@endsection