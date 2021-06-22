<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Pendaftaran Intani Banten</title>
</head>
<body>
	<h2>Hai, {{ $member->name}}</h2>
    <p>Anda telah melakukan pendaftaran pada sistem Intani Banten</p>
	<p>Silahkan verifikasi email anda  <a href="{{route('member.verify', $member->activate_token)}}" class="btn btn-link p-0 m-0 align-baseline">DISINI</a> </p>
</body>
</html>