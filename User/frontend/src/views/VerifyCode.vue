<template>
    <div class="container-fluid forgot-password-container">
      <div class="row h-100">
        <div class="col-md-6 d-none d-md-block p-0">
          <img src="../assets/images/mesjid.jpg" alt="mesjid" class="img-fluid building-image" />
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center form-section">
          <div class="verify-code-form w-75">
            <div class="position-relative mb-5">
              <router-link to="/forgot-password" class="text-secondary mb-5 position_absolute d-block">Kembali</router-link>
            </div>
            <h2 class="mb-3">Verifikasi Kode</h2>
            <p class="text-left mb-5">Masukkan kode verifikasi yang telah kami kirim ke email anda.</p>
            <form @submit.prevent="submitCode">
              <div class="mb-4">
                <label for="code" class="form-label">Kode Verifikasi</label>
                <input type="text" id="code" v-model="verificationCode" class="form-control" required />
              </div>
              <button type="submit" class="btn btn-primary w-100">Verifikasi Kode</button>
            </form>
            <p v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</p>
            <button @click="resendCode" :disabled="disableResend" class="btn btn-secondary w-100 mt-3">Kirim Ulang Kode</button>
            <p v-if="disableResend" class="text-muted mt-2">Tunggu {{ timeRemaining }} detik untuk mengirim ulang kode.</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        verificationCode: "",
        errorMessage: "",
        disableResend: false,
        timeRemaining: 60,
      };
    },
    methods: {
      submitCode() {
        if (this.verificationCode === "123456") {
          this.$router.push({ name: 'ResetPassword' });
        } else {
          this.errorMessage = "Kode verifikasi salah.";
        }
      },
      resendCode() {
        this.disableResend = true;
        this.timeRemaining = 60;
        const interval = setInterval(() => {
          this.timeRemaining--;
          if (this.timeRemaining <= 0) {
            clearInterval(interval);
            this.disableResend = false;
          }
        }, 1000);
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
  .verify-code-form {
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
  
  /* Tombol Verifikasi */
  .btn-primary {
    background-color: #28a745;
    border: none;
  }
  
  .btn-primary:hover {
    background-color: #218838;
  }
  
  /* Tombol Kirim Ulang */
  .btn-secondary {
    background-color: #ffc107;
    border: none;
  }
  
  .btn-secondary:hover {
    background-color: #e0a800;
  }
  
  /* Pesan Kesalahan */
  .text-danger {
    font-size: 14px;
  }
  
  /* Pesan Tertunda */
  .text-muted {
    font-size: 12px;
    margin-top: 10px;
  }
  </style>
  
  