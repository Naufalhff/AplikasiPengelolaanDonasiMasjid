<template>
<head>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
</head>
    <section class="about py-5 text-center">
      <div class="container">
        <h2 class="text-success mb-4">Sekilas Tentang Kami</h2>
        <p class="lead mb-5">
          Aplikasi Pengelolaan Donasi Masjid hadir untuk mempermudah para donatur
          dalam menyalurkan infaq, zakat, dan sumbangan lainnya secara digital
          dengan transparansi dan amanah.
        </p>
        <div class="row mt-4">
          <div class="col-md-4 mb-4 mt-4">
            <i class="fas fa-hand-holding-water fa-7x text-success mb-3"></i>
            <p class="lead mb-3">Bantu Sesama</p>
          </div>
          <div class="col-md-4 mb-4 mt-4">
            <i class="fas fa-search fa-7x text-success mb-3"></i>
            <p class="lead mb-3">Transparan</p>
          </div>
          <div class="col-md-4 mb-4 mt-4">
            <i class="fas fa-mosque fa-7x text-success mb-3"></i>
            <p class="lead mb-3">Untuk Masjid</p>
          </div>
        </div>
        <button class="btn btn-success mt-3">Lebih Lanjut</button>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "AboutSection",
  };
  </script>
  
  <style scoped>
  .about {
    padding: 60px 0; /* Menambah padding di sekitar section */
    margin-bottom: 70px;
    margin-top: 70px;
  }
  .about h2 {
    margin-bottom: 3rem; /* Jarak bawah heading */
  }
  .about .lead {
    margin-bottom: 3rem; /* Jarak bawah paragraf */
    padding: 40px;
  }
  .about i {
    margin-bottom: 1.5rem; /* Jarak bawah icon */
  }
  .about .row .col-md-4 {
    margin-bottom: 3rem; /* Jarak antara kolom */
  }
  .about .btn {
    padding: 10px 20px; /* Padding tombol */
    font-size: 1rem; /* Ukuran font tombol */
  }
  </style>
  