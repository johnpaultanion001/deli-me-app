@extends('../layouts.site')
@section('sub-title','HOME')

@section('navbar')
    @include('../partials.site.navbar')
@endsection

@section('content')

<div class="card">
    <div class="card-header" style="box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);">
        <div class="row">
            <div class="col-6">
                <h5 class="text-primary">DELI ME</h5>
            </div>
            <div class="col-6 text-right">
                <h6>ALL PRODUCTS</h6>
            </div>
        </div>
    </div>
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
                
                <div class="row">
                    <div class="col-md-12">
                        <input type="text" id="search-bar" placeholder="Find a product?">
                        <img class="search-icon" src="http://www.endlessicons.com/wp-content/uploads/2012/12/search-icon.png">
                        <div class="form-group">
                            <select name="category" id="category" style="height: 30px; width: 150px; margin-top: 5px;">
                                <option value="">Filter Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    
                </div>
                    
                <div class="row pt-4" id="product_list">
                    @foreach($products as $product)
                    <div class="col-md-12">
                        <div class="card flex-row border-primary mb-3 viewproduct " productid="{{  $product->id ?? '' }}">
                            <img src="{{URL::asset('http://deli-me.supsofttech.com/assets/img/products/'.$product->image)}}" alt="img-blur-shadow" class="border-radius-xl" width="150" style="height: 100px;">
                            <div class="card-body">
                                <h5 class="mb-0">{{$product->name}}</h5>
                                <h6 class="text-primary">₱ {{$product->price}}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

                    <input type="hidden" name="action" id="action" value="Add" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    
                </div>
                <div class="modal-footer">
                    <input type="submit" name="action_button" id="action_button" class="btn  btn-primary" value="Add To Cart"/>
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
    $(document).on('click', '.viewproduct', function(){
        $('#formModal').modal('show');
        $('.modal-title').text('Edit Prorduct');
        $('#myForm')[0].reset();
        $('.form-control').removeClass('is-invalid');
        var id = $(this).attr('productid');

        $.ajax({
            url :"/view/"+id,
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").attr("value", "Loading..");  
            },
            success:function(data){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Add To Cart");
                }
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
                    if(key == 'image'){
                        $('#current_image').attr("src", 'http://deli-me.supsofttech.com/assets/img/products/'  + value);
                    }
                })
                $('#hidden_id').val(id);
            }
        })
    });

    $('#formModal').on('shown.bs.modal', function () {
        $('#qty').focus();
    }) 


    $('#myForm').on('submit', function(event){
        event.preventDefault();
        $('.form-control').removeClass('is-invalid')
        var action_url = "{{ route('customer.addtocart') }}";
        var type = "POST";

        

        $.ajax({
            url: action_url,
            method:type,
            data:$(this).serialize(),
            dataType:"json",
            beforeSend:function(){
                $("#action_button").attr("disabled", true);
                $("#action_button").attr("value", "Loading..");
            },
            success:function(data){
                if($('#action').val() == 'Edit'){
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Update");
                }else{
                    $("#action_button").attr("disabled", false);
                    $("#action_button").attr("value", "Add To Cart");
                }
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

                }
            },
        });
    });

    
    $('#search-bar').on("input", function() {
        var filter = 'search';
        var value = this.value;

        $.ajax({
        url: "/customer/home/filter", 
        type: "get",
        dataType:"json",
        data: {
            filter:filter, value:value ,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            
        },
        success: function(data){
                if(data.products){
                        var products = '';
                        $.each(data.products, function(key,value){
                            products += '<div class="col-md-12">'
                                products  += '<div class="card flex-row border-primary mb-3 viewproduct" productid="'+value.id+'">';
                                    products  += '<img src="http://deli-me.supsofttech.com/assets/img/products/'+value.image+'" alt="img-blur-shadow" class="border-radius-xl" width="150" style="height: 100px;">';
                                    products  += '<div class="card-body">';
                                        products  += '<h5 class="mb-0">'+value.name+'</h5>';
                                        products  += '<h6 class="text-primary">₱ '+value.price+'</h6>';
                                    products  += '</div>';
                                products  += '</div>';
                            products  += '</div>';
                        });
                        $('#product_list').empty().append(products);
                    }
                    if(data.no_data){
                        var products = '';
                        products += '<div class="col-md-12">'
                            products  += '<div class="card flex-row border-primary mb-3">';
                                products  += '<div class="card-body">';
                                    products  += '<h5 class="mb-0">'+data.no_data+'</h5>';
                                products  += '</div>';
                            products  += '</div>';
                        products  += '</div>';
                    
                        $('#product_list').empty().append(products);
                    }
                },
            });
    });

    $('#category').on("change", function(event){
        var filter = 'category';
        var value = this.value;

        $.ajax({
        url: "/customer/home/filter", 
        type: "get",
        dataType:"json",
        data: {
            filter:filter, value:value ,_token: '{!! csrf_token() !!}',
        },
        beforeSend: function() {
            
        },
        success: function(data){
                if(data.products){
                        var products = '';
                        $.each(data.products, function(key,value){
                            products += '<div class="col-md-12">'
                                products  += '<div class="card flex-row border-primary mb-3 viewproduct" productid="'+value.id+'">';
                                    products  += '<img src="http://deli-me.supsofttech.com/assets/img/products/'+value.image+'" alt="img-blur-shadow" class="border-radius-xl" width="150" style="height: 100px;">';
                                    products  += '<div class="card-body">';
                                        products  += '<h5 class="mb-0">'+value.name+'</h5>';
                                        products  += '<h6 class="text-primary">₱ '+value.price+'</h6>';
                                    products  += '</div>';
                                products  += '</div>';
                            products  += '</div>';
                        });
                        $('#product_list').empty().append(products);
                    }
                    if(data.no_data){
                        var products = '';
                        products += '<div class="col-md-12">'
                            products  += '<div class="card flex-row border-primary mb-3">';
                                products  += '<div class="card-body">';
                                    products  += '<h5 class="mb-0">'+data.no_data+'</h5>';
                                products  += '</div>';
                            products  += '</div>';
                        products  += '</div>';
                    
                        $('#product_list').empty().append(products);
                    }
                },
            });
    });


</script>
@endsection