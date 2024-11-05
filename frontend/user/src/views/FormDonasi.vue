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
        <h5>{{ data.nama_kegiatan }}</h5>
        <p>{{ data.deskripsi_kegiatan }}</p>
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
            <option value="BSI">BSI</option>
            <option value="QRIS">QRIS</option>
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
            <button class="btn btn-success w-100" @click="confirmDonation">
              Donasi Sekarang
            </button>
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
                @click="submit"
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
import axios from "axios";
import { Modal } from "bootstrap";
import CryptoJS from "crypto-js";

export default {
  data() {
    return {
      selectedAmount: this.$route.query.amount || 0,
      donation: {
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
      data: [],
      key: "Proyek-3-Mantap",
    };
  },
  mounted() {
    this.donationModal = new Modal(document.getElementById("donationModal"));
    this.fetchData();
  },
  methods: {
    goBack() {
      const id = this.$route.query.id; // ambil id dari query yang sudah ada
      this.$router.push({ path: "/detaildonasi/nominal", query: { id } });
    },
    confirmDonation() {
      if (!this.validateForm()) {
        this.errorMessage =
          "Harap lengkapi semua data dan Pilih metode pembayaran";
      } else {
        this.errorMessage = "";
        this.donationModal.show();
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
    fetchData() {
      const id = this.$route.query.id;
      axios
        .get(`http://localhost:8000/api/donasi/${id}`)
        .then((response) => {
          this.data = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
    },
    submit() {
      this.KembaliDonasi();
      const name = CryptoJS.AES.encrypt(
        this.donor.fullName,
        this.key
      ).toString();
      const phone = CryptoJS.AES.encrypt(
        this.donor.phoneNumber,
        this.key
      ).toString();
      const address = CryptoJS.AES.encrypt(
        this.donor.address,
        this.key
      ).toString();
      const email = CryptoJS.AES.encrypt(this.donor.email, this.key).toString();

      this.$router.push({
        path: "/detaildonasi/nominal/formdonasi/pembayaran",
        query: {
          id: this.data.id_kegiatan,

          name: name,
          phone: phone,
          address: address,
          email: email,
          amount: this.selectedAmount,
          payment: this.donor.paymentMethod,
        },
      });
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
