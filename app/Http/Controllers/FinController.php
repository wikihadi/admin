<?php

namespace App\Http\Controllers;

use App\Fin;
use App\Status;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class FinController extends Controller
{
    public function allFin(){
        $role = $_GET['role'];
        $code = $_GET['code'];
        if ($code=='all'){
            if($role=='admin'){
//                $allFin = Fin::with('user','brand')
//                    ->whereHas('brand')
//                    ->whereHas('user')
//                    ->latest()
//                    ->where('state', '=',0)
//                    ->get();
                $allFin = Fin::with('user','brand')
                    ->whereHas('brand')
                    ->whereHas('user')
                    ->orderBy('state','asc')
                    ->latest()
                    ->where('state', '!=',200)
                    ->get();
            }elseif($role=='finance'){
                $allFin = Fin::with('user','brand')
                    ->whereHas('brand')
                    ->whereHas('user')
                    ->orderBy('state','asc')
                    ->latest()
                    ->whereBetween('state', [101, 102])
                    ->get();
            }elseif($role=='finMan'){
                $allFin = Fin::with('user','brand')
                    ->whereHas('brand')
                    ->whereHas('user')
//                ->orderBy('state','asc')
                    ->latest()
                    ->whereBetween('state', [100, 200])
                    ->get();
            }
        }else{
            if($code==100){
                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
            }elseif ($code==101){
                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
            }elseif ($code==102){
                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
            }elseif ($code==200){
                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
            }elseif ($code==0){
                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
            }
        }
        foreach ($allFin as $key => $loop){
            if ($loop->date!=null){
                $loop->jd = verta($loop->date)->formatJalaliDate();
            }else{
                $loop->jd = verta($loop->created_at)->formatJalaliDate();
            }


        }

        $sum = $allFin->sum('price');
        return response()->json([
            'all' => $allFin,
            'sum' => $sum,

        ]);
    }
    public function delFin(){
        $id = $_GET['id'];
        $user_id = $_GET['user'];
        $fin = Fin::find($id);
        $fin->delete();

        $status = new Status([
            'status'    => 'fin-del',
            'content'   => 'حذف هزینه ' . $id . 'توسط کاربر ' . $user_id,
            'user_id'   => $user_id,
            'fin_id'   => $id,
        ]);
        $status->save();
    }
    public function checkFin(){
        $role = $_GET['role'];
        $user = $_GET['user'];
        $id = $_GET['id'];
        $fin = Fin::find($id);

        if ($role=='admin'){
            if ($fin->state<100){
                if ($fin->price<5000000){
                    $fin->state=101;
                }else{
                    $fin->state=100;
                }
            }else{
                $fin->state=200;
            }

        }elseif ($role=='finMan'){
            $fin->state=101;
        }elseif ($role=='finance'){
            $fin->state=102;
        }
        $fin->save();

        $status = new Status([
            'status'    => 'fin-acc',
            'content'   => 'تایید هزینه ' . $id . 'توسط کاربر ' . $user . 'تغییر به کد ' . $fin->state,
            'user_id'   => $user,
            'fin_id'   => $id,
        ]);
        $status->save();

        return $fin;
    }
    public function updateFin()
    {
        $fin = Fin::where('id',$_GET['update'])->first();
        $fin->content=$_GET['content'];
//        $fin->acc=$_GET['acc'];
        $fin->price=$_GET['price'];
        $fin->brand_id=$_GET['brand'];
        $fin->subject=$_GET['subject'];
        $fin->save();
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
