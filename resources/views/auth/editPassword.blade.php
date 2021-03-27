@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Update Password</h1>
  <hr>

  @include('partials._messages')

  <div class="d-flex justify-content-center">
  	<div class="col-md-7">

	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Form Update Password</h6>
	    </div>
	    <form action="{{ route('auth.updatePassword', ['user' => auth()->user()->id]) }}" method="post">

	    	@method('patch')

			@csrf

		    <div class="card-body">

				<div class="form-row">

					<div class="col-md-12 mb-3">
						<label for="password" class="text-dark">Password:</label>
						<input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
						@error('password')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>

					<div class="col-md-12 mb-3">
						<label for="password_confirmation" class="text-dark">Konfirmasi Password:</label>
						<input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
						@error('password_confirmation')
							<small class="form-text text-danger">{{ $message }}</small>
						@enderror
					</div>

				</div>

			</div>

		    <div class="card-footer">
		    	<div class="d-flex justify-content-end">
		    		<button class="btn btn-primary btn-icon-split" type="submit">
		    			<span class="icon text-white-50">
		    				<i class="fas fa-save"></i>
		    			</span>
		    			<span class="text">Update</span>
		    		</button>
		    	</div>
		    </div>

	    </form>
	  </div>
  		
  	</div>
  </div>

@endsection