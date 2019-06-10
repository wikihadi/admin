<a href="{{route('status.show',$notification->data['status']['id'])}}">
    {{$notification->data['user']['name']}} in {{$notification->data['status']['content']}}
</a>
