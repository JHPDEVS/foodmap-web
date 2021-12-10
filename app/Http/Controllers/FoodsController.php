<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodsController extends Controller
{
    public function index(Request $request,$food_name) {
           $foods = [];
           if($request->kind=='all') {
            $foods = DB::table('통계용')
            ->where('식품명', 'LIKE','%'.$food_name.'%')
            ->orderBy('연도', 'DESC')
            ->paginate(10);
           }
          if($request->kind=='livestock') {
            $foods = DB::table('통계용')
            ->where('DB군','=','농축산물')
            ->where('식품명', 'LIKE','%'.$food_name.'%')
            ->orderBy('연도', 'DESC')
            ->paginate(10);
           }

           if($request->kind=='seafood') {
            $foods = DB::table('통계용')
            ->where('DB군','=','수산물')
            ->where('식품명', 'LIKE','%'.$food_name.'%')
            ->orderBy('연도', 'DESC')
            ->paginate(10);
           }

           if($request->kind=='processed') {
            $foods = DB::table('통계용')
            ->where('DB군','=','가공식품')
            ->where('식품명', 'LIKE','%'.$food_name.'%')
            ->orderBy('연도', 'DESC')
            ->paginate(10);
           }
           
           if($request->kind=='food2') {
            $foods = DB::table('통계용')
            ->where('DB군','=','음식')
            ->where('식품명', 'LIKE','%'.$food_name.'%')
            ->orderBy('연도', 'DESC')
            ->paginate(10);
           }
           $res = response()->json([
            'search' => $food_name,
            'status' => 'success',
            'foods' => $foods,
            'kind' =>$request->kind
        ],200);

        return $res;
    }

    public function show($food_id,$food_name) {
        $food = DB::table('통계용')
        ->where('NO', '=', $food_id)
        ->where('식품명','=',$food_name)
        ->first();

         
        $res = response()->json([
         'status' => 'success',
         'food' => $food
     ],200);

     return $res;
 }
}
