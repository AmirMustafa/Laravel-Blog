@extends('layouts.admin-master')

@section('styles')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ URL::to('public/src/css/categories.css') }}" type="text/css">
@endsection

@section('content')
	<div class="container">
		<section id="category-admin">
								<!-- This form will have no action as everything will be handeled via ajax -->
			<form action="" method="post">	
				<div class="input-group">
					<label for="name">Category name</label>
					<input type="text" name="name" id="name" />
					<button type="submit" class="btn">Create Category</button>
				</div>
			</form>
		</section>

		<section class="list">
			@foreach($categories as $category)
				<article>
					<div class="category-info" data-id="{{ $category->id }}">
						<h3>{{ $category->name }}</h3>
					</div>
					<div class="edit">
						<nav>
							<ul>				<!-- All the 3 below will be handled through javascript -->
								<li class="category-edit"><input type="text" /></li>
								<li><a href="#">Edit</a></li>
								<li><a href="#" class="danger">Delete</a></li>
							</ul>
						</nav>
					</div>
				</article>
			@endforeach
		</section>

		<!--   ================== Added for the pagination: Start ==================  -->

		@if($categories->lastPage() > 1)	
			<section class="pagination"> 
				<!-- Pagination -->

				@if($categories->currentPage() !== 1)<!-- for other than 1st page, there should be Prev. Button --> 
					<a href="{{ $categories->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
				@endif
												<!-- For case of right button link -->
				@if($categories->currentPage() !== $categories->lastPage())
					<a href="{{ $categories->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
				@endif
			</section>
		@endif

<!--   ================== Added for the pagination: End ==================  -->
	</div>
@endsection

@section('scripts')
	<script type="text/javascript">
		var token = "{{ Session::token() }}";
	</script>

	<script type="text/javascript" src="{{ URL::to('public/src/js/categories.js') }}"></script>
@endsection