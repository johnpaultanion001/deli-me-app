@extends('../layouts.site')
@section('sub-title','ORDERS')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')

<div class="card-body mb-7">
    <ul class="nav nav-tabs justify-content-center text-center text-uppercase font-weight-bold">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('customer/home') ? 'active' : '' }}" href="/customer/home" style="color: #344767;">
                <i class="material-icons text-lg">shopping_cart</i> <br>  
                Products
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('customer/orders') ? 'active' : '' }}" href="/customer/orders" style="color: #344767;">
            <i class="material-icons text-lg">shopping_cart_checkout</i> <br>  
                Orders
            </a>
        </li>
    </ul>
    <div class="row">
        
        <div class="col-12 mt-4">
            <div class="card card-plain h-100">
                <div class="card-body p-3">
                    <h6 class="text-danger text-center text-uppercase">{{$delivery_text}}</h6>
                    <ul class="list-group">
                        @forelse($orders as $order)
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                <div class="avatar me-3">
                                    <img src="{{URL::asset('http://deli-me.supsofttech.com/assets/img/products/'.$order->product->image)}}" alt="image" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0">{{$order->product->name}}</h6>
                                    <h6 class="mb-0 text-primary">₱ {{$order->amount}}</h6>
                                    <p class="mb-0 text-xs text-dark font-weight-bold">QTY: {{$order->qty}}</p>
                                    <p class="mb-0 text-xs text-dark font-weight-bold">{{ $order->created_at->format('M j , Y h:i A') }}</p>
                                    
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-success mb-2 btn-sm edit_order" order_id="{{$order->id}}">
                                        <i class="material-icons text-lg">edit</i>
                                    </button> <br>
                                    <button class="btn btn-danger mb-0 btn-sm cancel_order" order_id="{{$order->id}}">
                                        <i class="material-icons text-lg">delete</i>
                                    </button>
                                </div>
                            </li>
                            <hr>
                        @empty
                            <div class="text-center">
                                <h6 class="mb-0">NO ORDER FOUND</h6>
                            </div>
                        @endforelse
                        <?php
                                $subtotal = $orders->sum->amount;
                                $service_fee = 55;

                                $total = $subtotal + $service_fee;
                        ?>
                        @if($orders->count() != 0)
                            <hr>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0">SUBTOTAL</h6>
                                    </div>
                                    <div class="ms-auto text-primary">
                                        ₱ {{ number_format($orders->sum->amount ?? '' , 2, '.', ',') }}
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0">DELIVERY FEE</h6>
                                    </div>
                                    <div class="ms-auto text-primary">
                                        ₱ 55.00
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                                    <div class="d-flex align-items-start flex-column justify-content-center">
                                        <h6 class="mb-0">TOTAL AMOUNT</h6>
                                    </div>
                                    <div class="ms-auto text-primary">
                                        ₱ {{ number_format($total ?? '' , 2, '.', ',') }}
                                    </div>
                                </li>

                                <button class="btn-outline-primary btn btn-lg" id="checkout">Checkout</button>
                        @endif
                    </ul>
                </div>
            
            </div>
        </div>
    </div>
</div>

<form method="post" id="myForm">
    @csrf
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
               
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-primary"></i>
                </button>
    
                </div>
                <div class="modal-body">
                  <div class="col-xl-12">
                      <div class="card card-blog card">
                          <div class="card-header p-0 mt-n4 mx-3">
                              <a class="d-block shadow-xl border-radius-xl">
                                  <img id="current_image" src="" alt="img-blur-shadow" class="border-radius-xl" width="200" style="height: 100px;">
                                  
                              </a>
                          </div>
                        <div class="card-body p-3">
                            <h5 class="mb-0" id="modal_product_name"></h5>

                            <h4 class="text-primary">₱ <span id="modal_product_price"></span> </h4>
                            <h5 class="text-sm text-dark" id="modal_product_description"></h5>
                            <h5 class="mb-4 text-sm text-dark" id="modal_product_stock"></h5>
                            <h5 class="mb-4 text-sm text-dark" id="modal_total_amount"></h5>
                          
                            <div class="form-group">
                              <div class="input-group input-group-outline my-3">
                                  <label class="form-label">QTY: <span class="text-danger">*</span></label>
                                  <input type="number" name="qty" id="qty" class="form-control disabled" onfocus="focused(this)" onfocusout="defocused(this)">
                                  <span class="invalid-feedback" role="alert">
                                      <strong id="error-qty"></strong>
                                  </span>
                              </div>
                            </div>
                        </div>
                      </div>
                  </div>

                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" name="action_button" id="action_button" class="btn  btn-primary" value="UPDATE"/>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
 
