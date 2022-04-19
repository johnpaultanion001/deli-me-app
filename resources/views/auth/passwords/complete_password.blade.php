
@extends('../layouts.site')
@section('sub-title','Forgot Password')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="container my-auto mt-6">
    <div class="row">
        <div class="col-lg-4 col-md-8 col-12 mx-auto">
          <div class="z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Reset Password</h4>
                  <div class="row mt-3">
                
                  </div>
              </div>
              </div>
              <div class="card-body text-center">
                  <h6>
                    Your password has been successfully changed. <br>
                    Log in to the DELI ME APP and use a newly created password
                  </h6>
                
              </div>
          </div>
        </div>
    </div>
</div>
 
@endsection

@section('script')
<script> 

</script>
@endsection







