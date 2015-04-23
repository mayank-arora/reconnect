<div class="col-md-3 hud">
	<a href="{{URL::route('discussions.show', array($discussion->id))}}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title">{{$discussion->title}}</h3>
	</div>
	<p class="hud-text">{{$discussion->text_content}}</p>
	<small class="hud-user">{{$discussion->user['fname']}} {{$discussion->user['lname']}}</small>
	<small class="hud-date">{{$discussion->created_at->diffForHumans()}}</small>
</div>