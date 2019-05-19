<div class="col-sm-12">
    <div class="m-0 m-sm-3 p-0 p-sm-5 bg-white collapse profile" style="border-radius: 30px;">
        <div class="row ">
            <div class="col-lg-4 col-sm-6 row d-none d-xl-block">
                <div class="col-sm">
                    <center> <img style="object-fit: cover; height: 10rem; width: 10rem;" class="profile-user-img img-fluid img-circle" src="/storage/avatars/{{$user->avatar}}" alt="User profile picture">
                    </center></div>
                <div class="col-sm text-center h4 mt-2">{{$user->name}}
                    <hr>
                    {{$user->experience}}
                </div>
            </div>
            <div class="col-sm-6 col-lg-8 text-left ">
                تعداد تسکها: {{count($order)}}
            </div>
        </div>
    </div>
</div>