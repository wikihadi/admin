@if(isset($noRoles))
    <div class="position-fixed d-flex flex-column justify-content-around align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
        <i class="fa fa-user-circle fa-5x text-danger" style="font-size: 15rem"></i>
        <div class="h1 text-light">حساب کاربری شما تایید نشده است. لطفا با مدیریت تماس بگیرید</div>
    </div>
@else

    @if($user->lastStatus == 'lunch-start')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="lunch-end">
                <input type="hidden" name="content" value="برگشت به کار {{Auth::user()->name}}">
                <i class="fa fa-cutlery fa-5x text-info" style="font-size: 15rem"></i>
                <div class="Timer-lunch text-info text-lg"></div>
                <button class="btn btn-lg btn-info mt-2" type="submit">ادامه کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
    @elseif($user->lastStatus == 'off')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="on">
                <input type="hidden" name="content" value="برگشت به کار {{Auth::user()->name}}">
                <i class="fa fa-clock-o fa-5x text-info" style="font-size: 15rem"></i>
                <div class="Timer text-info text-lg"></div>
                <button class="btn btn-lg btn-info mt-2" type="submit">ادامه کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
    @elseif($user->lastStatus == 'out')
        <div class="position-fixed d-flex justify-content-center align-items-center w-100 h-100" style="z-index: 10000000000;height: 100%; background: #000000a5">
            <form  method="post" action="{{ route('status.store') }}" class="text-center text-center">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <input type="hidden" name="status" value="in">
                <input type="hidden" name="content" value="شروع کار {{Auth::user()->name}}">
                <i class="fa fa-power-off fa-5x text-secondary" style="font-size: 15rem"></i>
                <div class=" text-secondary text-lg"></div>
                <button class="btn btn-lg btn-secondary mt-2" type="submit">شروع کار <i class="fa fa-arrow-circle-left"></i></button>

            </form>
        </div>
        @else
    @endif

@endif

{{--<div class="text-muted position-fixed d-flex justify-content-center flex-row-reverse w-100" style="z-index: 10000000;top: 20px; font-weight: lighter"><div class="clockH"></div>:<div class="clockM"></div>:<div class="clockS"></div></div>--}}
