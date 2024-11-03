<template>
  <div class="donation-summary">
    <h2>Ringkasan Donasi</h2>
    <div class="summary-container">
      <div class="donation-details">
        <p><strong>Nominal donasi</strong></p>
        <p>{{ donation.amount }}</p>

        <div class="payment-method">
          <p><strong>Metode Pembayaran
          <img src="@/assets/img/GOPAY.png" alt="GoPay" class="payment-logo" />
          </strong></p>
        </div>

        <p><strong>Info Donatur</strong></p>
        <ul>
          <li><strong>Nama Lengkap</strong></li>
          <li>{{ donation.donorInfo.fullName }}</li>
          <li><strong>No Telepon</strong></li>
          <li>{{ donation.donorInfo.phoneNumber }}</li>
          <li><strong>Alamat</strong></li>
          <li>{{ donation.donorInfo.address }}</li>
          <li><strong>Email</strong></li>
          <li>{{ donation.donorInfo.email }}</li>
          <li><strong>Kegiatan</strong></li>
          <li>{{ donation.donorInfo.activity }}</li>
          <li><strong>Tanggal Transaksi</strong></li>
          <li>{{ donation.donorInfo.transactionDate }}</li>
          <li><strong>Status</strong></li>
          <li :class="getStatusClass(donation.donorInfo.status)">{{ donation.donorInfo.status }}</li>
        </ul>
      </div>

      <div class="receipt">
        <p><strong>Bukti Transfer</strong></p>
        <img :src="donation.receiptImage" alt="Bukti Transfer" class="transfer-receipt" />
      </div>
    </div>
    
    <!-- Dialog konfirmasi -->
    <div v-if="showConfirmDialog" class="confirmation-dialog">
      <p>Apakah Anda yakin ingin {{ confirmAction === 'approve' ? 'menerima' : 'menolak' }} pembayaran ini?</p>
      <div class="dialog-buttons">
        <button @click="showConfirmDialog = false" class="cancel-button">Kembali</button>
        <button @click="handleConfirmedAction" :class="confirmAction === 'approve' ? 'confirm-button' : 'reject2-button'">
          {{ confirmAction === 'approve' ? 'Setuju' : 'Tolak' }}
        </button>
      </div>
    </div>

    <div class="action-buttons">
      <button class="reject-button" @click="confirmReject">✖</button>
      <button class="approve-button" @click="confirmApprove">✔</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "RingkasanDonasi",
  data() {
    return {
      donation: {},
      showConfirmDialog: false,
      confirmAction: "",
    };
  },
  created() {
    const id_donasi = this.$route.query.id;
    this.fetchDonationDetail(id_donasi);
  },
  methods: {
    fetchDonationDetail(id_donasi) {
      axios.get(`/api/transaksi-donasi/ringkasan-donasi?id=${id_donasi}`)
          .then(response => {
            this.donation = {
              amount: response.data.jumlah_donasi,
              donorInfo: {
                fullName: response.data.nama_donatur,
                phoneNumber: response.data.no_telepon_donatur,
                address: response.data.alamat_donatur,
                email: response.data.email_donatur,
                activity: response.data.event.nama_kegiatan,
                transactionDate: response.data.tanggal_donasi,
                status: response.data.status_verifikasi,
              },
              receiptImage: response.data.bukti_pembayaran
            };
          })
          .catch(error => {
            console.error("Error fetching donation details:", error);
          });
    },
    confirmReject() {
      this.confirmAction = "reject";
      this.showConfirmDialog = true;
    },
    confirmApprove() {
      this.confirmAction = "approve";
      this.showConfirmDialog = true;
    },
    handleConfirmedAction() {
      const id_donasi = this.donation.id_donasi;
      const status = this.confirmAction === "approve" ? "VALID" : "INVALID";

      axios.put(`/api/transaksi-donasi/ringkasan-donasi/${id_donasi}`, {
        status_verifikasi: status,
      })
          .then(response => {
            console.log(response.data.message);
            this.$router.push({ name: 'Tables' });
          })
          .catch(error => {
            console.error("Error verifying donation:", error);
          });

      this.showConfirmDialog = false;
    },
    getStatusClass(status) {
      return status.toLowerCase() === "pending" ? "status-pending" : "";
    }
  }
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
  gap: 10px;
}

.payment-method {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 10px;
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

.payment-logo{
  width: 100%;
  height: auto;
  max-width: 100px;
  border-radius: 8px;
  margin-left: 140px;
}

.action-buttons {
  position: absolute;
  bottom: 20px;
  right: 20px;
  display: flex;
  gap: 10px;
}

.reject-button, .approve-button {
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
