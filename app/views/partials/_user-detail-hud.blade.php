	<div class="col-md-2 col-sm-5 user-detail-hud ">
		<a href="{{URL::route('users.show', $user->id) }}"><span class="link-setter"></span></a>
		@if($user->picture == NULL)
		{{ HTML::image('img/dp.png', 'profile-picture', array('class' => 'thumbnail user-detail-display-pic' )) }}
		@else
		{{ HTML::image('uploads/'.$user->picture, 'profile-picture', array('class' => 'thumbnail user-detail-display-pic' )) }}
		@endif
		<p style="color:#337AB7;">{{$user->fname}} {{$user->lname}}</p>
		<p>{{$user->location->city}}</p>
	</div>