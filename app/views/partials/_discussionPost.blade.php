	<div class="container">
		<div class="col-md-8">
			<div class="white-container">
				<h4 class="text-primary"><a href="{{URL::route('users.show' , $discussion->user->id)}}">{{$discussion->user->fname}} {{$discussion->user->lname}}</a>
					<small class="post_time">
						<?php
						use Carbon\Carbon;
						$now=Carbon::now();
						$post_time=$discussion->created_at;
						$differenceInDays = $now->diffInDays($post_time);
						$differenceInYears = $now->diffInyears($post_time);
						?>
						@if($differenceInDays<1)
						{{$discussion->created_at->diffForHumans()}}
						@elseif($differenceInYears<1)
						{{$discussion->created_at->format('M d \a\t H:i')}}
						@else
						{{$discussion->created_at->format('M d, Y \a\t H:i')}}
						@endif
					</small>
				</h4>
				<p>{{$discussion->text_content}}</p>

				@foreach($discussion->replies as $reply)
				<div class="row">
					<div class="col-md-8">
						<blockquote>
					<p class="comment-head"><a href="{{URL::route('users.show' , $discussion->user->id)}}">{{$reply->user['fname']}} {{$reply->user['lname']}}</a></p>
					<p class="comment-text">{{$reply->text_content}} </p>
				</blockquote>
					</div>
					<div class="col-md-4">
						<div class="reply-div">
							<a href="#" class="reply-link">Reply</a>
						</div>
					</div>
				</div>
				@endforeach


				{{Form::open(array('action' => 'RepliesController@store'))}}
				<div class="form-group">
					<input type="text" name="text_content" class="form-control">
				</div>
				<input type="hidden" name="discussion_id" value="{{$discussion->id}}">
				<div class="form-group">
					<input type="submit" value="Comment" class="btn btn-default">
				</div>
			</form>

		</div>
	</div>
</div>
