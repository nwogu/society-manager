<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>{{$generalData['name']}}</title>

</head>

<body>

	<h1>{{ $meeting->name }} - {{$generalData['name']}}</h1>

	<p>{!! $meeting->minute!!}</p>

</body>

</html>