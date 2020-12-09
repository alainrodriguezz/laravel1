<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {

    	$categories = DB::table('categories')
    					->join('users','categories.user_id','users.id')
    					->select('categories.*','users.name')
    					->latest()->paginate(5);

    	
    	// $categories = Category::latest()->paginate(5);					//Eloquent
    	//$categories = DB::table('categories')->latest()->paginate(5);	//Query Builder
    	return view('admin.category.index', compact('categories'));
    }


    public function AddCat(Request $request)
    {
	  	$validatedData = $request->validate([
	        'category_name' => 'required|unique:categories|max:20',
	    ],
	    [
	    	'category_name.required' => 'Please input category name dude',
	    	'category_name.max' => 'Category name is too long (max 20)',
	    ]);


	    // Category::insert([
	    // 	'category_name' => $request->category_name,
	    // 	'user_id' => Auth::user()->id,
	    // 	'created_at' => Carbon::now(),
	    // ]);


	  	// $data = array();
	   //  $data['category_name'] = $request->category_name;
	   //  $data['user_id'] = Auth::user()->id; 
	   //  DB::table('categories')->insert($data);


	  	//La diferencia entre este y los anteriores, es que este rellena el created_at y updated_at automaticamente
	    $category = new Category;
	    $category->category_name = $request->category_name;
	    $category->user_id = Auth::user()->id;
	    $category->save();


	    return Redirect()->back()->with('success','Category inserted successfully');


    }
}
