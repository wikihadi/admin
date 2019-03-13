@extends('admincore.app')

@section('content')

            <div class="col-md-8 m-auto">
                <div class="card uper">
                    <div class="card-header">
                        ثبت کار جدید
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
                        <form method="post" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="row">
                            <div class="form-group col-sm-6">
<label for="title">عنوان</label>
                                <input type="text" class="form-control" name="title" placeholder="عنوان کامل کار"/>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="deadline">ددلاین</label>

                                <input type="text" id="pdp-data-jdate" class="form-control"  name="deadline1" autocomplete="off"/>
                                <input type="hidden" id="sendDead" name="deadline" value=""/>
                                {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                                {{--<input type="date"  class="form-control" name="deadline"/>--}}
                            </div>
                    </div>
                            <div class="form-group">
                                <label for="">برند</label>
                                <select name="brands[]" class="form-control select2">
                                    <option  selected="selected" value="0">بدون برند</option>
                                    @foreach($brands as $u)
                                        <option value="{{ $u->id }}">{{ $u->title }}</option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">تیم کاری</label>
                                <select name="users[]" class="form-control select2" multiple>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="">موضوع اصلی</label>
                                <select name="categories[]" class="form-control select2">
                                    <option value="0">بدون موضوع</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="form-group col-6">
                                <label for="">زیر دسته</label>
                                <select name="categories[]" class="form-control select2">
                                    @foreach($childCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>

                                    @endforeach


                                </select>

                            </div>
                            </div>
                            <div class="form-group">

                            <textarea class="form-control" name="content" placeholder="توضیحات کاری که باید انجام شود"></textarea>

                            </div>
                            <button type="submit" class="btn btn-primary">بفرست به لیست</button>
                        </form>
                    </div>
                </div>


            </div>


@endsection
