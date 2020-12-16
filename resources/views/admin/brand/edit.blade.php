<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Edit Brand
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

						
							<div class="card-header">Edit Brand</div>

							<div class="card-body">
								<form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
									@csrf 
									<div class="form-group">
											<label for="exampleInputEmail1">Update Brand Name</label>
											<input name="brand_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brand->brand_name }}" autofocus="">


											@error('brand_name')
												<span class="text-danger">{{ $message }}</span>
											@enderror
									</div>

									<div class="form-group">
										<label for="exampleInputEmail1">Brand Image</label>

										<img src="{{ asset($brand->brand_image) }}" width="150" alt="">
										<br>
										<input name="brand_image" type="file" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1">

										<input type="hidden" name="old_brand_image" value="{{ $brand->brand_image }}">

										

										@error('brand_image')
											<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
							 
								<button type="submit" class="btn btn-primary">Update Brand</button>
							</form>
						</div>
							
						</div>
				 </div>

			 </div>
		 </div>
	</div>
</x-app-layout>
