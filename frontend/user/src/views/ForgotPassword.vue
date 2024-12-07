<template>
    <div class="container-fluid forgot-password-container">
      <div class="row h-100">
        <div class="col-md-6 d-none d-md-block p-0">
          <img src="../assets/images/mesjid.jpg" alt="mesjid" class="img-fluid building-image" />
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center form-section">
          <div class="forgot-password-form w-75">
            <div class="position-relative mb-5">
              <router-link to="/login" class="text-secondary mb-5 position_absolute d-block">Kembali ke Login</router-link>
            </div>
            <h2 class="mb-3">Lupa Password</h2>
            <p class="text-left mb-5">Masukkan email anda dan kami akan mengirimkan kode verifikasi.</p>
            <form @submit.prevent="submitEmail">
              <div class="mb-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" id="email" v-model="email" class="form-control" required />
                <p v-if="emailError || errorMessage" class="text-danger mt-1">{{ emailError || errorMessage }}</p>
              </div>
              <button type="submit" class="btn btn-primary w-100">Kirim Kode Verifikasi</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </template>

<script>
import axios from 'axios';
import CryptoJS from "crypto-js";

export default {
  data() {
    return {
      email: "",
      errorMessage: "",
      emailError: "",
      isLoading: false
    };
  },
  methods: {
    encryptEmail(email) {
      const encryptionKey = "secretKey123";
      return CryptoJS.AES.encrypt(email, encryptionKey).toString();
    },

    async submitEmail() {
      // Reset previous errors
      this.errorMessage = "";
      this.emailError = "";

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.email)) {
        this.emailError = "Format email tidak valid";
        return;
      }

      this.isLoading = true;

      try {
        await axios.post('http://localhost:8000/api/send-reset', {
          email: this.email
        });

        const encryptedEmail = this.encryptEmail(this.email);
        this.$router.push({
          name: 'VerifyCode',
          params: {encryptedEmail: encryptedEmail},
        });
      } catch (error) {
        if (error.response) {
          if (error.response.status === 404) {
            this.errorMessage = "Email tidak dapat ditemukan.";
          } else {
            this.errorMessage = error.response.data.message || "Terjadi kesalahan saat mengirim kode verifikasi.";
          }
        } else if (error.request) {
          this.errorMessage = "Tidak ada respon dari server. Silakan coba lagi.";
        } else {
          this.errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
        }
      } finally {
        this.isLoading = false;
      }
    }
  }
};
</script>

  <style scoped>
/* Full-height container */
.forgot-password-container {
  height: 100vh;
}

/* Gambar sisi kiri */
.building-image {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

/* Section Form */
.form-section {
  background-color: #fff;
  padding: 20px;
}

/* Form Style */
.forgot-password-form {
  max-width: 400px;
}

/* Judul Form */
h2 {
  font-size: 24px;
  font-weight: bold;
}

/* Paragraf informasi */
p {
  font-size: 14px;
  color: #6c757d;
}

/* Label Input */
.form-label {
  font-weight: 500;
}

/* Tombol Kirim */
.btn-primary {
  background-color: #28a745;
  border: none;
}

.btn-primary:hover {
  background-color: #218838;
}
</style>

