<?php

namespace App\Http\Controllers;

use App\Fin;
use App\Status;
use Illuminate\Http\Request;

class FinController extends Controller
{
    public function allFin(){
        $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('created_at','desc')->get();
        $sum = $allFin->sum('price');
        return response()->json([
            'all' => $allFin,
            'sum' => $sum,

        ]);
    }
//    public function addFin(Request $request){
//        $status = new Status([
//            'status'    => 'fin',
//            'content'   => 'تنخواه توسط کاربر ' . $request->get('user_id'),
//            'user_id'   => $request->get('user_id'),
//        ]);
//        $status->save();
//        $fin = new Fin([
//            'price' => $request->get('price'),
//            'content' => $request->get('content'),
//            'user_id' => $request->get('user_id'),
//            'brand_id' => $request->get('brand_id'),
//        ]);
//        $fin->save();
//        $done = true;
//        return $done;
//    }
}
