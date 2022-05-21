@extends('../layouts.site')
@section('sub-title','Login')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="card-body">
    <div class="col-lg-4 col-md-8 col-12 mx-auto">
        <div class="z-index-0 fadeIn3 fadeInBottom">
            <div class="card-body">
                <div class="card-header text-center">
                    <h3 class="card-title title-up">
                    THANK YOU FOR REGISTERING PLEASE WAIT FOR A RESPONSE
                    FOR AN ADMINISTRATOR TO CONFIRM YOUR REGISTRATION ESTIMATED TIME OF
                    2-8 HOURS
                    </h3>
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