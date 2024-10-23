<template>
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <div class="container mt-5">
    <div class="card p-4">
      <div class="text-center">
        <img :src="donation.image" alt="Donasi" class="img-thumbnail mb-3" />
        <h5>{{ donation.title }}</h5>
        <p>{{ donation.description }}</p>
      </div>
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="mb-0">Ringkasan Donasi</h6>
          <button class="btn btn-link text-danger" @click="goBack">Ubah</button>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span>Nominal donasi Anda</span>
          <span class="font-weight-bold"
            >Rp{{ selectedAmount.toLocaleString() }}</span
          >
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6>Metode Pembayaran</h6>
          <select
            class="form-select form-select-sm border-0 text-end"
            aria-label="Metode Pembayaran"
            v-model="donor.paymentMethod"
          >
            <option value="" selected disabled>Pilih</option>
            <option value="bca">BCA</option>
            <option value="bri">BRI</option>
          </select>
        </div>
        <hr />
        <div class="mb-3">
          <h6>Info Donatur</h6>
          <p>
            <a href="#" @click.prevent="login" class="text-primary"
              >Masuk Akun</a
            >
            atau lengkapi data dibawah ini
          </p>
          <form @submit.prevent="confirmDonation">
            <div class="form-group">
              <label for="fullName">Nama Lengkap</label>
              <input
                type="text"
                class="form-control"
                id="fullName"
                v-model="donor.fullName"
                placeholder="Nama Lengkap"
                required
              />
            </div>
            <div class="form-group">
              <label for="phoneNumber">No Telepon</label>
              <input
                type="text"
                class="form-control"
                id="phoneNumber"
                v-model="donor.phoneNumber"
                placeholder="08123456789"
                required
              />
            </div>
            <div class="form-group">
              <label for="address">Alamat</label>
              <input
                type="text"
                class="form-control"
                id="address"
                v-model="donor.address"
                placeholder="Alamat"
                required
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                v-model="donor.email"
                placeholder="email@example.com"
                required
              />
            </div>
            <p class="mt-3">
              Dengan melanjutkan donasi, saya setuju
              <a href="#" class="text-primary">Syarat & Ketentuan</a>
            </p>
            <div
              v-if="errorMessage"
              class="alert alert-danger mt-2"
              role="alert"
            >
              {{ errorMessage }}
            </div>
            <button class="btn btn-success w-100">Donasi Sekarang</button>
          </form>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      id="donationModal"
      tabindex="-1"
      aria-labelledby="donationModalLabel"
      aria-hidden="true"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body text-center p-4">
            <i class="fas fa-check-circle fa-5x text-success"></i>
            <h5 class="mb-3 mt-2">Konfirmasi Donasi</h5>
            <p>
              Donasi Anda senilai Rp{{ selectedAmount.toLocaleString() }} akan
              disalurkan
            </p>
            <div class="d-flex justify-content-center mt-4">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                @click="KembaliDonasi"
              >
                Kembali
              </button>
              <button
                type="button"
                class="btn btn-success ml-5"
                @click="submitDonation"
              >
                OK, Kirim
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      selectedAmount: 50000,
      donation: {
        title: "Donasi Penggalangan Dana korban bencana Gempa Bumi",
        description: "DKM Masjid Lukmanul Hakim",
        image: require("../assets/images/infaq.jpeg"),
      },
      donor: {
        fullName: "",
        phoneNumber: "",
        address: "",
        email: "",
        paymentMethod: "",
      },
      donationModal: null,

      errorMessage: "",
    };
  },
  mounted() {
    this.donationModal = new Modal(document.getElementById("donationModal"));
  },
  methods: {
    goBack() {
      this.$router.push({ name: "NominalPage" });
    },
    confirmDonation() {
      if (this.validateForm()) {
        this.donationModal.show();
      }
    },
    submitDonation() {
      if (this.validateForm()) {
        this.$router.push({ name: "PembayaranPage" });
      }
    },
    KembaliDonasi() {
      this.donationModal.hide();
    },
    validateForm() {
      return (
        this.donor.fullName &&
        this.donor.phoneNumber &&
        this.donor.address &&
        this.donor.email &&
        this.donor.paymentMethod
      );
    },
  },
};
</script>

<style scoped>
.card {
  max-width: 600px;
  margin: auto;
}

.img-thumbnail {
  width: 100%;
  max-width: 200px;
  height: auto;
}

.payment-icon {
  width: 50px;
  height: auto;
}

@media (max-width: 576px) {
  .card-body {
    padding: 1rem;
  }

  .form-group {
    margin-bottom: 1rem;
  }
}
</style>
