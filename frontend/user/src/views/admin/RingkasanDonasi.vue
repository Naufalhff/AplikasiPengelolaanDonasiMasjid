<template>
  <div class="donation-summary">
    <button class="back-button" @click="goBack">← Kembali</button>
    <h2>Ringkasan Donasi</h2>
    <div class="summary-container">
      <div class="donation-details">
        <p><strong>Nominal donasi</strong></p>
        <p>{{ formatCurrency(donation.amount) }}</p>

        <div class="payment-method" v-if="donation.donorInfo">
          <p><strong>Metode Pembayaran</strong></p>
          <p>{{ donation.donorInfo.paymentMethod }}</p>
        </div>

        <p><strong>Info Donatur</strong></p>
        <ul v-if="donation.donorInfo">
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
          <p>{{ formatDate(donation.donorInfo.transactionDate) }}</p>
          <li><strong>Status</strong></li>
          <li :class="getStatusClass(donation.donorInfo.status)">
            {{ donation.donorInfo.status }}
          </li>
        </ul>
      </div>

      <div class="receipt">
        <p><strong>Bukti Transfer</strong></p>
        <img
          :src="donation.receiptImage"
          alt="Bukti Transfer"
          class="transfer-receipt"
          @click="openImageInNewTab(donation.receiptImage)"
          style="cursor: pointer; max-width: 100%;"
        />
      </div>
    </div>

    <div v-if="showConfirmDialog" class="confirmation-dialog">
      <p>
        Apakah Anda yakin ingin
        {{ confirmAction === "approve" ? "menerima" : confirmAction === "reject" ? "menolak" : "membatalkan" }} pembayaran
        ini?
      </p>
      <div class="dialog-buttons">
        <button @click="showConfirmDialog = false" class="cancel-button2">
          Kembali
        </button>
        <button
          @click="handleConfirmedAction"
          :class="
            confirmAction === 'approve' ? 'confirm-button' : confirmAction === 'reject' ? 'reject2-button' : 'cancel-button'
          "
        >
          {{ confirmAction === "approve" ? "Setuju" : confirmAction === "reject" ? "Tolak" : "Batalkan" }}
        </button>
      </div>
    </div>

    <div class="action-buttons">
      <button
        v-if="donation.donorInfo?.status === 'PENDING'"
        class="approve-button"
        @click="confirmApprove"
      >
        Setuju
      </button>
      <button
        v-if="donation.donorInfo?.status === 'PENDING'"
        class="reject-button"
        @click="confirmReject"
      >
        Tolak
      </button>
      <button
        v-if="donation.donorInfo?.status === 'VALID' || donation.donorInfo?.status === 'INVALID'"
        class="cancel-button"
        @click="confirmCancel"
      >
        Batalkan
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

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
    const id_donasi = this.$route.params.id;
    this.fetchDonationDetail(id_donasi);
  },
  computed: {
    showActionButtons() {
      return this.donation.donorInfo?.status === "PENDING";
    },
  },
  methods: {
    formatDate(dateString) {
      const date = new Date(dateString);
      const options = { year: "numeric", month: "long", day: "numeric" };
      return date.toLocaleDateString("id-ID", options);
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchDonationDetail(id_donasi) {
      axios
        .get(`http://localhost:8000/api/ringkasan-donasi/${id_donasi}`)
        .then((response) => {
          this.donation = {
            amount: response.data.jumlah_donasi,
            donorInfo: {
              paymentMethod: response.data.metode_pembayaran,
              fullName: response.data.nama_donatur,
              phoneNumber: response.data.no_telepon_donatur,
              address: response.data.alamat_donatur,
              email: response.data.email_donatur,
              activity: response.data.nama_kegiatan,
              transactionDate: response.data.tanggal_donasi,
              status: response.data.status_verifikasi,
            },
            receiptImage: `http://localhost:8000/storage/${response.data.bukti_pembayaran}`,
          };
        })
        .catch((error) => {
          console.error("Error fetching donation details:", error); 
        });
    },
    openImageInNewTab(imageUrl) {
      const newWindow = window.open(imageUrl, "_blank");
      if (newWindow) {
        newWindow.focus();
      } else {
        alert("Pop-up blocker aktif. Harap izinkan pop-up untuk melihat gambar.");
      }
    },
    confirmReject() {
      this.confirmAction = "reject";
      this.showConfirmDialog = true;
    },
    confirmApprove() {
      this.confirmAction = "approve";
      this.showConfirmDialog = true;
    },
    confirmCancel() {
      this.confirmAction = "cancel";
      this.showConfirmDialog = true;
    },
    handleConfirmedAction() {
      const id_donasi = this.$route.params.id;

      if (this.confirmAction === 'cancel') {
        axios
            .put(`http://localhost:8000/api/reset-status/${id_donasi}`)
            .then((response) => {
              console.log(response.data.message);
              this.donation.donorInfo.status = 'PENDING';
              this.$router.push({ name: "TransaksiDonasi" });
            })
            .catch((error) => {
              console.error("Error resetting donation status:", error);
            });
      } else {
        const status = this.confirmAction === "approve" ? "VALID" : "INVALID";

        axios
            .put(`http://localhost:8000/api/verifikasi-donasi/${id_donasi}`, {
              status_verifikasi: status,
            })
            .then((response) => {
              console.log(response.data.message);
              this.donation.donorInfo.status = status;

              if (status === "VALID") {
                axios
                    .post(
                        `http://localhost:8000/api/send-donation-receipt/${id_donasi}`
                    )
                    .then((receiptResponse) => {
                      console.log(receiptResponse.data.message);
                    })
                    .catch((receiptError) => {
                      console.error("Error sending donation receipt:", receiptError);
                    });
              }

              this.$router.push({ name: "Tables" });
            })
            .catch((error) => {
              console.error("Error verifying donation:", error);
            });
      }

      this.showConfirmDialog = false;
    },
    getStatusClass(status) {
      return status.toLowerCase() === "pending" ? "status-pending" : "";
    },
    cancelAction() {
      this.$router.push({ name: "TransaksiDonasi" });
    },
    goBack() {
      this.$router.push({ name: "TransaksiDonasi" }); // Navigasi ke halaman Transaksi Donasi
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

.payment-logo {
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

.approve-button, .reject-button {
  font-family: Arial, sans-serif; /* Sama seperti cancel-button */
  font-size: 14px;
  padding: 10px 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.reject-button {
  background-color: #dc3545;
  color: white;
  border-color: #c82333;
}

.reject-button:hover {
  background-color: #c82333; 
}

.approve-button {
  background-color: #28a745; 
  color: white;
  border-color: #218838;
}

.approve-button:hover {
  background-color: #218838;
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

.cancel-button2 {
  background-color: #cccccc;
  color: black;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.cancel-button {
  background-color: #f57c00;
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
</style>
