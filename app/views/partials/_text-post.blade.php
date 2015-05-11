<div class="white-container" id="section{{$post->id}}">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-2 profile-pic">
				@if($post->user->picture == NULL)
				{{ HTML::image('img/dp.png', 'profile-picture', array('class' => 'thumbnail' , 'width' => '100px')) }}
				@else
				{{ HTML::image('uploads/'.$post->user->picture, 'profile-picture', array('class' => 'thumbnail' , 'width' => '100px')) }}
				@endif
			</div>
			<div class="col-md-10">
				<h4 class="text-primary"><a href="{{URL::route('users.show' , $post->user->id)}}">{{$post->user->fname}} {{$post->user->lname}}</a>
					{{HTML::linkAction('PostsController@show',' ',array($post->id) , 
					array('class' => 'fa fa-fw fa-arrow-right' , 'style' => 'float:right;margin-left:15px;text-decoration:none;'))}}
					<small class="post_time">
						<?php
						use Carbon\Carbon;
						$now=Carbon::now();
						$post_time=$post->created_at;
						$differenceInDays = $now->diffInDays($post_time);
						$differenceInYears = $now->diffInyears($post_time);
						?>
						@if($differenceInDays<1)
						{{$post->created_at->diffForHumans()}}
						@elseif($differenceInYears<1)
						{{$post->created_at->format('M d \a\t H:i')}}
						@else
						{{$post->created_at->format('M d, Y \a\t H:i')}}
						@endif
					</small>
				</h4>
				<p>{{$post->text_content}}</p>
			</div>
		</div>
		<hr>
		
		{{-- Deciding whether to show all the comments or not based on comments count and the activated route --}}
		@if($post->comments->count() > 2 && Route::currentRouteName() == 'home')
			@foreach($post->comments as $key=>$comment)
				@if($key == 0 || $key == 1)
				<blockquote>
					<p class="comment-head"><a href="{{URL::route('users.show' , $comment->user->id)}}">{{$comment->user->fname}} {{$comment->user->lname}}</a></p>
					<p class="comment-text">{{$comment->text_content}} </p>
				</blockquote>
				@endif
			@endforeach
			<a href="{{URL::route('posts.show', $post->id)}}">View more comments</a>
			<div class="gap"></div>
		@else
			@foreach($post->comments as $comment)
			<blockquote>
				<p class="comment-head"><a href="{{URL::route('users.show' , $comment->user->id)}}">{{$comment->user->fname}} {{$comment->user->lname}}</a></p>
				<p class="comment-text">{{$comment->text_content}} </p>
			</blockquote>
			@endforeach
		@endif

		{{Form::open(array('action' => 'CommentsController@store'))}}
		<div class="form-group">
			<input type="text" name="text_content" class="form-control">
		</div>
		<input type="hidden" name="post_id" value="{{$post->id}}">
		<div class="form-group">
			<input type="submit" value="Comment" class="btn btn-default">
		</div>
	</form>
</div>
</div>
