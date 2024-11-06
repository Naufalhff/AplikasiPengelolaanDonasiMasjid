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
        <tr v-for="(transaction, index) in transactions" :key="index">
          <td>{{ transaction.id }}</td>
          <td>{{ transaction.name }}</td>
          <td>{{ transaction.activity }}</td>
          <td :class="getStatusClass(transaction.verificationStatus)">
            {{ transaction.verificationStatus }}
          </td>
          <td>
            <button @click="viewDetails(transaction.id)" class="btn btn-detail">
              Lihat Detail
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      transactions: [],
    };
  },
  created() {
    axios
      .get("http://localhost:8000/api/transaksi-donasi")
      .then((response) => {
        this.transactions = response.data.map((donation) => ({
          id: donation.id_donasi,
          name: donation.nama_donatur,
          activity: donation.nama_kegiatan,
          verificationStatus: donation.status_verifikasi,
        }));
      })
      .catch((error) => {
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
  },
};
</script>

<style scoped>
.donation-transactions {
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
}

.donation-table {
  width: 100%;
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
</style>
