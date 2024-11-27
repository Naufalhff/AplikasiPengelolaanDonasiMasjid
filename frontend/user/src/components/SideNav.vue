<template>
  <nav class="sidenav-container">
    <!-- Header untuk Side Navigation -->
    <div class="sidenav-header">
      <span>Donasi Luqmanul Hakim</span> 
    </div>

    <ul>
      <li 
        v-for="menu in filteredMenus" 
        :key="menu.text">
        <router-link 
          :to="menu.link" 
          class="menu-link" 
          active-class="active-menu">{{ menu.text }}
        </router-link>
      </li>
    </ul>
  </nav>
</template>

<script>
export default { 
  name: "SideNav",
  data() {
    return {
      menus: [
        { text: "Dashboard", link: "/dashboard-page", role: "Administrator" },
        { text: "Transaksi Donasi", link: "/transaksidonasi", role: "Bendahara" },
        { text: "Daftar Kegiatan", link: "/activity-list", role: "Pengurus Masjid" },
        { text: "Laporan Keuangan", link: "/laporankeuangan", role: "Bendahara" },
      ],
    };
  },
  computed: {
  filteredMenus() {
    const userRole = sessionStorage.getItem('role');
    // Jika peran adalah Administrator, tampilkan semua menu
    if (userRole === "Administrator") {
      return this.menus;
    }
    // Selain itu, filter menu berdasarkan role
    return this.menus.filter(menu => !menu.role || menu.role === userRole);
    },
  },
};
</script>


<style scoped>
/* Container untuk Side Navigation */
.sidenav-container {
  display: flex;
  flex-direction: column;
  height: 100%;
  overflow-y: auto;
  padding: 0;
  margin: 0;
}

/* Header untuk Side Navigation */
.sidenav-header {
  font-size: 18px;
  font-weight: normal;
  color: white;
  padding: 20px 10px;
  text-align: center;
  border-bottom: 1px solid #6c757d; /* Garis pembatas bawah */
}

/* Reset style untuk list */
ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

/* Style untuk setiap item menu */
li {
  margin-bottom: 10px;
}

/* Style untuk router-link */
.menu-link {
  color: white;
  text-decoration: none;
  padding: 10px;
  display: block;
  border-radius: 5px;
  transition: background-color 0.3s, padding-left 0.3s; /* Animasi smooth saat hover dan active */
}

/* Efek hover */
.menu-link:hover {
  background-color: #495057;
  padding-left: 15px; /* Menambah padding kiri saat hover */
}

/* Penanda untuk halaman aktif */
.active-menu {
  background-color: #28a745; /* Warna hijau untuk active state */
  color: white;
  font-weight: bold; /* Teks lebih tebal */
  padding-left: 15px; /* Menambah padding kiri saat aktif */
  border-left: 4px solid #28a745; /* Garis vertikal kiri dengan warna hijau */
}
</style>
