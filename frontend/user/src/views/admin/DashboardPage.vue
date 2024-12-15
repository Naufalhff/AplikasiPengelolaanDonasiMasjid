<template>
  <head>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <div class="container-fluid py-4">
    <!-- Top Row: Summary Cards -->
    <div class="row">
      <!-- Ulangi kode kartu sesuai kebutuhan -->
      <div class="col-md-3" v-for="(card, index) in summaryCards" :key="index">
        <div class="card bg-white">
          <div class="card-body d-flex align-items-center">
            <i
              :class="card.icon + ' fa-2x me-3'"
              :style="{ color: card.color }"
            ></i>
            <div>
              <h5>{{ card.title }}</h5>
              <p class="fs-4 fw-bold mb-1">{{ card.value }}</p>
              <small>{{ card.description }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h6>Pemasukan</h6>
          </div>
          <div class="card-body">
            <canvas id="incomeChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <h6>Pengeluaran</h6>
          </div>
          <div class="card-body">
            <canvas id="expenseChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Donations Section -->
    <div class="row mt-4">
      <div class="col">
        <div class="card">
          <div
            class="card-header d-flex justify-content-between align-items-center"
          >
            <h6>Donasi Terbaru</h6>
            <RouterLink to="/transaksidonasi">
              <button class="btn btn-success btn-sm">Lihat Semua</button>
            </RouterLink>
          </div>
          <div class="table-responsive">
            <table class="table modern-table">
              <thead>
                <tr>
                  <th class="text-center">Nama Donatur</th>
                  <th class="text-center">Kegiatan</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Tanggal</th>
                  <th class="text-center">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="donation in donations" :key="donation.id">
                  <td class="text-center">{{ donation.name }}</td>
                  <td class="text-center">{{ donation.activity }}</td>
                  <td class="text-center">{{ donation.amount }}</td>
                  <td class="text-center">{{ donation.date }}</td>
                  <td class="text-center">
                    <span
                      class="badge"
                      :class="{
                        'bg-warning text-white': donation.status === 'PENDING',
                        'bg-success text-white': donation.status === 'VALID',
                        'bg-danger text-white': donation.status === 'INVALID',
                      }"
                    >
                      {{ donation.status }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Backup Button -->
    <div class="text-end mt-4">
      <button class="btn btn-success">
        <i class="fa fa-database me-2"></i> Backup Data
      </button>
    </div>
  </div>
  <!-- </div> -->
</template>

<script>
import {
  Chart,
  LineController,
  LineElement,
  PointElement,
  LinearScale,
  CategoryScale,
  Title,
  Tooltip,
  Legend,
} from "chart.js";

import axios from "axios";

Chart.register(
  LineController,
  LineElement,
  PointElement,
  LinearScale,
  CategoryScale,
  Title,
  Tooltip,
  Legend
);

export default {
  name: "Dashboard-page",
  data() {
    return {
      summaryCards: [
        {
          title: "Total Donasi",
          value: "Rp. 0,00",
          description: "Total donasi berhasil terkumpul",
          icon: "fa fa-donate",
          color: "#f06292",
        },
        {
          title: "Jumlah Donasi",
          value: "0",
          description: "Total Donasi yang Diterima",
          icon: "fa fa-hand-holding-usd",
          color: "#29b6f6",
        },
        {
          title: "Jumlah Donatur",
          value: "0",
          description: "Jumlah Donatur Aktif",
          icon: "fa fa-user-friends",
          color: "#fbc02d",
        },
        {
          title: "Total Kegiatan",
          value: "0",
          description: "Jumlah Kegiatan yang Berjalan",
          icon: "fa fa-calendar-alt",
          color: "#66bb6a",
        },
      ],
      donations: [
        {
          id: 1,
          name: "Unknown",
          activity: "Unknown",
          amount: "Rp 0,00",
          date: "0000-00-00",
          status: "Pending",
        },
        {
          id: 2,
          name: "Unknown",
          activity: "Unknown",
          amount: "Rp 0,00",
          date: "0000-00-00",
          status: "Pending",
        },
        {
          id: 3,
          name: "Unknown",
          activity: "Unknown",
          amount: "Rp 0,00",
          date: "0000-00-00",
          status: "Pending",
        },
      ],
    };
  },
  mounted() {
    this.initCharts();
    this.fetchTotalDonations();
    this.fetchCountDonations();
    this.fetchCountDonatur();
    this.fetchCountEvent();
    this.fetchRecentDonations();
  },
  methods: {
    initCharts() {
      axios
        .get("http://localhost:8000/api/informasi-statistik")
        .then((response) => {
          const data = response.data;

          const donasiLabels = data.donasi_per_bulan.map((item) => item.bulan);
          const donasiData = data.donasi_per_bulan.map(
            (item) => item.total_donasi
          );

          const pengeluaranLabels = data.pengeluaran_per_bulan.map(
            (item) => item.bulan
          );
          const pengeluaranData = data.pengeluaran_per_bulan.map(
            (item) => item.total_pengeluaran
          );

          const ctx1 = document.getElementById("incomeChart").getContext("2d");
          new Chart(ctx1, {
            type: "line",
            data: {
              labels: donasiLabels,
              datasets: [
                {
                  label: "Donasi",
                  data: donasiData,
                  borderColor: "#4caf50",
                  backgroundColor: "rgba(76, 175, 80, 0.2)",
                  fill: true,
                },
              ],
            },
            options: {
              responsive: true,
            },
          });

          const ctx2 = document.getElementById("expenseChart").getContext("2d");
          new Chart(ctx2, {
            type: "line",
            data: {
              labels: pengeluaranLabels,
              datasets: [
                {
                  label: "Pengeluaran",
                  data: pengeluaranData,
                  borderColor: "#f44336",
                  backgroundColor: "rgba(244, 67, 54, 0.2)",
                  fill: true,
                },
              ],
            },
            options: {
              responsive: true,
            },
          });
        })
        .catch((error) => {
          console.error("Error fetching statistics data:", error);
        });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchTotalDonations() {
      axios
        .get("http://localhost:8000/api/total-donasi")
        .then((response) => {
          const total = response.data.total_donations;
          this.summaryCards[0].value = this.formatCurrency(total);
        })
        .catch((error) => {
          console.error("There was an error fetching total donations:", error);
        });
    },
    fetchCountDonations() {
      axios
        .get("http://localhost:8000/api/jumlah-donasi")
        .then((response) => {
          this.summaryCards[1].value = response.data.counts;
        })
        .catch((error) => {
          console.error("There was an error fetching count donations:", error);
        });
    },
    fetchCountDonatur() {
      axios
        .get("http://localhost:8000/api/jumlah-donatur")
        .then((response) => {
          this.summaryCards[2].value = response.data.donatur;
        })
        .catch((error) => {
          console.error("There was an error fetching count donatur:", error);
        });
    },
    fetchCountEvent() {
      axios
        .get("http://localhost:8000/api/jumlah-kegiatan")
        .then((response) => {
          this.summaryCards[3].value = response.data.kegiatan;
        })
        .catch((error) => {
          console.error("There was an error fetching count donatur:", error);
        });
    },
    fetchRecentDonations() {
      axios
        .get("http://localhost:8000/api/donasi-terakhir")
        .then((response) => {
          this.donations = response.data.map((donation) => ({
            id: donation.id_donasi,
            name: donation.nama_donatur || "Unknown",
            activity: donation.nama_kegiatan || "Unknown",
            amount: this.formatCurrency(donation.jumlah_donasi || 0),
            date: this.formatDate(donation.tanggal_donasi || "0000-00-00"),
            status: donation.status_verifikasi || "Pending",
          }));
        })
        .catch((error) => {
          console.error("Error fetching recent donations:", error);
        });
    },
    formatDate(dateString) {
      if (!dateString || dateString === "0000-00-00") return "N/A";
      const date = new Date(dateString);
      return new Intl.DateTimeFormat("id-ID", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
      }).format(date);
    },
  },
};
</script>

<style scoped>
.card {
  border-radius: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  background-color: #ffffff;
}

.card-body {
  display: flex;
  align-items: center; /* Pusatkan secara vertikal */
  gap: 1rem; /* Jarak horizontal antara ikon dan teks */
  padding: 1.25rem; /* Memberikan padding yang cukup untuk ruang */
}

.card-body i {
  flex-shrink: 0; /* Pastikan ikon tidak mengecil */
  /* Ikuti warna dari kelas ikon (e.g., .icon-pink) */
}

.card-body div {
  flex-grow: 1; /* Agar teks menempati ruang yang tersisa */
}

.card h5 {
  margin: 0 0 0.25rem 0; /* Margin bawah kecil untuk jarak antara heading dan teks lainnya */
  font-size: 1.1rem;
  font-weight: 600;
  color: #333;
}

.card p {
  margin: 0 0 0.2rem 0; /* Margin bawah kecil untuk memisahkan teks */
  font-size: 1.3rem;
  font-weight: 700;
  color: #000;
}

.card small {
  color: #777;
  font-size: 0.85rem;
}

.icon-pink {
  color: #f06292;
}

.icon-info {
  color: #29b6f6;
}

.icon-warning {
  color: #fbc02d;
}

.icon-success {
  color: #66bb6a;
}

/* Atur ukuran tetap dan styling hanya untuk kartu summary di Top Row */
.row > .col-md-3 .card {
  height: 150px; /* Tinggi tetap untuk konsistensi */
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  border-radius: 10px;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.row > .col-md-3 .card-body {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.row > .col-md-3 .card-body h5 {
  font-size: 1rem;
  margin: 0;
  color: #333;
  font-weight: 600;
}

.row > .col-md-3 .card-body p {
  font-size: 1.2rem;
  font-weight: 700;
  margin: 0;
  color: #000;
}

.row > .col-md-3 .card-body small {
  color: #777;
  font-size: 0.85rem;
}

/* Responsivitas untuk layar kecil */
@media (max-width: 768px) {
  .row > .col-md-3 .card {
    height: auto; /* Sesuaikan tinggi pada layar kecil */
  }
  .row > .col-md-3 .card-body {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
  }
}

@media (max-width: 768px) {
  .card-body {
    flex-direction: column; /* Stack ikon dan teks untuk layar kecil */
    align-items: flex-start; /* Teks rata kiri */
    gap: 0.75rem; /* Kurangi jarak pada layar kecil */
  }
}

.bg-white {
  background-color: #ffffff !important;
}

.icon-pink {
  color: #f06292;
}

.icon-info {
  color: #29b6f6;
}

.icon-warning {
  color: #fbc02d;
}

.icon-success {
  color: #66bb6a;
}

.table.modern-table thead th {
  border-bottom: 2px solid #e2e8f0; /* Pertegas border bawah header */
  color: #1f2937; /* Warna teks gelap */
  font-size: 0.9rem; /* Sedikit lebih kecil */
}

.table.modern-table tbody tr {
  transition: background-color 0.3s ease; /* Efek hover lebih halus */
}

.table.modern-table tbody tr:hover {
  background-color: #e8f5e9; /* Warna hover lembut */
}

.badge {
  border-radius: 8px; /* Membuat badge lebih bulat */
  padding: 0.4em 0.8em;
  font-size: 0.75rem;
}

.badge.bg-warning.text-white {
  background-color: #ffc107;
  color: #212529;
}

.badge.bg-success.text-white {
  background-color: #28a745;
  color: #fff;
}

.badge.bg-danger.text-white {
  background-color: #dc3545;
  color: #fff;
}

.table-responsive {
  overflow-x: auto; /* Responsivitas untuk tabel */
}

.table-responsive .table {
  min-width: 800px; /* Pastikan tabel tidak terlalu kecil */
}

.badge {
  border-radius: 5px;
  padding: 0.4em 0.6em;
  font-size: 0.85rem;
}

.btn-success {
  background-color: #4caf50;
  border: none;
}

.btn-success:hover {
  background-color: #43a047;
}
</style>
