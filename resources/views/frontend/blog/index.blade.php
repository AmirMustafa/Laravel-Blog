@extends('layouts.master')

@section('title')
		Blog Index
@endsection

@section('styles')				<!-- Added Font Awesome CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section('content')	
	@include('includes.info-box')
									<!-- For showing Data from the post table -->
@foreach($posts as $post)
		<article class="blog-post">
			<h3>{{ $post->title }}</h3> 		<!-- accessing table -->
			<span class="subtitle">	{{ $post->author }} | {{ $post->created_at }}</span>
											<!-- accessing author and timestamp -->
			<p>{{ $post->body }}</p>		<!-- accessing body(i.e message) -->

			<a href="{{ route('blog.single', ['post_id' => $post->id, 'end' => 'frontend']) }}">Read More</a>
		</article>
@endforeach
 
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

@endsection