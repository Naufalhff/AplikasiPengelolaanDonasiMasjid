<!DOCTYPE html>
<html>
<head>
    <title>Kuitansi Donasi</title>
</head>
<body>
<p>Yth. {{ $nama_donatur }},</p>
<p>Terima kasih atas donasi Anda. Kami dengan senang hati memberitahukan bahwa pembayaran donasi Anda telah kami terima.</p>

<p>Berikut adalah rincian donasi Anda:</p>

<p>No. Donasi: {{ $id_donasi }}</p>
<p>Tanggal: {{ $tanggal_donasi }}</p>
<p>Untuk: {{ $nama_kegiatan }}</p>
<p>Jumlah Donasi: Rp {{ number_format($jumlah_donasi, 2, ',', '.') }}</p>

<p>Donasi Anda sangat berarti bagi kami dan akan digunakan untuk mendukung kegiatan yang bermanfaat.</p>

<p>Hormat kami,</p>
<p>DKM Luqmanul Hakim</p>
</body>
</html>
