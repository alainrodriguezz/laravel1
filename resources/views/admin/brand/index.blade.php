<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			All Brand
			<b style="float:right">
				<span class="badge badge-danger"></span>
			</b>
		</h2>
	</x-slot>

	<div class="py-12">
	   <div class="container">
		   <div class="row">
			   	<div class="col-md-8">
			   		<div class="card">

			   			@if(session('success'))
			   			<div class="alert alert-success alert-dismissible fade show" role="alert">
							  {{ session('success') }}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
					    @endif

			   			<div class="card-header">All Brand</div>
			   			
			   			<div class="card-body pt-0	">
							<table class="table">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Name</th>
								  <th scope="col">Image</th>
								  <th scope="col">Created at</th>
								  <th scope="col">Action</th>
								</tr>
							  </thead>
							  <tbody>

							  	<!-- @php($i=1) -->

							  	@foreach($brands as $brand)

								<tr>
								  <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
								  <td>{{ $brand->brand_name }}</td>
								  <td><img src="{{ asset($brand->brand_image) }}" alt="" width="100"></td>
								  <td>
								  	@if($brand->created_at==NULL)
								  		<span class="text-danger">No date setted</span>
								  	@else
								  		{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
								  	@endif
								  </td>
								  <td width="205">
								  	<a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
								  	<a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger">Delete</a>
								  </td>
								</tr>
								
								@endforeach

							  </tbody>
							</table>


							{{ $brands->links() }}

						</div>
			   		</div>
			   	</div>
			   
			   <div class="col-md-4">
			   		<div class="card">
			   			<div class="card-header">Add Brand</div>

			   			<div class="card-body">
			   				<form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
		   						@csrf 
								  
								  <div class="form-group">
									    <label for="exampleInputEmail1">Brand Name</label>
									    <input name="brand_name" type="text" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" autofocus>

									    @error('brand_name')
									    	<span class="text-danger">{{ $message }}</span>
									    @enderror
								  </div>

								  <div class="form-group">
									    <label for="exampleInputEmail1">Brand Image</label>
									    <input name="brand_image" type="file" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1">

									    @error('brand_image')
									    	<span class="text-danger">{{ $message }}</span>
									    @enderror
								  </div>
							 
							  <button type="submit" class="btn btn-primary">Add Brand</button>
							</form>
						</div>
		   				
			   		</div>
			   </div>

		   </div>
	   </div>





	</div>
</x-app-layout>
