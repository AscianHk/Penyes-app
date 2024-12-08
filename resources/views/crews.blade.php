
<ul>
@foreach ($crews as $crew)
    <li><a href="/crews/{{$crew->id}}">{{$crew->name}}</a></li>
    <p>{{$crew->slogan}}<p>
@endforeach
</ul>