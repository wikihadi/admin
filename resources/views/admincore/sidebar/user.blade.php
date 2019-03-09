<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <a href="/profile" class="d-block">
            <img style="object-fit: cover; height: 2rem; width: 2rem;" class="  img-circle" src="/storage/avatars/{{ Auth::user()->avatar }}" />


        </a>
    </div>
    <div class="info">
        <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
    </div>
</div>