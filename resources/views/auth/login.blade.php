@extends('../layouts.site')
@section('sub-title','Login')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="card-body">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
      <div class="card z-index-0">
          <div class="card-header p-0 position-relative mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
              <h6 class="text-white font-weight-bolder text-center mt-2 mb-0">SIGN IN</h6>
              <div class="row mt-3">
            
              </div>
          </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf
                    <label class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                    <label class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">SIGN IN</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Don't have an account?
                    <a href="/register" class="text-primary text-gradient font-weight-bold">SIGN UP</a>
                  </p>
                  <p class="mt-4 text-sm text-center">
                    <a href="/password/reset" class="text-primary text-gradient font-weight-bold">Forgot your password?</a>
                  </p>
                  
            </form>
          </div>
      </div>
    </div>
</div>
 
@endsection
@section('footer')
    @include('../partials.site.footer')
@endsection

@section('script')
<script> 

</script>
@endsection