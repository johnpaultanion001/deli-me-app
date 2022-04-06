
@extends('../layouts.site')
@section('sub-title','Forgot Password')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="container my-auto">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Reset Password</h4>
                  <div class="row mt-3">
                
                  </div>
              </div>
              </div>
              <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success text-white" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.update') }}">
                  @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror

                        <label class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                        <label class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                      
                 
                      <div class="text-center">
                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Reset Password</button>
                      </div>
                </form>
              </div>
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







