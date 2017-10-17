<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<h1>Click the link for changing your email</h1>
	<a href="{{ url('/password/changing/')."/".$uniqueid."/".Crypt::encrypt($email) }}">{{ url('/password/changing/')."/".$uniqueid."/".Crypt::encrypt($email) }}</a>
</center>
</body>
</html>