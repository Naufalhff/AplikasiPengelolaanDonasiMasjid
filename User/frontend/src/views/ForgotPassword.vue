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
              </div>
              <button type="submit" class="btn btn-primary w-100">Kirim Kode Verifikasi</button>
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
        console.log("Email:", this.email);
        // Alihkan ke screen verifikasi kode setelah sukses
        this.$router.push({ name: 'VerifyCode' });
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

  