<template>
  <div class="donation-summary">
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
        <img
          :src="expense.expenseImage"
          alt="Bukti Transfer"
          class="transfer-receipt"
        />
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
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return date.toLocaleDateString('id-ID', options);
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
  },
};
</script>

<style scoped>
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

.payment-method {
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

.status-pending {
  color: orange;
  font-weight: bold;
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

.action-buttons {
  position: absolute;
  bottom: 20px;
  right: 20px;
  display: flex;
  gap: 10px;
}

.reject-button,
.approve-button {
  font-size: 24px;
  width: 50px;
  height: 50px;
  border: none;
  cursor: pointer;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.reject-button {
  background-color: #dc3545;
  color: white;
}

.approve-button {
  background-color: #28a745;
  color: white;
}

/* Dialog Konfirmasi */
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

.reject2-button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}
</style>
