<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Validator;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'comment' => ['required'],
        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        Feedback::create([
            'user_id' => Auth()->user()->id,
            'comment' => $request->input('comment'),
        ]);

        return response()->json(['success' => 'Successfully sent.']);
    }
}
