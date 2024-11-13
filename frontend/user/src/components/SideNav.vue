<template>
    <div class="sidenav">
      <!-- Logo Section -->
      <div class="sidenav-header">
        <h3>Material Dashboard 2 Laravel</h3>
      </div>
  
      <!-- Navigation Links -->
      <ul class="sidenav-menu">
        <li>
          <a href="#dashboard" class="sidenav-link">
            <i class="fas fa-home"></i>
            Dashboard
          </a>
        </li>
        <li>
          <a href="#transaksi-donasi" class="sidenav-link">
            <i class="fas fa-donate"></i>
            Transaksi Donasi
          </a>
        </li>
        <li>
          <a href="#data-pengguna" class="sidenav-link">
            <i class="fas fa-users"></i>
            Data Pengguna
          </a>
        </li>
        <li>
          <a href="#daftar-kegiatan" class="sidenav-link">
            <i class="fas fa-list"></i>
            Daftar Kegiatan
          </a>
        </li>
        <li>
          <a href="#laporan-keuangan" class="sidenav-link">
            <i class="fas fa-file-invoice-dollar"></i>
            Laporan Keuangan
          </a>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SideNav',
  };
  </script>
  
  <style scoped>
  .sidenav {
    width: 240px;
    height: 100vh;
    background-color: #f8f9fa;
    position: fixed;
    top: 0;
    left: 0;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
  }
  
  .sidenav-header {
    padding: 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1.2rem;
    color: #343a40;
    border-bottom: 1px solid #e9ecef;
  }
  
  .sidenav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex-grow: 1;
  }
  
  .sidenav-link {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    color: #495057;
    text-decoration: none;
    transition: background-color 0.2s, color 0.2s;
  }
  
  .sidenav-link:hover {
    background-color: #e9ecef;
    color: #343a40;
  }
  
  .sidenav-link i {
    margin-right: 10px;
    font-size: 1.2rem;
  }
  </style>
  