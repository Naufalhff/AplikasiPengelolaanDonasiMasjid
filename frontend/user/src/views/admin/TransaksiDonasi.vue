<template>
  <div class="donation-transactions">
    <h2>Transaksi Donasi</h2>
    <table class="donation-table">
      <thead>
        <tr>
          <th>ID Transaksi</th>
          <th>Nama Donatur</th>
          <th>Kegiatan</th>
          <th>Status Verifikasi</th>
          <th>Verifikasi Pembayaran</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(transaction, index) in currentPageTransactions" :key="index">
          <td>{{ transaction.id }}</td>
          <td>{{ transaction.nama }}</td>
          <td>{{ transaction.activity }}</td>
          <td :class="getStatusClass(transaction.verificationStatus)">
            {{ transaction.verificationStatus || "Tidak Tersedia" }}
          </td>
          <td>
            <button @click="viewDetails(transaction.id)" class="btn btn-detail">
              Lihat Detail
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="pagination">
      <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
      <span>Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      transactions: [], // Data semua transaksi
      currentPage: 1, // Halaman yang sedang aktif
      itemsPerPage: 10, // Jumlah item per halaman
      key: "Proyek-3-Mantap",
      role: "",
    };
  },
  computed: {
    totalPages() {
      return Math.ceil(this.transactions.length / this.itemsPerPage); // Menghitung total halaman
    },
    currentPageTransactions() {
      const start = (this.currentPage - 1) * this.itemsPerPage;
      const end = start + this.itemsPerPage;
      return this.transactions.slice(start, end); // Menampilkan transaksi sesuai dengan halaman
    },
  },
  created() {
    this.role = sessionStorage.getItem("role");
    console.log(this.role)
      axios.get('http://localhost:8000/api/transaksi-donasi')
        .then(response => {
          this.transactions = response.data.map(donation => ({
            id: donation.id_donasi,
            nama: donation.nama_donatur,
            activity: donation.nama_kegiatan,
            verificationStatus: donation.status_verifikasi
          }));
        })
        .catch(error => {
          console.error("Error fetching transactions:", error);
      });
  },
  methods: {
    getStatusClass(status) {
      if (status === "Pending") return "status-pending";
      if (status === "Terverifikasi") return "status-verified";
      if (status === "Ditolak") return "status-rejected";
      return "";
    },
    viewDetails(id) {
      this.$router.push({ name: "RingkasanDonasi", params: { id } });
    },
    nextPage() {
      if (this.currentPage < this.totalPages) {
        this.currentPage += 1;
      }
    },
    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage -= 1;
      }
    },
  },
};
</script>

<style scoped>
.donation-transactions {
  padding: 10px;
  background-color: #f8f9fa;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  align-items: center; 
  justify-content: flex-start;
  min-height: 100vh;
}

.donation-table {
  width: 95%; 
  max-width: 1200px;
  border-collapse: collapse;
  margin-top: 20px;
}

.donation-table th,
.donation-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #ddd;
  font-size: 14px;
}

.donation-table th {
  background-color: #f1f3f5;
  color: #333;
  font-weight: bold;
}

.status-pending {
  color: orange;
  font-weight: bold;
}

.status-verified {
  color: green;
  font-weight: bold;
}

.status-rejected {
  color: red;
  font-weight: bold;
}

.btn-detail {
  background-color: #28a745;
  color: white;
  padding: 8px 12px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  font-size: 12px;
  text-transform: uppercase;
}

.btn-detail:hover {
  background-color: #218838;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination button {
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

.pagination button:hover {
  background-color: #0056b3; 
}

.pagination button:disabled {
  background-color: #d6d6d6;
  color: #999;
  cursor: not-allowed;
}

</style>