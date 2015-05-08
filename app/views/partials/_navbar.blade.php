<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#custom-navbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="{{URL::to('home')}}" class="navbar-brand">Reconnect</a>
			</div>
			<div class="collapse navbar-collapse" id="custom-navbar">
				<ul class="nav navbar-nav">
					<li><a href="{{URL::to('home')}}">Home</a></li>
					<li><a href="{{URL::to('jobs')}}">Jobs</a></li>
					<li><a href="{{URL::to('events')}}">Events</a></li>
					<li><a href="{{URL::to('search')}}">Search</a></li>
					<li><a href="{{URL::to('discussions')}}">Discussion</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle navbar-btn" type="button" id="profile-dropdown" 
						data-toggle="dropdown" aria-expanded="true">{{Auth::user()->fname}} {{Auth::user()->lname}}
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="profile-dropdown">
						<li role="presentation">{{HTML::linkRoute('users.show' , 'Profile' , array(Auth::id()),array('role' => 'menuitem' , 'tabindex' => '-1'))}}</li>
						<li role="presentation"><a href="{{URL::to('message')}}" role="menuitem" tabindex="-1">Messages</a></li>
						<li role="presentation"><a href="{{URL::to('logout')}}" role="menuitem" tabindex="-1">Logout</a></li>
					</ul>
				</div>
			</ul>
		</div>
	</div>
</nav>
