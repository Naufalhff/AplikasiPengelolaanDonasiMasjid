<template>
    <div class="container-fluid forgot-password-container">
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
          <div class="forgot-password-form w-75">
            <div class="position-relative mb-5">
              <router-link
                to="/login"
                class="text-secondary mb-5 position_absolute d-block"
                >Kembali ke Login</router-link
              >
            </div>
            <h2 class="mb-3">Lupa Password</h2>
            <p class="text-left mb-5">
                Masukkan email anda dan kami akan mengirimkan kode verifikasi.
            </p>
  
            <form @submit.prevent="submitEmail">
              <div class="mb-4">
                <label for="email" class="form-label">Email address</label>
                <input
                  type="email"
                  id="email"
                  v-model="email"
                  class="form-control"
                  required
                />
              </div>
  
              <button type="submit" class="btn btn-primary w-100">
                Kirim Email
              </button>
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
        email: "",
      };
    },
    methods: {
      submitEmail() {
        // Implementasi pengiriman email reset password ke server
        console.log("Email:", this.email);
        // Contoh pengiriman request ke server:
        // axios.post('/api/forgot-password', { email: this.email })
        //   .then(response => {
        //     alert('Email untuk reset password telah dikirim.');
        //   })
        //   .catch(error => {
        //     console.error(error);
        //     alert('Terjadi kesalahan. Silakan coba lagi.');
        //   });
      },
    },
  };
  </script>
  
  <style scoped>
  /* Full-height container */
  .forgot-password-container {
    height: 100vh;
  }
  
  .building-image {
    object-fit: cover;
    height: 100%;
  }
  
  .form-section {
    background-color: #fff;
    padding: 20px;
    transform: translateY(-60px); /* Geser ke atas */
  }
  
  .forgot-password-form {
    max-width: 400px;
  }
  
  h2 {
    font-size: 24px;
    font-weight: bold;
  }
  
  p {
    font-size: 14px;
  }
  
  .form-label {
    font-weight: 500;
  }
  
  .btn-primary {
    background-color: #28a745;
    border: none;
  }
  
  .btn-primary:hover {
    background-color: #218838;
  }
  </style>
  