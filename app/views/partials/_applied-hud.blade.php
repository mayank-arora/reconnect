<div class="col-md-2 hud">
	<a href="{{URL::route('jobs.show', $job->id)}}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$job->designation}}</h3>
	</div>
	<small class="hud-user">{{$job->company->name}}</small>
	<small class="hud-date">{{$job->location->city}}</small>
</div>