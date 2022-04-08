<div class="card-header bg-gradient-primary shadow-primary" style="box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);">
    <div class="row">
        <div class="col-6">
            <h5 class="text-white">DELI ME</h5>
        </div>
        <div class="col-6 text-right">
            <h6 class="text-white">
              @if(request()->is('customer/home'))
                ALL PRODUCTS
              @elseif(request()->is('customer/orders'))
                YOUR ORDERS 
              @elseif(request()->is('customer/profile'))
                YOUR INFORMATION
              @elseif(request()->is('customer/orders_history'))
                ORDERS HISTORY
              @elseif(request()->is('about_us'))
                ABOUT US
              @endif
            </h6>
        </div>
    </div>
</div>