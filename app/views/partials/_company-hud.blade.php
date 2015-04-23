@if($company->jobs->count()!=0)
<div class="col-md-2 hud">
	<a href="{{URL::route('company.jobs', $company->id) }}"><span class="link-setter"></span></a>
	<div style="text-align:center;">
		<h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$company->name}}</h3>
	</div>
	<p class="hud-text" style="font-size:56px; overflow:visible;">{{$company->jobs->count()}}</p>
</div>
@endif