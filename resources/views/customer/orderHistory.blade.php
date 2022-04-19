@extends('../layouts.site')
@section('sub-title','HOME')

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
        <div class="col-md-8 mt-4 mx-auto">
            <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 text-uppercase">Your Pending Orders</h6>
                            </div>
                        
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                @forelse($orders as $order)
                                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-icon-only btn-rounded btn-outline-warning mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-shopping-cart" style="font-size: 17px"></i></button>
                                            <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">
                                                @foreach($order->orderproducts as $product_order)
                                                    <span class="badge bg-warning">{{$product_order->qty}} {{$product_order->product->name}} * {{$product_order->product->price}} = {{$product_order->amount}}</span> <br>
                                                @endforeach
                                            </h6>
                                                <h6 class="text-xs text-uppercase"> {{ $order->created_at->format('M j , Y h:i A') }}</h6>
                                               
                                                <h6 class="text-s mt-2 text-warning">{{$order->status}}</h6>
                                                <?php
                                                    $subtotal = $order->orderproducts->sum->amount;
                                                    $service_fee = 55;

                                                    $total = $subtotal + $service_fee;
                                                ?>
                                                <hr>
                                                <h6  class="text-s mt-2">SUBTOTAL: <span class="text-primary"> ₱  {{number_format($order->orderproducts->sum->amount?? '' , 2, '.', ',')}}</span> </h6>
                                                <h6  class="text-s mt-2">DELIVERY FEE: <span class="text-primary"> ₱  55.00</span> </h6>
                                                <h6  class="text-s mt-2">TOTAL: <span class="text-primary"> ₱  {{ number_format($total ?? '' , 2, '.', ',') }}</span> </h6>
                                            </div>
                                        </div>
                                       
                                    </li>
                                    <hr>
                                @empty
                                <div class="text-center">
                                    <h6 class="mb-0">NO PENDING ORDER FOUND</h6>
                                </div>
                                @endforelse
                                
                            </ul>
                    </div>
            </div>
        </div>
        <div class="col-md-8 mt-4 mx-auto">
            <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0 text-uppercase">Your Approved Orders</h6>
                            </div>
                        
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                       
                            <ul class="list-group">
                                @forelse($orders_approved as $order)
                                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-shopping-cart" style="font-size: 17px"></i></button>
                                            <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">
                                                @foreach($order->orderproducts as $product_order)
                                                    <span class="badge bg-success">{{$product_order->qty}} {{$product_order->product->name}} * {{$product_order->product->price}} = {{$product_order->amount}}</span> <br>
                                                @endforeach
                                            </h6>
                                                <h6 class="text-xs text-uppercase"> {{ $order->created_at->format('M j , Y h:i A') }}</h6>
                                                <h6 class="text-s mt-2 text-success">{{$order->status}}</h6>
                                                <?php
                                                    $subtotal = $order->orderproducts->sum->amount;
                                                    $service_fee = 55;

                                                    $total = $subtotal + $service_fee;
                                                ?>
                                                <hr>
                                                <h6  class="text-s mt-2">SUBTOTAL: <span class="text-primary"> ₱  {{number_format($order->orderproducts->sum->amount?? '' , 2, '.', ',')}}</span> </h6>
                                                <h6  class="text-s mt-2">DELIVERY FEE: <span class="text-primary"> ₱  55.00</span> </h6>
                                                <h6  class="text-s mt-2">TOTAL: <span class="text-primary"> ₱  {{ number_format($total ?? '' , 2, '.', ',') }}</span> </h6>
                                               
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <hr>
                                @empty
                                <div class="text-center">
                                    <h6 class="mb-0">NO APPROVED ORDER FOUND</h6>
                                </div>
                                @endforelse
                            </ul>
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

$(document).on('click', '#nav_product', function(){
    $(location).attr('href',"/");
});
$(document).on('click', '#nav_orders', function(){
    $(location).attr('href',"/customer/orders");
});

</script>
@endsection