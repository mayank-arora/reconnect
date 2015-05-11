<div class="profile-data-element-container">
	<div class="profile-data-element-year">
		{{$data->year}}
	</div>
	<div class="profile-data-element-description">
		{{$data->description}}
	</div>
	@if($user->id == Auth::id())
	<a href="{{URL::route('users.delete.data', $key)}}" class="profile-data-element-edit fa fa-close"></a>
	@endif
</div>