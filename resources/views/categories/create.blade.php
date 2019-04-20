@extends('admincore.app')

@section('content')
    @php
    $titleOfPage = 'دسته';
    @endphp
    @if(isset($material) && ($material == '-1'))
        @php
        $titleOfPage = 'متریال';
        @endphp
    @endif
    @if(isset($dimen) && ($dimen == '-1'))
        @php
        $titleOfPage = 'قطع کار';
        @endphp
    @endif
    @if(isset($type) && ($type == '-1'))
        @php
        $titleOfPage = 'نوع کار';
        @endphp
    @endif
                <div class="col-md-8 m-auto">

                    <button data-toggle="collapse" data-target="#addcat" class="btn btn-link"><i class="fa fa-plus"></i></button>
                    <div class="card uper collapse" id="addcat">
                        <div class="card-header">
                            افزودن {{ $titleOfPage }}
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div><br />
                            @endif
                            <form method="post" action="{{ route('categories.store') }}">
                                <div class="form-group">
                                    @csrf
                                    <input type="text" class="form-control" name="title" placeholder="نام {{ $titleOfPage }}"/>
                                </div>
                                @if(isset($material) && ($material == '-1'))
                                    {{--<div class="form-group">--}}
                                        {{--<textarea class="form-control" name="description" placeholder="توضیحات {{ $titleOfPage }}"></textarea>--}}
                                    {{--</div>--}}
                                    <input type="hidden"
                                            @if(isset($dimen) && ($dimen == '-1'))
                                            name="isDimension"
                                            @elseif(isset($type) && ($type == '-1'))
                                           name="isType"
                                           @else
                                           name="isMaterial"

                                            @endif
value="1"/>
                                    <input type="hidden" name="parent_id" value="-1"/>

                                    @else
                                    <div class="form-group">
                                        <label for="">دسته والد</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="0">دسته اصلی</option>
                                            @foreach($categories->where('parent_id', 0) as $category)
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>

                                            @endforeach


                                        </select>

                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary btn-block">Add</button>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="col-md-8 m-auto">
                    <div class="card uper">
                        <div class="card-header">
                            {{ $titleOfPage }} ها
                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <tr>

                                    <td>کد</td>
                                    <td colspan="2">نام {{ $titleOfPage }}</td>

                                    {{--<td>توضیحات</td>--}}
                                    {{--@if(isset($material) && ($material != '-1'))--}}

                                    {{--<td>زیرمجموعه ها</td>--}}
                                    {{--@endif--}}

                                </tr>
                                @foreach($categories->where('parent_id', -1)  as $category)


                                <tr>
                                    <td>


                                        {{ $category->id }}

                                    </td>
                                    <td>{{ $category->title }}

                                    </td>
                                    <td>
                                        <div class="dropdown position-absolute">
                                            <button class="btn btn-link text-muted" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></button>
                                            <ul class="dropdown-menu">
                                                <li><a class="btn btn-link text-warning" href="{{ route('categories.edit',$category->id) }}">ویرایش </a></li>
                                                <li> {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
                                                    {!! Form::submit('حذف ', ['class' => 'btn btn-link text-danger']) !!}
                                                    {!! Form::close() !!}</li>
                                            </ul>
                                        </div>
                                    </td>
{{--                                    <td>{{ $category->description }}</td>--}}
                                    {{--@if(isset($material) && ($material != '-1'))--}}

                                        {{--<td>--}}
                                            {{--<table>--}}
                                            {{--@foreach($categories as $child)--}}
                                                {{--<tr>--}}
                                                {{--@if($child->parent_id == $category->id)--}}
                                                    {{--<td>--}}
                                                    {{--{{ $child->title }}--}}
                                                    {{--</td>--}}
                                                {{--@endif--}}
                                                    {{--</tr>--}}
                                                {{--@endforeach--}}
                                            {{--</table>--}}


                                        {{--</td>--}}
{{--@endif--}}
                                </tr>

                                    @endforeach
                            </table>

                        </div>
                    </div>
                </div>



@endsection
