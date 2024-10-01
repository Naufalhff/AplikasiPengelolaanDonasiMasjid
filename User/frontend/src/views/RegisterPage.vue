<template>
  <div class="container-fluid login-container">
    <div class="row h-100">
      <!-- Left Section -->
      <div class="col-md-6 d-none d-md-block p-0">
        <img
            src="../assets/images/mesjid.jpg"
            alt="mesjid"
            class="img-fluid building-image"
        />
      </div>

      <!-- Right Section -->
      <div class="col-md-6 d-flex justify-content-center align-items-center form-section">
        <div class="login-form w-75">
          <div class="position-relative mb-5">
            <router-link to="/" class="text-secondary mb-5 position_absolute d-block">Kembali</router-link>
          </div>
          <h2 class="mb-4">Daftar</h2>

          <form @submit.prevent="submitForm">
            <div class="mb-2">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input
                  type="text"
                  id="nama"
                  v-model="nama"
                  class="form-control"
                  required
              />
            </div>

            <div class="mb-2">
              <label for="email" class="form-label">Email address</label>
              <input
                  type="email"
                  id="email"
                  v-model="email"
                  class="form-control"
                  required
              />
            </div>

            <p v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</p>

            <div class="mb-2">
              <label for="password" class="form-label">Password</label>
              <input
                  type="password"
                  id="password"
                  v-model="password"
                  class="form-control"
                  required
              />
            </div>

            <button type="submit" class="btn btn-success w-100">
              Daftar Sekarang
            </button>
          </form>

          <p class="mt-4 text-center">
            Sudah Punya Akun?
            <router-link to="/login" class="text-secondary">
              Login Di Sini
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      nama: "",
      email: "",
      password: "",
      errorMessage: "",
    };
  },
  methods: {
    async checkEmailExists(email) {
      try {
        const response = await axios.get(`/api/check-email?email=${email}`);
        return response.data.exists; // Asumsikan API mengembalikan { exists: true/false }
      } catch (error) {
        console.error("Error checking email:", error);
        return false; // Default ke false saat error
      }
    },

    async submitForm() {
      this.errorMessage = ""; // Reset pesan error

      // Cek apakah email sudah ada
      const emailExists = await this.checkEmailExists(this.email);
      if (emailExists) {
        this.errorMessage = "Email sudah digunakan.";
        return;
      }

      try {
        const response = await axios.post('http://localhost:8000/api/register', {
          nama_lengkap: this.nama,
          email: this.email,
          password: this.password,
        });

        // Pendaftaran berhasil, arahkan ke halaman verifikasi
        console.log(response.data.message);
        // Pada bagian submitForm
        this.$router.push({ name: 'VerifyRegister', query: { email: this.email } });
        // Pastikan ini sesuai dengan nama rute untuk VerifyRegister
      } catch (error) {
        if (error.response) {
          this.errorMessage = error.response.data.message || 'Terjadi kesalahan. Silakan coba lagi.';
        } else {
          this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
        }
      }
    },
  }
};
</script>

<style scoped>
/* Full-height container */
.login-container {
  height: 100vh;
}

.building-image {
  object-fit: cover;
  height: 100%;
}

.form-section {
  background-color: #fff;
  padding: 20px;
}

.login-form {
  max-width: 400px;
}

h2 {
  font-size: 24px;
  font-weight: bold;
}

.form-label {
  font-weight: 500;
}

.btn-success {
  background-color: #28a745;
  border: none;
}

.btn-success:hover {
  background-color: #218838;
}

.text-danger {
  font-size: 14px;
}
</style>
