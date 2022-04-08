<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Validator;

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


    public function passwordupdate(Request $request , User $user){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'current_password' => ['required',new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'confirm_password' => ['required','same:new_password'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        User::find($user->id)->update([
            'password' => Hash::make($request->input('new_password')),
          
        ]);
        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function profile_update(Request $request){
       
        $validated =  Validator::make($request->all(), [
            'name'   => ['required'],
            'contact_number' => ['required', 'string', 'min:8','max:11'],
            'address'   => ['required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $user = User::find(auth()->user()->id)->update(
            [
                'name'  => $request->input('name'),
                'contact_number'  => $request->input('contact_number'),
                'address'  => $request->input('address'),
            ]
        );
   
    return response()->json(['success' => 'Updated Successfully.']);
}

}
