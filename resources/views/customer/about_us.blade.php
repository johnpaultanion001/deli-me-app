@extends('../layouts.site')
@section('sub-title','HOME')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')
<div class="card-body mb-2">
    <div class="col-lg-10 mx-auto text-center">
        <div>
            <div class="card-body">
                <h6>
                    Deli-me is an app that makes online product buying simple. It aims to provide you convenience in terms of product buying, take advantage of online product purchasing to save time. You can simply access items from Binangonan market using the application.
                </h6>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-lg-10">
        <form method="post" id="myForm" class="contact-form">
            @csrf
            <div class="form-group">
                <h6>Comments: </h6>
                <textarea name="comment" id="comment" class="form-control"></textarea>
                <span class="invalid-feedback" role="alert">
                    <strong id="error-comment"></strong>
                </span>
            </div>
            <div class="col-lg-12 mt-2 text-center">
                <button type="submit" id="action_button"  class="btn btn-primary btn-wd">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
    


@section('footer')
    @include('../partials.site.footer')
@endsection
@endsection





@section('script')
<script> 
$('#myForm').on('submit', function(event){
    event.preventDefault();
    $('.form-control').removeClass('is-invalid')
    var action_url = "{{ route('customer.feedback.store') }}";
    var type = "post";

    $.ajax({
        url: action_url,
        method:type,
        data:$(this).serialize(),
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
           $("#action_button").attr("disabled", false);
          
            if(data.errors){
                $.each(data.errors, function(key,value){
                    if(key == $('#'+key).attr('id')){
                        $('#'+key).addClass('is-invalid')
                        $('#error-'+key).text(value)
                    }
                })
            }
            if(data.success){
                $('.form-control').removeClass('is-invalid')
                $('#myForm')[0].reset();
                $.confirm({
                title: 'Confirmation',
                content: data.success,
                type: 'green',
                buttons: {
                        confirm: {
                            text: 'confirm',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                location.reload();
                            }
                        },
                        
                    }
                });
            }
            
        }
    });
});


</script>
@endsection