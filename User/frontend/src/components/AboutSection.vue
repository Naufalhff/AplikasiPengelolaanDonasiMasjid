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
          <div class="col-md-4 mb-4">
            <i class="fas fa-hand-holding-water fa-5x text-success mb-3"></i>
            <p class="lead">Bantu Sesama</p>
          </div>
          <div class="col-md-4 mb-4">
            <i class="fas fa-search fa-5x text-success mb-3"></i>
            <p class="lead">Transparan</p>
          </div>
          <div class="col-md-4 mb-4">
            <i class="fas fa-mosque fa-5x text-success mb-3"></i>
            <p class="lead">Untuk Masjid</p>
          </div>
        </div>
        <button class="btn btn-success mt-4">Lebih Lanjut</button>
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
  }
  .about h2 {
    margin-bottom: 2rem; /* Jarak bawah heading */
  }
  .about .lead {
    margin-bottom: 2.5rem; /* Jarak bawah paragraf */
    padding: 20px;
  }
  .about i {
    margin-bottom: 1.5rem; /* Jarak bawah icon */
  }
  .about .row .col-md-4 {
    margin-bottom: 3rem; /* Jarak antara kolom */
  }
  .about .btn {
    padding: 10px 20px; /* Padding tombol */
    font-size: 1.2rem; /* Ukuran font tombol */
  }
  </style>
  