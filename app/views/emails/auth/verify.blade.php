<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>Welcome to Reconnect, {{$fname}} {{$lname}}!</h2><br><br>
	<div>
		Thank you for signing up for BMSITM Reconnect, an interaction platform especially curated for the BMS Institute of Technology and Management alumni, students and faculty members. <br>

		Before you can get started, we need you to verify your email address by clicking the link below. <br><br>

		<a href="{{URL::route('users.verify', $token)}}">Verify your email</a> <br><br>

		Link not working? You may also paste this link in your browser : <br>

		{{URL::route('users.verify', $token)}} <br><br>

		This is an automated email. If you did not register on our website, please ignore this message. In case of subsequent emails please report the issue at <a href="mailto:reconnect@bmsit.in">BMSITM Reconnect</a>.<br><br>

		Happy Reconnecting,<br>
		Team Reconnect, BMS Institute of Technology and Management <br><br>
		&copy; Reconnect, 2015
	</div>
</body>
</html>
