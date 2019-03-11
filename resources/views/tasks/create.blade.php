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
                            <div class="form-group">
                                @csrf
                                <input type="text" class="form-control" name="title" placeholder="عنوان کامل کار"/>
                            </div>
                            <div class="form-group">

                                <input type="text" id="input1" class="form-control"  name="deadline"/>
                                {{--<input type="text" class="pdate form-control"  name="deadline"/>--}}
                                {{--<input type="date"  class="form-control" name="deadline"/>--}}
                            </div>

                            <div class="form-group">
                                <label for="">دسته والد</label>
                                <select name="categories[]" class="form-control">
                                    <option value="0">بدون دسته</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>

                                    @endforeach


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="">تیم کاری</label>
                                <select name="users[]" class="form-control" multiple>
                                    <option value="0">فقط خودم</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>

                                    @endforeach


                                </select>

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
