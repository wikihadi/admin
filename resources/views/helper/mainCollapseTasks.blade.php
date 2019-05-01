<div id="collapse{{$task->id}}" class="collapse collapseTask" data-parent="#accordion">
    <div class="card-body">

        <div class="row">
            <div class="col-sm-12 col-md-4 col-xl-3 d-none d-sm-block">
                <img src="/storage/uploads/{{$task->pic}}" class="img-fluid" alt="">
            </div>
            <div class="col-sm-12 col-md-8 col-xl-3 table-responsive">

                <table class="table table-borderless table-striped table-hover text-center  " style="width: 100%;min-width: 100%">

                    <tr>
                        <td><a href="/tasks/{{$task->id}}">کد</a></td>

                        <td><a class="text-muted" href="/tasks/{{$task->id}}">{{$task->id}}</a></td>
                    </tr>


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
                    {{--<tr>--}}
                    {{--<td><span class="badge badge-info">{{$task->jStart}}</span></td>--}}

                    {{--<td><span class="badge badge-success">{{$task->jEnd}}</span>--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>تاریخ اتمام کار</td>--}}

                    {{--<td>--}}
                    {{--{{$task->jEnd}}--}}
                    {{--</td>--}}
                    {{--</tr>--}}
                    @if($task->reTask === 1)
                        <tr>
                            <td colspan="2">مشابه این کار قبلا انجام شده</td>


                        </tr>
                    @endif

                    {{--<tr>--}}
                    {{--<td></td>--}}
                    {{--<td>{{$task->commentCount}}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                    {{--<td>مشاهده</td>--}}
                    {{--<td>{{$task->viewCount}}</td>--}}
                    {{--</tr>--}}

                </table>


            </div>
            <div class="col-sm-12 col-md-12 col-xl-6">
                {{--<h1>--}}
                {{--{{ $task->title }}--}}

                {{--</h1>--}}
                @if($task->pending == 0)

                <div class="d-flex justify-content-between"><span class="badge badge-white">{{$task->jStart}}</span><span class="badge badge-white">{{$task->jEnd}}</span></div>
                <div class="progress">
                    <div data-toggle="tooltip" title="@if( $task->prog >100 )زمان مقرر این تسک پایان یافته است @elseزمان سپری شده {{$task->prog}}% @endif"  data-placement="top" class="progress-bar progress-bar-striped @if( $task->prog <= 100 ) progress-bar-animated @endif {{$progbg}}"  role="progressbar" style="width: {{ $task->prog }}%" aria-valuenow="{{ $task->prog }}" aria-valuemin="0" aria-valuemax="100"></div>

                </div>

                @endif

                {{--<div class="btn-group">--}}
                {{--@if($task->type && $task->type != "سایر") <button class="btn btn-sm btn-link"  data-toggle="tooltip" title="نوع کار"  data-placement="bottom">{{ $task->type }}</button> @endif--}}
                {{--@if($task->type && $task->brand != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="برند"  data-placement="bottom">{{ $task->brand }}</button> @endif--}}
                {{--@if($task->type && $task->forProduct != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="محصول"  data-placement="bottom">{{ $task->forProduct }}</button> @endif--}}
                {{--@if($task->type && $task->material != "سایر") <button class="btn btn-sm btn-link"   data-toggle="tooltip" title="متریال"  data-placement="bottom">{{ $task->material }}</button> @endif--}}
                {{--<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="نظر"  data-placement="bottom">{{ $task->commentCount }}</button>--}}
                {{--<button class="btn btn-sm btn-link"   data-toggle="tooltip" title="مشاهده"  data-placement="bottom">{{ $task->viewCount }}</button>--}}

                {{--@if($task->reTask === 1)--}}

                {{--<button class="btn btn-sm btn-link"  data-toggle="tooltip" title="Clone" data-placement="bottom">--}}
                {{--<i class="fa fa-clone"></i>--}}
                {{--</button>--}}
                {{--@endif--}}

                {{--</div>--}}

                <p class="text-justify pt-3">
                    {{ $task->content }}

                </p>


            </div>
            <div class="text-left col-12">
                {{--<a href="/tasks/{{$task->id}}" class="card-link">مشاهده</a>--}}
                <a href="/tasks/{{$task->id}}" class="btn btn-link"><i class="fa fa-3x fa-arrow-left"></i></a>
            </div>



        </div>
    </div>

</div>
