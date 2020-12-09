<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			All Category
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

			   			<div class="card-header">All Category</div>
			   			
			   			<div class="card-body">
							<table class="table">
							  <thead>
								<tr>
								  <th scope="col">#</th>
								  <th scope="col">Category name</th>
								  <th scope="col">User name</th>
								  <th scope="col">Created at</th>
								</tr>
							  </thead>
							  <tbody>

							  	<!-- @php($i=1) -->

							  	@foreach($categories as $category)

								<tr>
								  <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
								  <td>{{ $category->category_name }}</td>
								  <td>{{ $category->name }}</td>
								  <td>
								  	@if($category->created_at==NULL)
								  		<span class="text-danger">No date setted</span>
								  	@else
								  		{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
								  	@endif
								  </td>
								</tr>
								
								@endforeach

							  </tbody>
							</table>


							{{ $categories->links() }}

						</div>
			   		</div>
			   	</div>
			   
			   <div class="col-md-4">
			   		<div class="card">
			   			<div class="card-header">Add Category</div>

			   			<div class="card-body">
			   				<form action="{{ route('store.category') }}" method="POST">
		   						@csrf 
								  <div class="form-group">
									    <label for="exampleInputEmail1">Category Name</label>
									    <input name="category_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

									    @error('category_name')
									    	<span class="text-danger">{{ $message }}</span>
									    @enderror

									    
								  </div>
							 
							  <button type="submit" class="btn btn-primary">Add Category</button>
							</form>
						</div>
		   				
			   		</div>
			   </div>

		   </div>
	   </div>
	</div>
</x-app-layout>
