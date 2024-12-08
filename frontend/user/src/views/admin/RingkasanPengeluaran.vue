<template>
  <div class="donation-summary">
    <button class="back-button" @click="goBack">← Kembali</button>
    
    <h2>Ringkasan Pengeluaran</h2>
    <div class="summary-container">
      <div class="donation-details">
        <ul v-if="expense.expenseInfo">
          <li><strong>Nama Transaksi</strong></li>
          <li>{{ expense.expenseInfo.name }}</li>
          <li><strong>Deskripsi</strong></li>
          <li>{{ expense.expenseInfo.description }}</li>
          <li><strong>Total Pengeluaran</strong></li>
          <li>{{ formatCurrency(expense.expenseInfo.amount) }}</li>
          <li><strong>Tanggal Transaksi</strong></li>
          <p>{{ formatDate(expense.expenseInfo.date) }}</p>
        </ul>
      </div>

      <div class="receipt">
        <p><strong>Bukti Transaksi</strong></p>
        <template v-if="isPdf(expense.expenseImage)">
          <!-- Tombol untuk PDF -->
          <button class="pdf-button" @click="openPdf(expense.expenseImage)">Baca PDF</button>
        </template>
        <template v-else>
          <!-- Gambar jika bukan PDF -->
          <img
            :src="expense.expenseImage"
            alt="Bukti Transfer"
            class="transfer-receipt"
          />
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "RingkasanPengeluaran",
  data() {
    return {
      expense: {},
    };
  },
  created() {
    const id_pegeluaran = this.$route.params.id;
    this.fetchExpenseDetail(id_pegeluaran);
  },
  methods: {
    formatDate(dateString) {
      const date = new Date(dateString);
      const options = { year: "numeric", month: "long", day: "numeric" };
      return date.toLocaleDateString("id-ID", options);
    },
    fetchExpenseDetail(id_pegeluaran) {
      axios
        .get(`http://localhost:8000/api/detail-pengeluaran/${id_pegeluaran}`)
        .then((response) => {
          this.expense = {
            expenseInfo: {
              name: response.data.nama_transaksi,
              description: response.data.deskripsi_transaksi,
              amount: response.data.total_pengeluaran,
              date: response.data.tanggal_transaksi,
            },
            expenseImage: `http://localhost:8000/storage/${response.data.bukti_transaksi}`,
          };
        })
        .catch((error) => {
          console.error("Error fetching expense details:", error);
        });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    goBack() {
      this.$router.go(-1);
    },
    isPdf() {
      return this.expense.expenseImage 
        ? this.expense.expenseImage.toLowerCase().includes('.pdf')
        : false;
    },
    openPdf(fileUrl) {
      // Membuka PDF di tab baru
      window.open(fileUrl, "_blank");
    },
  },
};
</script>

<style scoped>
.back-button {
  background: none;
  border: none;
  color: #007bff;
  font-size: 16px;
  cursor: pointer;
  margin-bottom: 10px;
  display: inline-block;
}
.back-button:hover {
  text-decoration: underline;
}

.donation-summary {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
  max-width: 900px;
  margin: 0 auto;
  position: relative;
}

h2 {
  margin-bottom: 20px;
  color: #333;
}

p {
  color: #333;
}

.summary-container {
  display: flex;
  gap: 20px;
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  position: relative;
  min-height: 400px;
}

.donation-details {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 5px;
}

ul {
  list-style: none;
  padding: 0;
  line-height: 1.6;
}

ul li {
  margin-bottom: 8px;
  color: #333;
}

.receipt {
  flex: 1;
  text-align: center;
}

.transfer-receipt {
  width: 100%;
  max-width: 300px;
  height: auto;
  border-radius: 8px;
  border: 1px solid #ddd;
}

.pdf-button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}
.pdf-button:hover {
  background-color: #0056b3;
}
</style>
