<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenusController extends Controller
{
    public function Index(Request $request) {
        $date = $request->date;
        $user_id = Auth::user()->id;

        $menus = DB::table('menus')
        ->join('users','users.id','=','menus.user_id')
        ->where('menus.user_id', '=', $user_id)
        ->where('menus.date', '=', $date)
        ->select(
            DB::raw(' *,menus.id'),
        )
        ->orderBy('menus.id', 'desc')->get();
        
        
        $res = response()->json([
            'status' => 'success',
            'menus' => $menus,
            'user_id' => $user_id,
        ],200);

        return $res;
    }

    public function create(Request $req) {
        $menu = new Menu();
        $menu->user_id = $req->user_id;
        $menu->product_title = $req->product_title;
        $menu->product_id = $req->product_id;
        $menu->kcal = $req->kcal;
        $menu->kcal_per = $req->kcal_per;
        $menu->pro = $req->pro;
        $menu->pro_per = $req->pro_per;
        $menu->fat = $req->fat;
        $menu->fat_per = $req->fat_per;
        $menu->fiber = $req->fiber;
        $menu->fiber_per = $req->fiber_per;
        $menu->suger = $req->suger;
        $menu->suger_per = $req->suger_per;
        $menu->col = $req->col;
        $menu->col_per = $req->col_per;
        $menu->po = $req->po;
        $menu->po_per = $req->po_per;
        $menu->trans = $req->trans;
        $menu->trans_per = $req->trans_per;
        $menu->salt = $req->salt;
        $menu->salt_per = $req->salt_per;
        $menu->serve = $req->serve;
        $menu->date = date('Y-m-d');
        $menu->save();

        $res = response()->json([
            'status' => 'success',
            'menu' => $menu,
        ], 200);

        return $res;
    }

    public function delete(Request $request) {
        $id = $request->id;
        $menu = Menu::find($id);
        $menu->delete();

        $res = response()->json([
            'status' => 'ture',
            'id' => $id,
            'message' => '삭제가 되었습니다.',
        ], 200, [], JSON_UNESCAPED_UNICODE);

        return $res;
    }

}
