<template>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet"
  />

  <nav class="sidenav-container">
    <!-- Header untuk Side Navigation -->
    <div class="sidenav-header">
      <span>Donasi Luqmanul Hakim</span>
    </div>

    <ul>
      <li v-for="menu in filteredMenus" :key="menu.text">
        <router-link
          :to="menu.link"
          class="menu-link"
          active-class="active-menu"
          >{{ menu.text }}
        </router-link>
      </li>
    </ul>

    <div class="mt-auto px-3 pb-3">
      <button class="btn btn-danger w-100" @click="triggerLogout">
        Logout
      </button>
    </div>

    <div
      class="modal fade"
      id="logoutModal"
      tabindex="-1"
      aria-labelledby="logoutModalLabel"
      aria-hidden="true"
      data-bs-backdrop="false"
      data-bs-keyboard="false"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body text-center p-4">
            <i class="fas fa-exclamation-circle fa-5x text-warning"></i>
            <h5 class="mb-3 mt-2">Konfirmasi Logout</h5>
            <p>Apakah Anda yakin ingin logout?</p>
            <div class="d-flex justify-content-center mt-4">
              <button
                type="button"
                class="btn btn-secondary"
                @click="hideLogoutModal"
              >
                Tidak
              </button>
              <button
                type="button"
                class="btn btn-danger ml-5"
                @click="confirmLogout"
              >
                Ya, Logout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { Modal } from "bootstrap";

export default {
  name: "SideNav",
  data() {
    return {
      showLogoutModal: false,
      logoutModal: null,
      menus: [
        { text: "Dashboard", link: "/dashboard-page", role: "Administrator" },
        {
          text: "Transaksi Donasi",
          link: "/transaksidonasi",
          role: "Bendahara",
        },
        {
          text: "Transaksi Pengeluaran",
          link: "/pilih-kegiatan",
          role: "Bendahara",
        },
        {
          text: "Daftar Kegiatan",
          link: "/activity-list",
          role: "Pengurus Masjid",
        },
        {
          text: "Laporan Keuangan",
          link: "/laporankeuangan",
          role: "Bendahara",
        },
      ],
    };
  },
  computed: {
    filteredMenus() {
      const userRole = sessionStorage.getItem("role");
      // Jika peran adalah Administrator, tampilkan semua menu
      if (userRole === "Administrator") {
        return this.menus;
      }
      // Selain itu, filter menu berdasarkan role
      return this.menus.filter((menu) => !menu.role || menu.role === userRole);
    },
  },
  methods: {
    confirmLogout() {
      sessionStorage.clear();
      this.$router.push("/login");
      this.hideLogoutModal();
    },
    triggerLogout() {
      this.logoutModal.show();
    },
    hideLogoutModal() {
      this.logoutModal.hide();
    },
    logout() {
      sessionStorage.removeItem("isLogin");
      sessionStorage.removeItem("loginAs");
      this.$router.push("/login");
    },
  },
  mounted() {
    this.logoutModal = new Modal(document.getElementById("logoutModal"));
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

.logout-button {
  color: white;
  background-color: #dc3545; /* Warna merah */
  border: none;
  padding: 10px 15px;
  margin: 15px;
  border-radius: 5px;
  text-align: center;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Efek hover untuk tombol Logout */
.logout-button:hover {
  background-color: #c82333; /* Warna merah lebih gelap */
}

.modal-body {
  color: #000; /* Warna teks hitam */
  font-size: 16px; /* Ukuran font yang jelas */
  width: 100%;
  height: 100%;
}

.modal-content {
  background-color: #fff; /* Latar belakang putih */
  color: #000; /* Teks hitam */
  z-index: 1055; /* Pastikan berada di atas elemen lain */
  border-radius: 8px; /* Membulatkan sudut */
  padding: 10px; /* Memberikan ruang lebih */
}
</style>
