<div id="collapse{{$task->id}}" class="collapse collapseTask">
    <div class="card-body">

        <div class="row">

            <div class="col-md-2 d-none d-md-block">
                <img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="">

            </div>

            <div class="col-lg-5 col-xl-5">
                {{--<div class="row">--}}

                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="کد کار" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-key text-muted"></i> {{ $task->id }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="{{ $task->commentCount }} نظر" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-barcode text-muted"></i> {{ $task->commentCount }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="نوع" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-comments text-muted"></i> {{ $task->type }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="نوع" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-bookmark text-muted"></i> {{ $task->type }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="برند" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-at text-muted"></i> {{ $task->brand }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="متریال" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-archive text-muted"></i> {{ $task->material }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="طول" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-arrows-alt-h text-muted"></i> {{ $task->dx }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="عرض" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-archive text-muted"></i> {{ $task->dy }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-4 hvr-underline-from-center p-3">--}}
                        {{--<div class="text-center" title="ارتفاع" data-toggle="tooltip" data-placement="bottom">--}}
                            {{--<i class="fa fa-archive text-muted"></i> {{ $task->dz }}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}


                <table class="table table-bordered table-responsive table-hover text-center  " style="width: 100%;min-width: 100%">




                    <tr class="d-md-none">
                        <td>نوع</td>
                        <td>{{$task->type}}</td>
                    </tr>
                    <tr class="d-md-none">
                        <td>برند</td>
                        <td>{{$task->brand}}</td>
                    </tr>
                    <tr class="d-md-none">
                        <td>برای</td>
                        <td>{{$task->forProduct}}</td>
                    </tr>
                    @if($task->dx || $task->dy || $task->dz || $task->dDesc)

                        <tr>
                            <td>در قطع</td>
                            <td><span title="عرض">{{$task->dx}}</span>-<span title="طول">{{$task->dy}}</span>-<span title="عمق">{{$task->dz}}</span>-<span title="واحد">{{$task->dDesc}}</span>
                            </td>
                        </tr>
                    @endif
                    @if($task->material)

                        <tr>
                            <td>متریال</td>
                            <td>{{$task->material}}
                            </td>
                        </tr>
                    @endif
                    <tr class="d-md-none">
                        <td>مهلت باقیمانده</td>

                        <td>
                            {{$task->diffDead}}
                        </td>
                    </tr>


                    @if($task->reTask === 1)
                        <tr>
                            <td colspan="2">مشابه این کار قبلا انجام شده</td>


                        </tr>
                    @endif
                    <tr>
                        <td colspan="2">
                            <span class="badge badge-secondary" title="شروع کار">{{$task->jStart}}</span>
                            <i class="fa fa-arrow-left"></i>
                            <span class="badge badge-success" title="ددلاین کار">{{$task->jEnd}}</span>
                        </td>


</tr>

                </table>

                <div class="btn-group text-center">
                    @if($task->type && $task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $task->type }}</button> @endif
                    @if($task->type && $task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $task->brand }}</button> @endif
                    @if($task->type && $task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $task->forProduct }}</button> @endif
                    @if($task->type && $task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $task->material }}</button> @endif
                    <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $task->commentCount }}</button>

                    @if($task->reTask === 1)

                        <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">
                            <i class="fa fa-clone"></i>
                        </button>
                    @endif

                </div>

            </div>


            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5">
              @include('statuses.taskStatus')

            </div>


            <div class="col-sm-12 col-md-12 col-xl-12">

                @if($task->pending == 0)

                <div class="d-flex justify-content-between"><span class="badge badge-white">{{$task->jStart}}</span><span class="badge badge-white">{{$task->jEnd}}</span></div>
                <div class="progress">
                    <div data-toggle="tooltip" title="@if( $task->prog >100 )زمان مقرر این تسک پایان یافته است @elseزمان سپری شده {{$task->prog}}% @endif"  data-placement="top" class="progress-bar progress-bar-striped @if( $task->prog <= 100 ) progress-bar-animated @endif {{$progbg}}"  role="progressbar" style="width: {{ $task->prog }}%" aria-valuenow="{{ $task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>

                </div>

                @endif






            </div>

            <div class="text-left col-12">

                    <hr>
                @include('statuses.stopTaskForm')

                <a href="/tasks/{{$task->id}}" class="btn btn-link d-sm-none"><i class="fa fa-3x fa-arrow-left"></i></a>
            </div>



        </div>
    </div>

</div>
