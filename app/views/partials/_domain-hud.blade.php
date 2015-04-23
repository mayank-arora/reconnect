<div class="col-md-2 hud">
	<a href="{{URL::route('users.domain', $domain->id)}}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$domain->name}}</h3>
	</div>
	<p class="hud-text" style="font-size:56px; overflow:visible;">{{$domain->users->count()}}</p>
</div>