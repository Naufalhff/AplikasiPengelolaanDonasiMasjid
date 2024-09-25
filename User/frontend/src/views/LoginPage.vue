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
          <h2 class="mb-4">Masuk</h2>

          <div v-if="errorMessage" class="alert alert-danger" role="alert">
            {{ errorMessage }}
          </div>

          <form @submit.prevent="submitForm">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input
                type="email"
                id="email"
                v-model="email"
                class="form-control"
                required
              />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                id="password"
                v-model="password"
                class="form-control"
                required
              />
            </div>

            <div class="mb-3 text-end">
              <router-link to="/forgot-password" class="text-secondary">
                Lupa password?
              </router-link>
            </div>

            <button type="submit" class="btn btn-success w-100">
              Masuk Sekarang
            </button>
          </form>

          <p class="mt-4 text-center">
            Belum Punya Akun?
            <router-link to="/register" class="text-secondary">
              Daftar Di Sini
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      errorMessage: "",
    };
  },
  methods: {
    submitForm() {
      if (this.email === "user@gmail.com" && this.password === "123456") {
        console.log("Login Berhasil");
        //redirect
      } else if (this.email === "user@gmail.com") {
        this.errorMessage = "Password salah. Silakan coba lagi.";
      } else {
        this.errorMessage = "Email tidak terdaftar.";
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

.alert {
  font-size: 14px;
}
</style>
