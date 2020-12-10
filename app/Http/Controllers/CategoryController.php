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

        //Query Builder
		// $categories = DB::table('categories')
		// 		->join('users','categories.user_id','users.id')
		// 		->select('categories.*','users.name')
		// 		->latest()->paginate(5);

    	//Eloquent
    	   $categories = Category::latest()->paginate(5);

        //Eloquent
    	   $trashedCategories = Category::onlyTrashed()->latest()->paginate(5);

        //Query Builder
    	   //$categories = DB::table('categories')->latest()->paginate(5);	
    	return view('admin.category.index', compact('categories','trashedCategories'));
    }


    public function Add(Request $request)
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

    public function Edit($id)
    {
    	//Eloquent:
    	   $category = Category::find($id); 
    	
    	//Query builder:
    	   //$category = DB::table('categories')->where('id',$id)->first();

    	return view('admin.category.edit',compact('category'));
    }

    public function Update(Request $request,$id)
    {
    	//Eloquent:
        	$category = Category::find($id)->update([
        		'category_name' => $request->category_name,
        		//'user_id' => Auth::user()->id
        	]);

    	// Query Builder
        	// $data = array();
        	// $data['category_name'] = $request->category_name;
        	//$data['user_id'] = Auth::user()->id;
        	// DB::table('categories')->where('id',$id)->update($data);
    	
    	return Redirect()->route('category.all')->with('success','Category updated successfully');
    }

    public function SoftDelete($id)
    {
    	$delete = Category::find($id)->delete();
    	return Redirect()->back()->with('success','Category soft deleted');
    }

    public function PermanentDelete($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category permanently deleted');
    }

    public function Restore($id)
    {
    	$restored = Category::onlyTrashed()->find($id)->restore();
    	return Redirect()->back()->with('success','Category restored');
    }
}
