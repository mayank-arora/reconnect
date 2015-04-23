<?php $curr_userid = Auth::id();?>

@if($user->id==$curr_userid)
<span style="font-size:20px;">
	<a href="{{URL::route('users.edit', array($curr_userid))}}" >
		<span id="editPen"class="fa fa-pencil grey-text edit-pen"></span>
	</a>
</span>
@endif