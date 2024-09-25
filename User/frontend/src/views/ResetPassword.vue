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
  export default {
    data() {
      return {
        newPassword: "",
        confirmPassword: "",
        errorMessage: "",
      };
    },
    methods: {
      submitNewPassword() {
        if (this.newPassword !== this.confirmPassword) {
          this.errorMessage = "Password tidak cocok.";
          return;
        }
        alert('Password berhasil direset. Silakan login.');
        this.$router.push({ name: 'Login' });
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
  
  