<template>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
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
      <div
        class="col-md-6 d-flex justify-content-center align-items-center form-section"
      >
        <div class="login-form w-75">
          <div class="position-relative mb-5">
            <router-link
              to="/"
              class="text-secondary mb-5 position_absolute d-block"
              >Kembali</router-link
            >
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
                placeholder="Nama Lengkap"
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
                placeholder="email@example.com"
              />
            </div>

            <p v-if="errorMessage" class="text-danger mt-3">
              {{ errorMessage }}
            </p>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input
                  :type="showPassword ? 'text' : 'password'"
                  id="password"
                  v-model="password"
                  class="form-control"
                  required
                  placeholder="Password"
                />
                <div class="input-group-append">
                  <span
                    class="input-group-text"
                    @click="togglePasswordVisibility"
                  >
                    <i
                      :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"
                    ></i>
                  </span>
                </div>
              </div>
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
import axios from "axios";
import CryptoJS from "crypto-js";

export default {
  data() {
    return {
      nama: "",
      email: "",
      password: "",
      errorMessage: "",
      showPassword: false,
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },

    encryptEmail(email) {
      const encryptionKey = "secretKey123";
      return CryptoJS.AES.encrypt(email, encryptionKey).toString();
    },

    async submitForm() {
      this.errorMessage = "";

      try {
        const response = await axios.post(
            "http://localhost:8000/api/register/Donatur",
            {
              nama_lengkap: this.nama,
              email: this.email,
              password: this.password,
            }
        );

        console.log(response.data.message);
        const encryptedEmail = this.encryptEmail(this.email);

        this.$router.push({
          name: "VerifyRegister",
          params: {encryptedEmail: encryptedEmail},
        });
      } catch (error) {
        if (error.response) {
          this.errorMessage =
              error.response.data.message || "Terjadi kesalahan. Silakan coba lagi.";
        } else {
          this.errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
        }
      }
    },
  },
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

.input-group-text {
  cursor: pointer;
  background-color: #fff;
  border: 1px solid #ced4da;
}
</style>