@section('footer')
    @include('../partials.site.footer')
@endsection
@endsection





@section('script')
<script> 
$(document).on('click', '.edit_order', function(){
    $('#formModal').modal('show');
    $('#myForm')[0].reset();
    $('.form-control').removeClass('is-invalid');
    var id = $(this).attr('order_id');

    $.ajax({
        url :"/customer/orders/"+id,
        dataType:"json",
        beforeSend:function(){
            $("#action_button").attr("disabled", true);
        },
        success:function(data){
            $("#action_button").attr("disabled", false);
              
            
            $.each(data.result, function(key,value){
                if(key == 'name'){
                    $('#modal_product_name').html(value);
                }
                if(key == 'price'){
                    $('#modal_product_price').html(value);
                }
                if(key == 'description'){
                    $('#modal_product_description').html(value);
                }
                if(key == 'stock'){
                    $('#modal_product_stock').html("STOCK: "+ value);
                }
                if(key == 'amount'){
                    $('#modal_total_amount').html("TOTAL AMOUNT: ₱ "+ value);
                }
                if(key == 'image'){
                    $('#current_image').attr("src", 'http://deli-me.supsofttech.com/assets/img/products/'  + value);
                }
                if(key == 'qty'){
                    $('#qty').val(value);
                }
            })
            $('#hidden_id').val(id);
        }
    })
});

$('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var action_url = "/customer/orders/" + $('#hidden_id').val();
        var type = "PUT";
        
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
                if(data.errorstock){
                    $('#qty').addClass('is-invalid');
                    $('#error-qty').text(data.errorstock);
                }
                if(data.success){
                    $('.form-control').removeClass('is-invalid')
                    $('#myForm')[0].reset();
                    $('#formModal').modal('hide');
                    $('#successToast').addClass('show');
                    $('#text_information').text(data.success);
                    setTimeout(function() { 
                        location.reload();
                    }, 1000);
                }
            },
            
            
        });
});

$(document).on('click', '.cancel_order', function(){
  var order_id = $(this).attr('order_id');
  $.confirm({
      title: 'Confirmation',
      content: 'You really want to cancel this order?',
      type: 'red',
      buttons: {
          confirm: {
              text: 'confirm',
              btnClass: 'btn-blue',
              action: function(){
                  return $.ajax({
                      url:"/customer/orders/"+order_id,
                      method:'DELETE',
                      data: {
                          _token: '{!! csrf_token() !!}',
                      },
                      dataType:"json",
                      beforeSend:function(){
                           
                      },
                      success:function(data){
                          if(data.success){
                            $('.form-control').removeClass('is-invalid')
                            $('#myForm')[0].reset();
                            $('#formModal').modal('hide');
                            $('#successToast').addClass('show');
                            $('#text_information').text(data.success);
                            setTimeout(function() { 
                                location.reload();
                            }, 1000);
                          }
                      }
                  })
              }
          },
          cancel:  {
              text: 'cancel',
              btnClass: 'btn-red',
          }
      }
  });

});

$(document).on('click', '#checkout' , function(){
    $.ajax({
        url :"/customer/checkout",
        dataType:"json",
        method:"post",
        data: {
                    _token: '{!! csrf_token() !!}',
                },
        beforeSend:function(){
            $("#checkout").attr("disabled",true);
            $("#checkout").text("Loading..");  
        },
        success:function(data){
            $("#checkout").attr("disabled",false);
            $("#checkout").text("CHECKOUT");
            if(data.no_stock){
                $('#dangerToast').addClass('show');
                $('#text_information_error').html(data.no_stock);
            }  
            if(data.nodata){
                $('#dangerToast').addClass('show');
                $('#text_information_error').text(data.nodata);
            }
            if(data.success){
                $('#successToast').addClass('show');
                $('#text_information').text(data.success);
                    setTimeout(function() { 
                        $(location).attr('href',"/customer/orders_history");
                    }, 2000);
            }
        }
    })
});

$('#formModal').on('shown.bs.modal', function () {
    $('#qty').focus();
}) 



</script>
@endsection