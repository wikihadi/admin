@extends('admincore.appNoTopBar')
@section('css')
@endsection
@section('content')
    <div class="col-12 row">

        <table class="table table-bordered">
            <tr>

                {{--<td colspan="2" rowspan="2" class="text-center">--}}
                    {{--<img src="/img/logo.png" alt="" style="width: 50px">--}}
                {{--</td>--}}
                <td colspan="4" rowspan="2">
                    <h3 class="text-center">دستور پرداخت واحد طراحی</h3>

                    <p class="text-center">
                        @if($fin->section==1)
                            هزینه های تنخواه
                        @elseif($fin->section==2)
                            مربوط به بخش حسابداری

                        @elseif($fin->section==3)
                            مربوط به حسابداری تولیدی صنعتی
                        @else
                        @endif
                    </p>
                </td>


            <td class="text-left">تاریخ</td>
            <td>{{$fin->jDate}}</td>
            </tr>
            <tr>
                <td class="text-left">شماره</td>
                <td>{{$fin->id}}</td>
            </tr>
        </table>
            <table class="table table-bordered">

            <tr>
                <td class="text-left">مبلغ</td>
                <td>{{number_format($fin->price)}} ريال</td>
                <td class="text-left">در وجه</td>
                <td>{{$fin->user->name}}</td>

                <td class="text-left">توسط</td>
                <td>{{$fin->user->name}}</td>


            </tr>
            <tr>
                <td class="text-left">برند</td>
                <td>{{$fin->brand->title}}</td>
                <td class="text-left">بانک</td>
                <td>{{$fin->user->bank}}</td>
                <td class="text-left">تاریخ پرداخت</td>
                <td>{{$fin->payDate}}</td>

            </tr>
            </table>
        <table class="table table-bordered">
            <tr>
            <td class="text-left">شماره شبا</td>
            <td>
                @if($fin->user->shba!=null)
                    {{substr($fin->user->shba,0,4)}}-{{substr($fin->user->shba,4,4)}}-{{substr($fin->user->shba,8,4)}}-{{substr($fin->user->shba,12,4)}}-{{substr($fin->user->shba,16,4)}}-{{substr($fin->user->shba,20,4)}}-{{substr($fin->user->shba,24,2)}}
                @endif
            </td>
                <td class="text-left">شماره کارت</td>
                <td>
                    @if($fin->user->card!=null)
                        {{substr($fin->user->card,0,4)}}-{{substr($fin->user->card,4,4)}}-{{substr($fin->user->card,8,4)}}-{{substr($fin->user->card,12,4)}}
                    @endif
                </td>
                <td class="text-left">شماره حساب</td>
                <td>
                    {{$fin->user->bankId}}
                </td>
            </tr>
            </table>
        <table class="table table-bordered">
            <tr>
                <td class="text-left">موضوع</td>
                <td colspan="7">{{$fin->subject}}</td>
             </tr>
            <tr>
                <td class="text-left">شرح</td>

                <td colspan="7">{{$fin->content}}</td>
             </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td colspan="5" class="text-center text-sm">لذا به میزان وجه دریافتی نسبت به پرداخت کننده مسئول و در صورت عدم ارائه مستندات مبلغ دریافت شده مکلف به استرداد کل مبلغ دریافتی می باشم</td>
             </tr>

            <tr>
                <td class="text-center">امضا تایید کننده اولیه</td>
                <td class="text-center">امضا مدیر تبلیغات</td>
                <td class="text-center">امضا مدیر مالی</td>
                <td class="text-center">امضا مدیریت</td>
                <td class="text-center">امضا پرداخت کننده
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
        </table>
        @if($fin->image!=null)
        <table class="table table-bordered">
            <tr>
                <td class="text-center">
                    <img src="/storage/uploads/fin/{{$fin->image}}" alt="" class="" style="max-height: 800px;max-width: 95%">
                </td>
            </tr>
        </table>
            @else
            <br>
            .
        @endif

    </div>
@endsection
@section('JS')
@endsection
