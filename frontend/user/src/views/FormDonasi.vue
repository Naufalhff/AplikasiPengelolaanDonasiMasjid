<template>
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
        <div class="mb-3">
          <h6>Metode Pembayaran</h6>
          <select class="form-select" aria-label="Metode Pembayaran">
            <option selected disabled>Pilih Metode Pembayaran</option>
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
          <form @submit.prevent="submitDonation">
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
            <button class="btn btn-success w-100">Donasi Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
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
      },
    };
  },
  methods: {
    goBack() {
      // Logika untuk kembali ke halaman sebelumnya untuk mengubah nominal
      this.$router.push({ name: "NominalPage" });
    },
    login() {
      // Logika untuk proses login
      alert("Fitur login belum tersedia");
    },
    submitDonation() {
      if (this.validateForm()) {
        // Logika pengiriman data donasi
        alert("Donasi berhasil diproses!");
        this.$router.push({ name: "ThankYouPage" });
      } else {
        alert("Harap lengkapi semua data donatur.");
      }
    },
    validateForm() {
      return (
        this.donor.fullName &&
        this.donor.phoneNumber &&
        this.donor.address &&
        this.donor.email
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
