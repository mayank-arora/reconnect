<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset for {{$fname}} {{$lname}}</h2>

		<div>
			To reset your password, complete this <a href="{{URL::route('users.password.new', $token)}}">form</a>.<br/>
		</div>
	</body>
</html>
