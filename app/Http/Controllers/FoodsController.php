<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodsController extends Controller
{
    public function index($food_name) {
           // 댓글 많은 순
           $foods = DB::table('통계용')
           ->where('식품명', 'LIKE','%'.$food_name.'%')
           ->get();

            
           $res = response()->json([
            'search' => $food_name,
            'status' => 'success',
            'foods' => $foods
        ],200);

        return $res;
    }
}
