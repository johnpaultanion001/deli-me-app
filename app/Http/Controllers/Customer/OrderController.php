<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Validator;

class OrderController extends Controller
{
    public function addtocart(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'qty' => ['required' ,'integer','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
       
        $product = Product::where('id', $request->input('hidden_id'))->first();

        if($request->input('qty') > $product->stock){
            return response()->json(['errorstock' => 'Must be less than the stock.']);
        }
     

        $amount = $product->price * $request->input('qty');

        OrderProduct::updateOrcreate(
            [
                'user_id'    => auth()->user()->id,
                'product_id' => $request->input('hidden_id'),
                'isCheckout' => false,
            ],
            [
                'user_id'    => auth()->user()->id,
                'store_id'   => $product->store->id,
                'product_id' => $request->input('hidden_id'),
                'qty'        => $request->input('qty'),
                'amount'     => $amount,
            ]
        );

        return response()->json(['success' => 'Added Successfully.']);
    }

    public function edit_order(OrderProduct $order)
    {

        $product = [
            'name'              => $order->product->name,
            'price'             => $order->product->price,
            'description'       => $order->product->description,
            'stock'             => $order->product->stock,
            'qty'               => $order->qty,
            'amount'            => $order->amount,
            'image'             => $order->product->image,
            
        ];
           
        
        return response()->json(['result' =>  $product]);
    }

    public function update_order(Request $request,OrderProduct $order){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'qty' => ['required' ,'integer','min:1'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        if($request->input('qty') > $order->product->stock){
            return response()->json(['errorstock' => 'Must be less than the stock.']);
        }

        $amount = $order->product->price * $request->input('qty');

        OrderProduct::find($order->id)->update([
            'qty'        => $request->input('qty'),
            'amount'     => $amount,
        ]);

        return response()->json(['success' => 'Updated Successfully.']);

    }

    public function destroy_order(OrderProduct $order){
        $order->delete();
        return response()->json(['success' => 'Canceled Successfully.']);
    }

    public function orders()
    {
        date_default_timezone_set('Asia/Manila');
        $orders = OrderProduct::where('user_id', auth()->user()->id)
                                 ->where('isCheckout', false)
                                 ->latest()->get();

        $time = date("A");
        if($time == 'PM'){
            $delivery_text = '* PM order will be delivered at 5pm on subay port';
        }
        elseif($time == 'AM'){
           $delivery_text = '* AM order will be delivered at 11am on subay port';
        }

        return view('customer.orders' ,compact('orders','delivery_text'));
    }

    public function checkout()
    {
        $orderproducts = OrderProduct::where('user_id', auth()->user()->id)
                            ->where('isCheckout', false)->get();

        $ordercount = OrderProduct::where('user_id', auth()->user()->id)
                                    ->where('isCheckout', false)->count();

        if($ordercount < 1){
            return response()->json(['nodata' => 'No data available']);
        }       

        $orders = Order::create([
            'user_id'   => auth()->user()->id
        ]);
        foreach($orderproducts as $order){
            if($order->qty > $order->product->stock){
                Order::find($orders->id)->delete();
                return response()->json(['no_stock' => 'Out of stock <br>
                                                        Product: '.$order->product->name.
                                                        '<br> Qty: '.$order->qty. 
                                                        '<br> Available Stock: '.$order->product->stock]);
            }else{
                Product::where('id', $order->product->id)->decrement('stock', $order->qty);
                OrderProduct::where('id', $order->id)
                                ->update([
                                    'order_id' => $orders->id,
                                    'isCheckout' => true,
                                ]);
            }
           
        }
        return response()->json(['success' => 'Successfully Checkout.']);
        
    }
    public function orders_history(){
        $orders = Order::where('user_id', auth()->user()->id)
                            ->where('status', "PENDING")->latest()->get();
        $orders_approved = Order::where('user_id', auth()->user()->id)
                            ->where('status', "APPROVED")->latest()->get();
        return view('customer.orderHistory' ,compact('orders' , 'orders_approved'));
    }


    public function cancel(Request $request, Order $order)
    {
        Order::find($order->id)
                    ->update([
                        'status'    => 'CANCELLED'
                    ]);

        foreach($order->orderproducts()->get() as $order){
                Product::where('id', $order->product->id)->increment('stock', $order->qty);
        }
        

        return response()->json(['success' => 'Successfully Cancelled.']);
        
    }
    
}
