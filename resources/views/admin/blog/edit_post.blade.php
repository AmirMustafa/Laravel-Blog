@extends('layouts.admin-master')

@section('styles')
	<link rel="stylesheet" href="{{ URL::to('public/src/css/form.css') }}" type="text/css">
@endsection 						<!-- for https you can try URL::secure -->

@section('content')
	<div class="container">
		@include('includes.info-box') <!-- includes as we use in validation purpose -->
									  <!-- info-box holds laravel's vaidation error handeling -->
		<form action="{{ route('admin.blog.post.update') }}" method="post">
			<div class="input-group">
				<label for="title">Title</label>		<!-- ternary operator added for better vaidation -->
				<input type="text" name="title" id="title" {{ $errors->has('title') ? 'class=has-error' : '' }} value="{{ Request::old('title') ? Request::old('title') : isset($post) ? $post->title : '' }}" /> 
								<!-- this value attribute is added if there are some errors in validation, to prevent removal of right input data -->

				

			</div> <!-- end input-group div -->

			<div class="input-group">
				<label for="author">Author</label>       <!-- ternary operator added for better vaidation -->
				<input type="text" name="author" id="author" {{ $errors->has('author') ? 'class=has-error' : '' }}  value="{{ Request::old('author') ? Request::old('author') : isset($post) ? $post->author : '' }}" /> 
								<!-- this value attribute is added if there are some errors in validation, to prevent removal of right input data -->
			</div> <!-- end input-group div -->

			<div class="input-group">
				<label for="category_select">Add Categories</label>
				<select name="category_select" id="category_select">
					
					@foreach($categories as $category)
						<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
				
				<button type="button" class="btn">Add Category</button>

				<div class="added-categories">
					<ul>
						@foreach($post_categories as $post_category)
							<li><a href="" data-id="{{ $post_category->id }}">{{ $post_category->name }}</a></li>
						@endforeach
					</ul>
				</div> <!-- end added-categories -->

				<input type="hidden" name="categories" id="categories" value="{{ implode(',', $post_categories_ids) }}">

			</div> <!-- end input-group div -->

			<div class="input-group">
				<label for="body">Body</label>       <!-- ternary operator added for better vaidation -->
				<textarea name="body" id="body" rows="12" {{ $errors->has('body') ? 'class=has-error' : '' }}  value="hiiii" >{{ Request::old('body') ? Request::old('body') : isset($post) ? $post->body : '' }}</textarea> 

							<!-- this value attribute is added if there are some errors in validation, to prevent removal of right input data -->
			</div> <!-- end input-group -->

			<button type="submit" class="btn">Edit Post</button>

			<input type="hidden" name="_token" value="{{ Session::token() }}" />

			<input type="hidden" name="post_id" value="{{ $post->id }}" />

		
			
        </form>							<!-- this value must be sent in order to receive in edit and update -->
	</div> <!-- end container div -->
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ URL::to('public/src/js/posts.js') }}"></script>
@endsection