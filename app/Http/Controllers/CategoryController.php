<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;

use Illuminate\Support\Facades\Response;      //This facade is used for handeling AJAX Response


class CategoryController extends Controller {

	public function getCategoryIndex() {
			$categories = Category::orderBy('created_at', 'desc')->paginate(5);
            return view('admin.blog.categories', ['categories' => $categories]);
	}

	public function postCreateCategory(Request $request) {	//This will be received from ajax(categories.js)
						//this validate will figure out on its own whether it is a form req. or ajax req.
		$this->validate($request, [
			'name' => 'required | unique:categories'
		]);

		$category = new Category();	
		$category->name = $request['name'];			//received this name from ajax in categories.js and not through form's input type name

		if($category->save()) {
			return Response::json(['message' => 'Category created.'], 200);
		}

		return Response::json(['message' => 'Error during creation'], 404);
	}

	public function postUpdateCategory(Request $request) {
		//console.log($request);
		$this->validate($request, [
			'name' => 'required | unique:categories'
		]);

		$category = Category::find($request['category_id']);

		if(!$category) {
			return Response::json(['message' => 'Category not found'], 404);
		}

		$category->name = $request['name'];
		$category->update();
		return Response::json(['message' => 'Category updated.', 'new_name' => $request['name']], 200);
	}

	public function getDeleteCategory($category_id) {
		$category = Category::find($category_id);		//finding the passed id
		$category->delete();							// deleting query
		return Response::json(['message' => 'Category deleted.'], 200);
	}
}
