@extends('../layouts.site')
@section('sub-title','HOME')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="my-auto mt-8 mb-6">
    <div class="row"> 
        <div class="col-lg-10 col-md-8 col-12 mx-auto">
          <div class="card z-index-0 fadeIn3 fadeInBottom">
            
              <div class="card-body">
              <h4 class="text-dark font-weight-bolder text-center mt-2 mb-0">Your Information</h4>
                <form method="POST" id="myForm">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{Auth()->user()->name ?? ''}}">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-name"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label class="form-label">Email <span class="text-danger">*</span></label>
                          <input type="email" id="email" name="email" class="form-control" value="{{Auth()->user()->email ?? ''}}" readonly>
                    
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{Auth()->user()->contact_number ?? ''}}">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-contact_number"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" value="{{Auth()->user()->address ?? ''}}">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error-address"></strong>
                            </span>
                        </div>
                    </div>
                  </div>
                    <div class="card-footer text-center row">
                       <div class="col-sm-6">
                            <button type="submit" class="btn bg-gradient-primary">Update Information</button>
                       </div>
                        <div class="col-sm-6">
                            <button type="button" class="btn bg-gradient-danger" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">Logout</button>
                            <button type="button" class="btn bg-gradient-warning">Change Password</button>
                        </div>
                    </div>
                </form>
              </div>
          </div>
        </div>
    </div>
</div>

@section('footer')
    @include('../partials.site.footer')
@endsection
@endsection





@section('script')
<script> 

</script>
@endsection