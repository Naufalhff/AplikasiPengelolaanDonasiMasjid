<template>
  <div class="donation-transactions">
    <h2>Riwayat Pengeluaran</h2>
    <table class="donation-table">
      <thead>
        <tr>
          <th>ID Pengeluaran</th>
          <th>Nama Transaksi</th>
          <th>Anggaran</th>
          <th>Waktu</th>
          <th>Pilih Proses</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(transaction, index) in currentPageTransactions"
          :key="index"
        >
          <td>{{ transaction.id }}</td>
          <td>{{ transaction.name }}</td>
          <td>{{ formatCurrency(transaction.budget) }}</td>
          <td>{{ transaction.time }}</td>
          <td>
            <div class="action-buttons">
              <button
                @click="viewDetails(transaction.id)"
                class="btn btn-detail"
              >
                Lihat Detail
              </button>
              <button
                @click="openConfirmationModal(transaction.id)"
                class="btn-cancel-transaction"
              >
                Batalkan Transaksi
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="pagination-container">
      <button @click="addTransaction" class="btn btn-add-transaction mt-3">
        <i class="fas fa-plus"></i> Tambah Pengeluaran
      </button>
      <div class="pagination">
        <button @click="prevPage" :disabled="currentPage === 1">
          Previous
        </button>
        <span>Page {{ currentPage }} of {{ totalPages }}</span>
        <button @click="nextPage" :disabled="currentPage === totalPages">
          Next
        </button>
      </div>
    </div>

    <div v-if="showModal" class="confirmation-dialog">
      <p>Apakah Anda yakin ingin membatalkan transaksi ini?</p>
      <div class="dialog-buttons">
        <button @click="confirmCancelTransaction" class="confirm-button">
          Setuju
        </button>
        <button @click="closeModal" class="cancel-button">Kembali</button>
      </div>
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
      showModal: false,
      transactionToCancel: null,
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
    const id_kegiatan = this.$route.params.id;
    this.role = sessionStorage.getItem("role");

    axios
      .get(`http://localhost:8000/api/riwayat-transaksi/${id_kegiatan}`)
      .then((response) => {
        this.transactions = response.data.map((expense) => ({
          id: expense.id_pengeluaran,
          name: expense.nama_transaksi,
          budget: expense.total_pengeluaran,
          time: expense.tanggal_transaksi,
        }));
      })
      .catch((error) => {
        console.error("Error fetching expenses:", error);
      });
  },
  methods: {
    viewDetails(id) {
      this.$router.push({ name: "RingkasanPengeluaran", params: { id } });
    },
    addTransaction() {
      const id = this.$route.params.id;
      this.$router.push({
        name: "BuatPengeluaran",
        params: { id: id },
      });
    },
    openConfirmationModal(id) {
      this.transactionIdToCancel = id; // Menyimpan id transaksi yang akan dibatalkan
      this.showModal = true; // Menampilkan modal
    },
    confirmCancelTransaction() {
      this.cancelTransaction(this.transactionIdToCancel);
      this.closeModal(); // Menutup modal setelah konfirmasi
    },
    closeModal() {
      this.showModal = false; // Menutup modal
      this.transactionIdToCancel = null; // Reset id transaksi
    },
    cancelTransaction(id) {
      axios
        .delete(`http://localhost:8000/api/hapus-pengeluaran/${id}`)
        .then(() => {
          alert("Transaksi berhasil dibatalkan");
          this.transactions = this.transactions.filter(
            (transaction) => transaction.id !== id
          );
        })
        .catch((error) => {
          console.error("Error canceling transaction:", error);
          alert("Terjadi kesalahan saat membatalkan transaksi");
        });
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
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
  },
};
</script>

<style scoped>
.donation-transactions {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-height: 100vh;
}

.donation-table {
  width: 80%;
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

.btn-add-transaction {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: background-color 0.3s ease;
}

.btn-add-transaction:hover {
  background-color: #218838;
}

.btn-add-transaction i {
  font-size: 16px;
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

.btn-cancel-transaction {
  background-color: #dc3545;
  color: white;
  padding: 8px 12px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  font-size: 12px;
  text-transform: uppercase;
}

.btn-cancel-transaction:hover {
  background-color: #c82333;
}

.action-buttons {
  display: flex;
  gap: 8px;
  align-items: center;
}

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination button {
  padding: 10px 15px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin: 0 5px;
}

.pagination button:disabled {
  background-color: #6c757d;
}

.pagination span {
  margin: 0 10px;
  font-size: 16px;
}

.confirmation-dialog {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px 40px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  text-align: center;
  z-index: 1000;
}

.dialog-buttons {
  margin-top: 20px;
  display: flex;
  justify-content: center;
  gap: 10px;
}

.cancel-button {
  background-color: #ff8800;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.confirm-button {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>
