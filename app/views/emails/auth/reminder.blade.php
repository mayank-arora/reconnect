<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Hey there, {{$fname}} {{$lname}}!</h2><br><br>
	<div>
		It seems you are having trouble logging in to your Reconnect account. <br>

		If so, we have sent you a unique link so that you may change your Reconenct account's password securely. <br>

		Please click the link given below to change your credentials. <br><br>

		<a href="{{URL::route('users.password.new', $token)}}">Change your password</a><br><br>

		Link not working? You may also paste this link in your browser : <br>

		{{URL::route('users.password.new', $token)}} <br><br>

		This is an automated email. If you did not initiate the process to change your password on our website please report the issue at <a href="mailto:reconnect@bmsit.in">BMSITM Reconnect</a>.<br><br>

		Happy Reconnecting,<br>
		Team Reconnect, BMS Institute of Technology and Management <br><br>
		&copy; Reconnect, 2015
	</div>
</body>
</html>
