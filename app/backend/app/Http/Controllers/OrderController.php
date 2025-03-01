<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if(!canDo(['orders_list'])) 
        {

            return response()->json(['message' => 'You are not allowed to view orders'], 403);
        }

        $users = User::withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->get();

        return response()->json([
            'message' => 'List of order counts by user',
            'data' => $users,
        ]);
    }
}
