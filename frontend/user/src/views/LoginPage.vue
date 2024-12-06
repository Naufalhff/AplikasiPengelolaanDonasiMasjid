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
                placeholder="email@example.com"
                required
              />
            </div>

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
      key: "Proyek-3-Mantap",
      showPassword: false,
    };
  },
  methods: {
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    async submitForm() {
      try {
        const response = await axios.post("/login", {
          email: this.email,
          password: this.password,
        });
        console.log("Login berhasil");
        const UserRole = response.data.user.peran;
        const fullName = response.data.user.nama_lengkap;
        const email = this.email;

        sessionStorage.setItem("isLogin", "true");
        sessionStorage.setItem("loginAs", UserRole);
        sessionStorage.setItem("fullName", fullName);
        sessionStorage.setItem("email", email);

        console.log(sessionStorage.getItem("loginAs"));
        if (UserRole === "Donatur") {
          this.$router.push("/home");
        } else {
          sessionStorage.setItem("role", UserRole);
          if (UserRole === "Pengurus Masjid") {
            this.$router.push("/activity-list");
          } else if (UserRole === "Bendahara") {
            this.$router.push("/transaksidonasi");
          } else if (UserRole === "Administrator") {
            this.$router.push("/dashboard-page");
          }
        }
      } catch (error) {
        if (error.response && error.response.status === 401) {
          this.errorMessage = "Email atau password salah.";
        } else {
          this.errorMessage = "Terjadi kesalahan, silakan coba lagi.";
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

.alert {
  font-size: 14px;
}
.input-group-text {
  cursor: pointer;
  background-color: #fff;
  border: 1px solid #ced4da;
}
</style>
