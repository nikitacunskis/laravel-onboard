<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if(!canDo('orders_list')) 
        {

            return response()->json(['message' => 'You are not allowed to view orders'], 403);
        }

        $user = $request->user();

        return response()->json([
            'message' => 'List of orders'
        ]);
    }
}
