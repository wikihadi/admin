<?php

namespace App\Http\Controllers;

use App\Fin;
use App\Status;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;

class FinController extends Controller
{
    public function main(){
        $users = User::all();
        return view('fin.main',compact('users'));
    }
    public function allFin(){

        $user_id = $_GET['user'];
        $finSection = $_GET['finSection'];
        $finUser = $_GET['finUser'];
        $finBrands = $_GET['finBrands'];
        $role = $_GET['role'];
        $code = $_GET['code'];
        $filters =  [
            'user_id' => $user_id,
            'section' => $finSection,
            'brand_id' => $finBrands,
            'state' => $code,
        ];



//        if ($code!=0&&$code!=100&&$code!=101&&$code!=102&&$code!=200){
        if ($code=='all'){
            if($role=='admin'||$role=='taskMan'){
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
            }elseif($role=='designer'){
                $allFin = Fin::with('user','brand')
                    ->whereHas('brand')
                    ->whereHas('user')
                    ->where('user_id',$_GET['user'])
                    ->latest()
                    ->get();
            }
        }else{
                if ($role=='designer'){
                    $allFin = Fin::with('user','brand')->whereHas('brand')->where('user_id',$_GET['user'])->where('state', '=',$code)->latest()->orderBy('state','asc')->get();
                }else{
                    $allFin = Fin::with('user','brand')->whereHas('brand')->where('state', '=',$code)->latest()->orderBy('state','asc')->get();
                }
//            }elseif ($code==101){
//                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
//            }elseif ($code==102){
//                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
//            }elseif ($code==200){
//                $allFin = Fin::with('user','brand')->whereHas('brand')->orderBy('state','asc')->where('state', '=',$code)->get();
//            }elseif ($code==0){
//                $allFin = Fin::with('user','brand')->whereHas('brand')->latest()->orderBy('state','asc')->where('state', '=',$code)->get();
//            }
        }
        if ($finSection>0){
            $allFin1 = $allFin->pluck('id')->toArray();
            $allFin = Fin::with('user','brand')->whereHas('brand')->whereIn('id',$allFin1)->where('section',$finSection)->latest()->get();
        }
        if ($finUser>0){
            $allFin1 = $allFin->pluck('id')->toArray();
            $allFin = Fin::with('user','brand')->whereHas('brand')->whereIn('id',$allFin1)->where('user_id',$finUser)->latest()->get();
        }
        if ($finBrands>0){
            $allFin1 = $allFin->pluck('id')->toArray();
            $allFin = Fin::with('user','brand')->whereHas('brand')->whereIn('id',$allFin1)->where('brand_id',$finBrands)->latest()->get();
        }

//        if ($finSection==null&&$finBrands==null&&$finUser==null){
//
//        }else{
//
//        }
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
            'filters' => $filters,
        ]);
    }
    public function show($id)
    {
        $fin=Fin::where('id',$id)->with('user','brand')->first();
        $fin->payDate = verta($fin->date)->formatJalaliDate();
        $fin->jDate = verta($fin->created_at)->formatJalaliDatetime();


//        dd($fin);
        return view('fin.show',compact('fin'));
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

        if ($role=='roleA'){
            if ($fin->section==1){
                if ($fin->state<100){
                    if ($fin->price<5000000){
                        $fin->state=101;
                    }else{
                        $fin->state=100;
                    }
                }else{
                    $fin->state=200;
                }
            }elseif ($fin->section==2){
                if ($fin->state<10) {
                    $fin->state = 10;
                }else{
                    $fin->state=200;
                }
            }elseif ($fin->section==3){
                if ($fin->state<10) {
                    $fin->state=20;
                }else{
                    $fin->state=200;
                }
            }
            if ($fin->state==10){
                $fin->state=11;
            }elseif ($fin->state==11){
                $fin->state=102;
            }elseif ($fin->state==20){
                $fin->state=21;
            }elseif ($fin->state==21){
                $fin->state=102;
            }
        }elseif ($role=='roleB'){
            if ($fin->state==10){
                $fin->state=11;
            }elseif ($fin->state==11){
                $fin->state=102;
            }elseif ($fin->state==20){
                $fin->state=21;
            }elseif ($fin->state==21){
                $fin->state=102;
            }
        }elseif ($role=='roleC'){
            $fin->state=101;
        }elseif ($role=='roleD'){
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
        $fin->date=$_GET['date'];
        $fin->section=$_GET['section'];
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
