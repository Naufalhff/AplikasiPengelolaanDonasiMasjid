<template>
  <div class="container mt-4">
    <!-- Top Statistics -->
    <div class="statistics-card p-4 mb-4">
      <div class="row">
        <!-- Total Donations -->
        <div class="col-lg-6 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Total Donasi</h5>
            <h4 class="text-dark">
              {{ formatCurrency(this.donasi) }}
            </h4>
          </div>
        </div>
        <!-- Total Transactions -->
        <div class="col-lg-6 mb-3">
          <div class="card shadow-sm p-4 stat-card">
            <h5>Total Transaksi</h5>
            <h4 class="text-dark">{{ this.data.length }}</h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-card p-3 mb-4">
      <div class="row">
        <div class="col-md-3">
          <select class="form-control" v-model="selectedDonationType">
            <option value="">Metode Pembayaran</option>
            <option value="BSI">BSI</option>
            <option value="QRIS">QRIS</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" v-model="selectedYear">
            <option value="">Pilih Tahun</option>
            <option v-for="year in years" :key="year" :value="year">
              {{ year }}
            </option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" v-model="selectedMonth">
            <option value="">Pilih Bulan</option>
            <option
              v-for="(month, index) in months"
              :key="index"
              :value="index + 1"
            >
              {{ month }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <!-- Donation Table -->
    <div class="table-card p-4">
      <h5 class="text-center mb-3">Donatur</h5>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Metode Pembayaran</th>
            <th>Tanggal Donasi</th>
            <th>Jumlah</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(data, index) in paginatedDonations" :key="index">
            <td>{{ index + 1 + (currentPage - 1) * DataperPage }}</td>
            <td>{{ data.nama_donatur }}</td>
            <td>{{ data.metode_pembayaran }}</td>
            <td>{{ formatDate(data.tanggal_donasi) }}</td>
            <td>{{ formatCurrency(data.jumlah_donasi) }}</td>
          </tr>
        </tbody>
      </table>
      <div class="pagination-controls text-center mt-3">
        <button
          class="pagination-btn previous"
          :disabled="currentPage === 1"
          @click="currentPage--"
        >
          Previous
        </button>
        <span class="pagination-text"
          >Page {{ currentPage }} of {{ totalPages }}</span
        >
        <button
          class="pagination-btn next"
          :disabled="currentPage === totalPages"
          @click="currentPage++"
        >
          Next
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LaporanKeuangan",
  data() {
    return {
      selectedDonationType: "",
      selectedYear: "",
      selectedMonth: "",
      data: [],
      years: Array.from({ length: 2080 - 2024 + 1 }, (_, i) => 2024 + i),
      months: [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ],
      donasi: [],
      currentPage: 1,
      DataperPage: 10, // Menentukan jumlah data yang ditampilkan per halaman
    };
  },
  computed: {
    filteredDonations() {
      return this.data.filter((donasi) => {
        const [year, month] = donasi.tanggal_donasi.split("-").map(Number);
        return (
          (!this.selectedDonationType ||
            donasi.metode_pembayaran === this.selectedDonationType) &&
          (!this.selectedYear || year === Number(this.selectedYear)) &&
          (!this.selectedMonth || month === Number(this.selectedMonth))
        );
      });
    },
    totalPages() {
      return Math.ceil(this.filteredDonations.length / this.DataperPage);
    },
    paginatedDonations() {
      const start = (this.currentPage - 1) * this.DataperPage;
      return this.filteredDonations.slice(start, start + this.DataperPage);
    },
  },
  methods: {
    fetchData() {
      axios
        .get("http://localhost:8000/api/getDonasi")
        .then((response) => {
          this.data = response.data.map((donasi) => {
            return {
              nama_donatur: donasi.nama_donatur,
              metode_pembayaran: donasi.metode_pembayaran,
              jumlah_donasi: donasi.jumlah_donasi,
              tanggal_donasi: new Date(donasi.tanggal_donasi)
                .toISOString()
                .split("T")[0],
            };
          });
          console.log(this.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },
    fetchTotalDonasi() {
      axios
        .get("http://localhost:8000/api/total-donasi")
        .then((response) => {
          this.donasi = response.data.total_donations;
        })
        .catch((error) => {
          console.error(error);
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
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
  },
  mounted() {
    this.fetchData();
    this.fetchTotalDonasi();
  },
};
</script>

<style scoped>
.container {
  max-width: 1100px;
  margin: auto;
  padding-top: 60px;
}

.statistics-card,
.filter-card,
.table-card {
  background-color: #f8f9fa;
  border: 1px solid #ddd;
  border-radius: 10px;
}

.stat-card {
  background-color: #ffffff;
  border-radius: 8px;
  text-align: center;
  border: 1px solid #ddd;
}

.filter-card {
  padding: 15px;
}

.table-card {
  padding: 20px;
}

.table {
  margin-top: 1rem;
}

.table th,
.table td {
  text-align: center;
  vertical-align: middle;
}

.form-control {
  border-radius: 6px;
  border: 1px solid #ced4da;
}

.pagination-controls {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.pagination-btn {
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 20px;
  padding: 10px 20px;
  font-size: 14px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin: 0 5px;
}

.pagination-btn:hover {
  background-color: #0056b3;
}

.pagination-btn:disabled {
  background-color: #d6d6d6;
  color: #999;
  cursor: not-allowed;
}

.pagination-text {
  font-size: 14px;
  color: #333;
}
</style>
