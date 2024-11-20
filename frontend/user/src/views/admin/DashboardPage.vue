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
      <div class="col-md-3">
        <div class="card bg-white">
          <div class="card-body d-flex align-items-center">
            <i class="fa fa-donate fa-2x icon-pink me-3"></i> <!-- Icon -->
            <div>
              <h5>Total Donasi</h5>
              <p class="fs-4 fw-bold mb-1">Rp. 563.745.274</p>
              <small>Total donasi berhasil terkumpul</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-white">
          <div class="card-body d-flex align-items-center">
            <i class="fa fa-hand-holding-usd fa-2x icon-info me-3"></i> <!-- Icon -->
            <div>
              <h5>Jumlah Donasi</h5>
              <p class="fs-4 fw-bold mb-1">57.084</p>
              <small>Total Donasi yang Diterima</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-white">
          <div class="card-body d-flex align-items-center">
            <i class="fa fa-user-friends fa-2x icon-warning me-3"></i> <!-- Icon -->
            <div>
              <h5>Jumlah Donatur</h5>
              <p class="fs-4 fw-bold mb-1">2.345</p>
              <small>Jumlah Donatur Aktif</small>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card bg-white">
          <div class="card-body d-flex align-items-center">
            <i class="fa fa-calendar-alt fa-2x icon-success me-3"></i> <!-- Icon -->
            <div>
              <h5>Total Kegiatan</h5>
              <p class="fs-4 fw-bold mb-1">18</p>
              <small>Jumlah Kegiatan yang Berjalan</small>
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
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Donasi Terbaru</h6>
            <RouterLink class="transaction-link" to="/transaksidonasi">
              <button class="btn btn-success btn-sm">View All</button>
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
                      'bg-warning text-white': donation.status === 'Pending',
                      'bg-success text-white': donation.status === 'Valid',
                      'bg-danger text-white': donation.status === 'Invalid'
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
  data() {
    return {
      donations: [
        { id: 1, name: "Tono", activity: "Kurban", amount: "Rp 500.000", date: "2024-11-18", status: "Pending" },
        { id: 2, name: "Andi", activity: "Banjir", amount: "Rp 1.000.000", date: "2024-11-19", status: "Valid" },
        { id: 3, name: "Siti", activity: "Pendidikan", amount: "Rp 750.000", date: "2024-11-20", status: "Invalid" },
      ],
    };
  },
  mounted() {
    this.initCharts();
  },
  methods: {
    initCharts() {
      const ctx1 = document.getElementById("incomeChart").getContext("2d");
      new Chart(ctx1, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [
            {
              label: "Income",
              data: [100, 200, 400, 300, 500, 400, 600, 500, 700],
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
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [
            {
              label: "Expenses",
              data: [150, 250, 300, 400, 350, 450, 400, 550, 600],
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

.row > .col-md-3 {
  margin-bottom: 1rem; /* Jarak antar kolom di bawah */
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
