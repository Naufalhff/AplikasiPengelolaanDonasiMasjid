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
        <p class="lead mb-5 mx-auto">
          Aplikasi Pengelolaan Donasi Masjid hadir untuk mempermudah para donatur
          dalam menyalurkan infaq, zakat, dan sumbangan lainnya secara digital
          dengan transparansi dan amanah.
        </p>
        <div class="row mt-4">
          <div class="col-md-4 mb-5">
            <div class="icon-box">
              <i class="fas fa-hand-holding-water fa-4x text-success mb-3"></i>
              <p class="lead mb-3 font-weight-bold">Bantu Sesama</p>
              <p class="small text-muted">Memudahkan donatur untuk membantu sesama dengan cepat dan aman.</p>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="icon-box">
              <i class="fas fa-search fa-4x text-success mb-3"></i>
              <p class="lead mb-3 font-weight-bold">Transparan</p>
              <p class="small text-muted">Setiap transaksi dapat dilihat secara transparan untuk kenyamanan donatur.</p>
            </div>
          </div>
          <div class="col-md-4 mb-5">
            <div class="icon-box">
              <i class="fas fa-mosque fa-4x text-success mb-3"></i>
              <p class="lead mb-3 font-weight-bold">Untuk Masjid</p>
              <p class="small text-muted">Mengoptimalkan pengelolaan dana untuk kebutuhan masjid dan komunitas.</p>
            </div>
          </div>
        </div>
        <button class="btn btn-success btn-lg mt-4 px-5">Lebih Lanjut</button>
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
    background-color: #f8f9fa; /* Background light grey */
    padding: 4rem 0; /* Padding pada section */
  }
  
  .about h2 {
    font-size: 2.5rem;
    font-weight: 600;
    color: #28a745; /* Warna heading */
  }
  
  .about .lead {
    font-size: 1.125rem; /* Ukuran font paragraf */
    color: #6c757d; /* Warna abu-abu untuk teks */
    max-width: 700px; /* Maksimal lebar untuk paragraf */
  }
  
  .about .icon-box {
    background-color: #fff; /* Background putih untuk box icon */
    border-radius: 15px; /* Sudut melengkung */
    padding: 2rem 1rem; /* Padding dalam box */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow lembut */
    transition: transform 0.3s ease;
  }
  
  .about .icon-box:hover {
    transform: translateY(-10px); /* Efek hover */
  }
  
  .about i {
    font-size: 4rem; /* Ukuran icon */
  }
  
  .about .btn {
    background-color: #28a745;
    border-color: #28a745;
    color: #fff;
    padding: 0.75rem 2rem;
    font-size: 1.125rem;
    border-radius: 50px; /* Membuat tombol lebih bulat */
    transition: background-color 0.3s ease;
  }
  
  .about .btn:hover {
    background-color: #218838;
  }
  </style>
  