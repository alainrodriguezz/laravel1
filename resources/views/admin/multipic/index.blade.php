<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			Multi Picture
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

						<div class="card-header">Multi Picture</div>
						<div class="card-group mb-5">
							@foreach($images as $image)
								<div class="col-md-4 mt-5 ">
									<div class="card">
										<img src="{{ asset($image->image) }}" alt="">
									</div>
								</div>
							@endforeach
						</div>							
							
						</div>
					</div>
				
				<div class="col-md-4">
						<div class="card">
							<div class="card-header">Multi Image</div>

							<div class="card-body">
								<form action="{{ route('multi.image.store') }}" method="POST" enctype="multipart/form-data">
									@csrf 
									
									

									<div class="form-group">
										 <label for="exampleInputEmail1">Brand Image</label>
										 <input name="images[]" type="file" class="form-control" aria-describedby="emailHelp" id="exampleInputEmail1" multiple="">

										 @error('image')
											<span class="text-danger">{{ $message }}</span>
										 @enderror
									</div>
							 
								<button type="submit" class="btn btn-primary">Add Image</button>
							</form>
						</div>
							
						</div>
				</div>

			</div>
		</div>





	</div>
</x-app-layout>
