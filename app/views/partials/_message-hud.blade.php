<div class="col-md-2 hud">
	<a href="{{URL::route('message.show', $sender->sender_id)}}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{User::find($sender->sender_id)->fname}}</h3>
	</div>
{{-- 	<p class="hud-text" style="font-size:56px; overflow:visible;">{{$job->users->count()}}</p>
	<small class="hud-user">{{$job->company->name}}</small>
	<small class="hud-date">{{$job->location->city}}</small> --}}
</div>