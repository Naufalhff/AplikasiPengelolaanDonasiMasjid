<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>
<body>
    <h1>OTP Verifikasi Anda</h1>
    <p>Halo, {{ $nama_lengkap }}!</p>
<p>Gunakan kode OTP berikut untuk memverifikasi email Anda:</p>
<h2>{{ $otp }}</h2>
<p>Kode ini hanya berlaku selama 1 menit.</p>
<p>Terima kasih,</p>
<p>Tim Kami</p>
</body>
</html>
