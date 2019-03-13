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
                                    <div class="form-group">
                                        <textarea class="form-control" name="description" placeholder="توضیحات متریال"></textarea>
                                    </div>
                                    <input type="hidden" name="isMaterial" value="1"/>
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
                                <button type="submit" class="btn btn-primary">Add</button>
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
                                    <td>نام {{ $titleOfPage }}</td>
                                    @if(isset($material) && ($material != '-1'))

                                    <td>زیرمجموعه ها</td>
                                    @endif

                                </tr>
                                @foreach($categories->where('parent_id', 0)  as $category)


                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    @if(isset($material) && ($material != '-1'))

                                        <td>
                                            <table>
                                            @foreach($categories as $child)
                                                <tr>
                                                @if($child->parent_id == $category->id)
                                                    <td>
                                                    {{ $child->title }}
                                                    </td>
                                                @endif
                                                    </tr>
                                                @endforeach
                                            </table>


                                        </td>
@endif
                                </tr>

                                    @endforeach
                            </table>

                        </div>
                    </div>
                </div>



@endsection
