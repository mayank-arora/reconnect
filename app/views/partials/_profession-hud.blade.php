<div class="col-md-2 hud">
	<a href="{{URL::route('users.profession', $profession->id)}}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title" style="font-size:14px;overflow:visible;padding-top:10px;">{{$profession->name}}</h3>
	</div>
	<p class="hud-text" style="font-size:56px; overflow:visible;">{{$profession->users->count()}}</p>
	{{--
	<small class="hud-user">{{$discussion->user['fname']}} {{$discussion->user['lname']}}</small>
	<small class="hud-date">{{$discussion->created_at->diffForHumans()}}</small>--}}
</div>