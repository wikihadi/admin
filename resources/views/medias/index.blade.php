@extends('admincore.app')


@section('content')

    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
        <div>
                         <span class="btn default btn-file">
                               <span class="fileinput-new"> Select image </span>
                                     <span class="fileinput-exists"> Change </span>
                                           <input type="file" name="..."> </span>
            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
        </div>
    </div>

@endsection