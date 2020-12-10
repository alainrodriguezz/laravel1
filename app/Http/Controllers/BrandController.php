<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
	//

	public function AllBrand()
	{
		$brands = Brand::latest()->paginate(5);
		return view('admin.brand.index',compact('brands'));
	}

	public function Store(Request $request)
	{
		$validatedData = $request->validate([
			'brand_name' => 'required|unique:brands|min:3',
			'brand_image' => 'required|mimes:jpg,jpeg,png',
		],
		[
			'brand_name.required' => 'Please input brand name',
			'brand_image.required' => 'Please insert brand image',
		]);

		//UPLOAD IMAGE
		$brand_image = $request->file('brand_image');	//gets image form Html Form
		$unique_name = hexdec(uniqid());		//generates a unique name
		$image_extension = strtolower($brand_image->getClientOriginalExtension());	//get file extension
		$image_name = $unique_name.'.'.$image_extension; //12313.jpg
		$upload_location = 'image/brand/';	//upload folder
		$upload_image_url = $upload_location.$image_name;	//full image uploaded url
		$brand_image->move($upload_location,$image_name);	//move image to folder
		//END UPLOAD IMAGE


		$brand = new Brand;
		$brand->brand_name = $request->brand_name;
		$brand->brand_image = $upload_image_url;
		$brand->save();

		return Redirect()->back()->with('success','Brand added successfully');
	}


	public function Edit($id)
	{
		$brand = Brand::find($id); 	//Eloquent

		return view('admin.brand.edit',compact('brand'));
	}

	public function Update(Request $request,$id)
	{
		
		//validate data
		$validatedData = $request->validate([
			'brand_name' => 'required|unique:brands|min:3',
			'brand_image' => 'mimes:jpg,jpeg,png',
		],
		[
			'brand_name.required' => 'Please input brand name',
		]);

		$updateData = array();
		$updateData['brand_name'] = $request->brand_name;

		//If there is a new image, delete the previous one
		if($request->brand_image != null){

			//delete previous image
			$oldImage = $request->old_brand_image;
			unlink($oldImage);
			
			//UPLOAD new IMAGE
			$brand_image = $request->file('brand_image');	//gets image form Html Form
			$unique_name = hexdec(uniqid());		//generates a unique name
			$image_extension = strtolower($brand_image->getClientOriginalExtension());	//get file extension
			$image_name = $unique_name.'.'.$image_extension; //12313.jpg
			$upload_location = 'image/brand/';	//upload folder
			$upload_image_url = $upload_location.$image_name;	//full image uploaded url
			$brand_image->move($upload_location,$image_name);	//move image to folder
			//END UPLOAD new IMAGE

			//insert new image url to update data
			$updateData['brand_image'] = $upload_image_url;
		}

		$brand = Brand::find($id)->update($updateData);	//Eloquent

		return Redirect()->route('brand.all')->with('success','Brand updated successfully');
	}

	public function Delete($id)
	{
		$delete = BRand::find($id)->forceDelete();
		return Redirect()->back()->with('success','Brand deleted');
	}

}
