@extends('../layouts.site')
@section('sub-title','Register')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="card-body mt-2 mb-5">
    <div class="col-lg-10 col-md-8 col-12 mx-auto">
      <div class="z-index-0 fadeIn3 fadeInBottom">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
              <h6 class="text-white font-weight-bolder text-center mt-2 mb-0">SIGN UP</h6>
              <div class="row mt-3">
            
              </div>
          </div>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="form-label">Email <span class="text-danger">*</span></label>
                      <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                      <input type="number" id="contact_number" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror" value="{{ old('contact_number') }}"   required autocomplete="contact_number">
                      @error('contact_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="form-label">Address <span class="text-danger">*</span></label>
                      <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"   required autocomplete="address">
                      @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="form-label">Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control @error('password') is-invalid @enderror"  id="password"  name="password" required autocomplete="new-password" >
                  
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                      <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" id="password-confirm" name="password_confirmation"  required autocomplete="new-password">
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"> 
                      <label class="form-label text-uppercase" >Upload( ID )<span class="text-danger">*</span></label>
                      <image id="img_upload_id" class="form-control d-none mb-2" height="200"></image>
                      <button type="button" id="btn_upload_id" class="form-control btn-sm">UPLOAD ID</button>
                      <input type="file" id="upload_id" name="upload_id" accept="image/*" style="display:none" class="classic-input form-control font-weight-bold @error('upload_id') is-invalid @enderror">
                      @error('upload_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                </div>
                <div class="col-sm-12 text-left">
                  <div class="form-group form-check " style="padding-left:0.1em; padding-top:1em;">
                      <input type="checkbox" class="form-check-input show_terms_and_condition @error('terms_and_conditions') is-invalid @enderror" name="terms_and_conditions" id="terms_and_conditions">
                      <label class="form-check-label text-uppercase text-primary show_terms_and_condition" style="font-size: 15px;">Terms and conditions</label>
                      @error('terms_and_conditions')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                </div>
                
              </div>

                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">SIGN UP</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Already a member?
                    <a href="/login" class="text-primary text-gradient font-weight-bold">SIGN IN</a>
                  </p>
            </form>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="tacModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="fas fa-times text-primary"></i>
              </button>
            </div>
            <div class="modal-body text-justify">
            <h6>
              TERMS AND CONDITIONS <br>
              <p>
                Please read these Terms of Service before using this application; by using this application, you acknowledge that you have read, understood, and agreed to these Terms of Service. Do not use this application if you do not agree to the Terms of Service.
              </p>
                
              MODE OF PAYMENT<br>
              <p>
                The DELIME only accepts cash on delivery as a method of payment. There will be no online payments accepted.
              </p>

              DELIVERY TIME<br>
              <p>
                The application will implement a timed delivery method, the delivery will take place at a specific time and will not be changeable.
              </p>
              
              AM order will be delivered at 11am on subay port<br>
              Cut off approval of order is 10am<br>

              PM order will be delivered at 5pm on subay port<br>
              Cut off approval of order is 4pm<br>

              <br>
              PRIVACY POLICY<br>
              <p>
                Please read these Privacy policy, using this application means you have read, understood and accepted these Privacy policy, If you do not accept these do not use this application.
              </p>
              Our Privacy Commitment<br>
              <p>
                Please read these privacy policy, by using this application, you acknowledge that you have read, understood, and agreed to these terms. If you do not agree, do not use this application.
              </p>
              Personal information we need<br>
              <p>
                We only collects, your personal information that is necessary for us to be able to provide the service, which include the following: 
              </p>
              1. Your name, address, email , contact number and valid ID that proves you are from brgy subay.
              <br>
              2. Your selected items and time order.<br>
            </h6>
            </div>
            <div class="modal-footer">
              <input type="button" id="tacConfirm" class="btn btn-primary text-uppercase" value="All Agreed to the Terms and Conditions"/>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script> 

$(document).on('click', '#btn_upload_id', function(){
    $.confirm({
      title: '',
      content: 'Allow <b> DELI-ME </b> to access photos ,media, and files on you device? ',
      buttons: {
          cancel:  {
              text: 'Deny',
              btnClass: 'btn-link-danger',
          },
          confirm: {
              text: 'Allow',
              btnClass: 'btn-link',
              action: function(){
                $('#upload_id').trigger('click');
              }
          }
      }
  });

});

$('#upload_id').on("change", function(event){
  var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("upload_id").files[0]);

      oFReader.onload = function (oFREvent) {
          $('#img_upload_id').removeClass('d-none')
          document.getElementById("img_upload_id").src = oFREvent.target.result;
      };
});

$(document).on('click', '.show_terms_and_condition', function(){
    $('#tacModal').modal('show');
    $('#terms_and_conditions').prop('checked', false);
});

$(document).on('click', '#tacConfirm', function(){
    $('#tacModal').modal('hide');
    $('#terms_and_conditions').prop('checked', true);
});

</script>
@endsection