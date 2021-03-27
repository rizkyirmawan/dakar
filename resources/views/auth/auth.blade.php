@extends('auth.app')

@section('content')
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-12 col-md-9">
    <div class="d-flex justify-content-center mt-3 mb-2">
      <img src="{{ asset('img/logo.png') }}" class="img-fluid" width="300">
    </div>
    <div class="card o-hidden border-0 shadow-lg my-3">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-4">

              @include('partials._messages')
              
              <form class="user" method="post" action="{{ route('auth.login') }}">

                @csrf

                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" id="username" placeholder="NIK atau Username..." value="{{ old('username') }}">
                  @error('username')
                    <div class="text-center text-danger">
                      <small>{{ $message }}</small>
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="password" placeholder="Password...">
                  @error('password')
                    <div class="text-center text-danger">
                      <small>{{ $message }}</small>
                    </div>
                  @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Login
                </button>

              </form>
              <hr>
              <div class="text-center">
              	<small class="text-gray-600">Anda seorang karyawan? <a href="{{ route('auth.registerKaryawan') }}">Registrasi</a></small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-center">
          <small class="text-gray-600">Copyright &copy; DAKAR {{ \Carbon\Carbon::now()->year }}</small>
        </div>
      </div>
    </div>

  </div>

</div>
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection