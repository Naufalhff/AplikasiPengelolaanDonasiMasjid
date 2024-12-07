<template>
    <div class="container-fluid forgot-password-container">
      <div class="row h-100">
        <div class="col-md-6 d-none d-md-block p-0">
          <img src="../assets/images/mesjid.jpg" alt="mesjid" class="img-fluid building-image" />
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center form-section">
          <div class="reset-password-form w-75">
            <div class="position-relative mb-5">
              <router-link to="/login" class="text-secondary mb-5 position_absolute d-block">Kembali ke Login</router-link>
            </div>
            <h2 class="mb-3">Reset Password</h2>
            <p class="text-left mb-5">Masukkan password baru anda.</p>
            <form @submit.prevent="submitNewPassword">
              <div class="mb-4">
                <label for="newPassword" class="form-label">Password Baru</label>
                <input type="password" id="newPassword" v-model="newPassword" class="form-control" required />
              </div>
              <div class="mb-4">
                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                <input type="password" id="confirmPassword" v-model="confirmPassword" class="form-control" required />
              </div>
              <button type="submit" class="btn btn-success w-100">Reset Password</button>
            </form>
            <p v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>

<script>
import axios from "axios";
import CryptoJS from "crypto-js";

export default {
  data() {
    return {
      encryptedEmail: this.$route.params.encryptedEmail,
      newPassword: "",
      confirmPassword: "",
      errorMessage: "",
    };
  },
  methods: {
    decryptEmail(encryptedEmail) {
      try {
        const encryptionKey = "secretKey123";
        const bytes = CryptoJS.AES.decrypt(encryptedEmail, encryptionKey);
        const decryptedEmail = bytes.toString(CryptoJS.enc.Utf8);
        if (!decryptedEmail) {
          throw new Error("Dekripsi gagal, email tidak valid.");
        }
        return decryptedEmail;
      } catch (error) {
        console.error("Error during decryption: ", error);
        this.errorMessage = "Terjadi kesalahan saat mendekripsi email.";
        return null;
      }
    },

    async submitNewPassword() {
      const email = this.decryptEmail(this.encryptedEmail);

      if (!email) {
        return;
      }

      if (this.newPassword !== this.confirmPassword) {
        this.errorMessage = "Password tidak cocok.";
        return;
      }

      try {
        await axios.put("http://localhost:8000/api/reset-password", {
          email: email,
          password_baru: this.newPassword,
          konfirmasi_password: this.confirmPassword,
        });

        alert("Password berhasil direset. Silakan login.");
        this.$router.push("/login");
      } catch (error) {
        if (error.response && error.response.data) {
          this.errorMessage = error.response.data.message || "Terjadi kesalahan.";
        } else {
          this.errorMessage = "Terjadi kesalahan jaringan.";
        }
      }
    },
  },
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
.reset-password-form {
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

/* Tombol Reset */
.btn-success {
  background-color: #28a745;
  border: none;
}

.btn-success:hover {
  background-color: #218838;
}

/* Pesan Kesalahan */
.text-danger {
  font-size: 14px;
}
</style>
  
  