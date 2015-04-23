@foreach($post->comments as $comment)
<blockquote>
	<p class="comment-head"><a href="{{URL::route('users.show' , $comment->user->id)}}">{{$comment->user->fname}} {{$comment->user->lname}}</a></p>
	<p class="comment-text">{{$comment->text_content}} </p>
</blockquote>
@endforeach