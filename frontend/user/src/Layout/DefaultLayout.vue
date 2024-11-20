<template>
    <div class="default-layout">
      <!-- Side Navigation -->
      <aside class="sidenav">
        <SideNav />
      </aside>
  
      <!-- Main Content -->
      <div class="main-content">
        <router-view /> <!-- Tempat untuk menampilkan halaman -->
      </div>
    </div>
  </template>
  
  <script>
  import SideNav from "@/components/SideNav.vue";
  
  export default {
    name: "DefaultLayout",
    components: {
      SideNav,
    },
  };
  </script>
  
  <style scoped>
  /* Layout utama */
  .default-layout {
    display: flex;
    height: 100vh; /* Full height of the viewport */
  }
  
  /* Style untuk Side Navigation */
  .sidenav {
    width: 250px; /* Ukuran tetap */
    min-width: 250px; /* Mencegah menyusut */
    max-width: 250px; /* Mencegah membesar */
    background-color: #343a40; /* Warna gelap */
    color: white; /* Warna teks */
    padding: 20px;
    overflow-y: auto; /* Scroll jika konten terlalu banyak */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Tambahkan shadow untuk estetik */
  }
  
  /* Style untuk Main Content */
  .main-content {
    flex-grow: 1; /* Isi sisa ruang */
    padding: 20px;
    background-color: #f8f9fa; /* Background light grey */
    overflow-y: auto; /* Scrollable jika konten terlalu panjang */
  }
  
  /* Responsivitas */
  @media (max-width: 768px) {
    .default-layout {
      flex-direction: column; /* Stack sidenav di atas main content */
    }
  
    .sidenav {
      width: 100%; /* Lebar penuh pada layar kecil */
      min-width: 0; /* Tidak ada batasan minimum */
      max-width: none; /* Tidak ada batasan maksimum */
      height: auto; /* Sesuaikan tinggi */
    }
  }
  </style>
  