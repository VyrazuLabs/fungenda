<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<h1>Click the link for changing your email</h1>
	<a href="{{ url('/password/changing/')."/".Crypt::encrypt($email) }}">http://localhost/vyrazu/efungenda/laravel/public/password/changing/{{ $email }}</a>
</center>
</body>
</html>