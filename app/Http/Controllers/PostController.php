<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Category;



class PostController extends Controller {

	public function getBlogIndex() {
			//Fetch Posts and Paginate

		$posts = Post::paginate(5);

			/*We are here overwriting longer text with the shorten as created below in private function 
			shortenText below: Start*/  

		foreach ($posts as $post) {
			$post->body = $this->shortenText($post->body, 20);	/*First 20 character will be visible*/
		}

			/*We are here overwriting longer text with the shorten as created below in private function 
			shortenText below: End*/

		return view('frontend.blog.index', ['posts' => $posts]);
	}

	public function getPostIndex() {
		$posts = Post::paginate(5);
		return view('admin.blog.index', ['posts' => $posts]);
	}



/*	public function getSinglePost($post_id) {
		//Get Parameter
		//Fetch the Post

		return view('frontend.blog.single'); 
	}*/

	public function getSinglePost($post_id, $end = 'frontend') {
		//Get Parameter 				//This is same as above commented, reason to use as to be 
		//Fetch the Post 				//accessed through Admin Panel as well threfore concatinated

		$post = Post::find($post_id);   //just finding the abive passed function

		if(!$post) {
			return redirect()->route('blog.index')->with(['fail' => "Post not found!"]);
		}

		return view($end. '.blog.single', ['post' => $post]);
	}

	public function getUpdatePost($post_id) {
		$post = Post::find($post_id);
		$categories = Category::all();
		$post_categories = $post->categories;
		$post_categories_ids = array();
		$i=0;

		foreach ($post_categories as $post_category) {
			$post_categories_ids[$i] = $post_category->id;
			$i++;
		}

		if(!$post) {
			return redirect()->route('blog.index')->with(['fail' => "Post not found!"]);
		}

		//Find Categories and pass it to edit

		return view('admin.blog.edit_post', ['post' => $post, 'categories' => $categories, 'post_categories' => $post_categories, 'post_categories_ids' => $post_categories_ids]);
	}

	public function getCreatePost() {
		$categories = Category::all();
		return view('admin.blog.create_post', ['categories' => $categories]);
	}

	public function postCreatePost(Request $request) {
		$this->validate($request, [
			'title' => 'required | max:120 | unique:posts',
			'author' => 'required | max:80 ',
			'body' => 'required'
		]);

		$post = new Post();

		$post->title = $request['title'];
		$post->author = $request['author'];
		$post->body = $request['body'];

		$post->save();			//save received data through form in the database

		//Attaching categories below

		if(strlen($request['categories']) > 0) {   //First we will check if we have any value in 											this i/p field
			$categoryIDs = explode(',', $request['categories']); //seperating values by ,
			foreach ($categoryIDs as $categoryID) {
				$post->categories()->attach($categoryID); // this will create the connection in 											 the DB
			}
		}

		return redirect()->route('admin.index')->with(['success' => 'Post successfully created']);

		 						//redirect to admin dashboard  
	}

	public function postUpdatePost(Request $request) {
		$this->validate($request, [
			'title' => 'required | max:120',
			'author' => 'required | max:80 ',
			'body' => 'required'
		]);

		$post = Post::find($request['post_id']);

		$post->title = $request['title'];
		$post->author = $request['author'];
		$post->body = $request['body'];
		$post->update();

		//Attaching Categories below ...

		$post->categories()->detach();		//if prevously exists categories all will be removed
											//Freshly adding categories like new entry
		if(strlen($request['categories']) > 0) {   //First we will check if we have any value in 											this i/p field
			$categoryIDs = explode(',', $request['categories']); //seperating values by ,
			foreach ($categoryIDs as $categoryID) {
				$post->categories()->attach($categoryID); // this will create the connection in 											 the DB
			}
		}




		return redirect()->route('admin.index')->with(['success' => "Post successfuly updated!"]);
	}

	public function getDeletePost($post_id) {
		$post = Post::find($post_id);

		//echo $post; die;

		if(!$post) {
			return redirect()->route('blog.index')->with(['fail' => "Post not found!"]);
		}

		$post->delete();    //for deleting reqired array of data
		return redirect()->route('admin.index')->with(['success' => 'Post successfully deleted!']);
	}


		/*Have added private function so that this should not be accessible by others*/

		/*So what this function will do shorten longer text to Read More functionality in  Front End*/

	private function shortenText($text, $words_count) {
		if(str_word_count($text, 0) > $words_count) {	/*str_word_count counts no. of words*/
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = substr($text, 0, $pos[$words_count]) . "...";
		}

		return $text;
	}
}
