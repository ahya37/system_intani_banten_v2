<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Melakukan Survei</title>
    <style>
        .button {
        background-color: #0e7d7d;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        text-decoration: none
        }
    </style>
</head>
<body>
    <p>Pengajuan melakukan survei:</p>
    <table border="0">
        <tr>
            <td>Nama</td><td>:</td><td>{{ $member->name }}</td>
        </tr>
         <tr>
            <td>Profesi</td><td>:</td><td>{{ $member->profession->name }}</td>
        </tr>
         <tr>
            <td>Alamat</td><td>:</td><td>Ds. {{ $member->village->name }}, Kec.{{ $member->village->district->name }}, {{  $member->village->district->regency->name  }},{{  $member->village->district->regency->province->name  }}</td>
        </tr>
    </table>
    <p>Silahkan setujui</p>  
    <a href="{{ route('succes-aprove-submission', $member->code) }}" class="button" style="color: white">DISINI</a>
</body>
</html>