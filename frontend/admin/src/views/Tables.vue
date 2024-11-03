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
            <button @click="viewDetails(transaction.id)" class="btn btn-detail">Lihat Detail</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      transactions: [
        { id: 123, name: "Tono", activity: "Kurban", verificationStatus: "Pending" },
        { id: 234, name: "Tono", activity: "Kurban", verificationStatus: "Pending" },
        { id: 345, name: "Tono", activity: "Kurban", verificationStatus: "Pending" },
        { id: 456, name: "Tono", activity: "Kurban", verificationStatus: "Terverifikasi" },
        { id: 567, name: "Tono", activity: "Kurban", verificationStatus: "Terverifikasi" },
        { id: 678, name: "Tono", activity: "Kurban", verificationStatus: "Ditolak" },
        { id: 789, name: "Tono", activity: "Kurban", verificationStatus: "Ditolak" }
      ]
    };
  },
  methods: {
    getStatusClass(status) {
      if (status === "Pending") return "status-pending";
      if (status === "Terverifikasi") return "status-verified";
      if (status === "Ditolak") return "status-rejected";
      return "";
    },
    viewDetails(id) {
      this.$router.push({ name: 'RingkasanDonasi', params: { id } });
    }
  }
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