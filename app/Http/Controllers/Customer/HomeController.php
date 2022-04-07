<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    
    public function index()
    {
        $products = Product::latest()->get();
        $categories = Category::orderBy('name', 'asc')->get();
        return view('welcome' ,compact('products','categories'));
    }

    public function profile(){
        return view('customer.profile');
    }

    public function filter(Request $request){
        $filter = $request->get('filter');
        $value  = $request->get('value');

        if($filter == 'search'){
            $data = Product::where('name', 'LIKE', "%$value%")->latest()->get();
        }

        if($filter == 'category'){
            if($value == ''){
                $data = Product::latest()->get();
            }else{
                $data = Product::where('category_id', $value)->latest()->get();
            }
        }

        if($data->count() == 0){
            return response()->json([
                'no_data'  => 'NO RESULT FOUND',
            ]);
        }

        return response()->json([
            'products'  => $data,
        ]);
    }
}
