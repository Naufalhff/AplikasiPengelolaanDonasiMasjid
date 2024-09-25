<template>
    <section class="hero-section">
      <div class="overlay"></div>
      <div class="content">
        <h1>Ulurkan Tangan, Ringankan Beban</h1>
        <p>
          Melalui Donasi Anda, Kita Bersama Menghadirkan Kebaikan untuk Sesama. Setiap kontribusi yang Anda berikan membantu mereka yang membutuhkan dan turut membangun masyarakat yang lebih kuat dan peduli.
        </p>
      </div>
    </section>
  </template>
  
  <style scoped>
  .hero-section {
    position: relative;
    height: 100vh;
    background-image: url('../assets/images/mesjid.jpg'); /* Gambar Hero */
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
  }
  
  .hero-section .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Overlay dengan transparansi */
    
    /* Masking dengan gradient */
    mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0));
  }
  
  .hero-section .content {
    position: relative;
    z-index: 2; /* Pastikan konten berada di atas overlay */
    text-align: center;
    max-width: 800px;
  }
  
  h1 {
    font-size: 3rem;
    font-weight: bold;
  }
  
  p {
    font-size: 1.25rem;
    margin-top: 1rem;
  }
  </style>
  