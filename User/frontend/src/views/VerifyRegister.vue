<template>
  <div class="container-fluid verify-register-container">
    <div class="row h-100">
      <!-- Left Section -->
      <div class="col-md-6 d-none d-md-block p-0">
        <img src="../assets/images/mesjid.jpg" alt="mesjid" class="img-fluid building-image" />
      </div>
      <!-- Right Section -->
      <div class="col-md-6 d-flex justify-content-center align-items-center form-section">
        <div class="verify-code-form w-75">
          <div class="position-relative mb-5">
            <router-link to="/register" class="text-secondary mb-5 position_absolute d-block">Kembali</router-link>
          </div>
          <h2 class="mb-4">Verifikasi</h2>
          <p class="text-left mb-3">Kode verifikasi telah dikirimkan melalui email.</p>
          <form @submit.prevent="submitCode">
            <div class="mb-4">
              <label for="code" class="form-label">Masukkan Kode Verifikasi</label>
              <input type="text" id="code" v-model="verifyCode" class="form-control" required maxlength="6" />
            </div>
            <button type="submit" class="btn btn-primary w-100">Verifikasi Kode</button>
          </form>
          <p v-if="errorMessage" class="text-danger mt-2">{{ errorMessage }}</p>
          <button @click="resendCode" :disabled="disableResend" class="btn btn-secondary w-100 mt-3">Kirim Ulang Kode</button>
          <p v-if="disableResend" class="text-muted mt-2">Tunggu {{ timeRemaining }} detik untuk mengirim ulang kode.</p>
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
      verifyCode: "",
      errorMessage: "",
      disableResend: false,
      timeRemaining: 60,
    };
  },
  methods: {
    async submitCode() {
      try {
        // Kirim OTP untuk verifikasi
        await axios.post('http://localhost:8000/api/verify-otp', null, {
          params: {
            email: this.$route.query.email, // Mengirim email sebagai parameter query
            otp: this.verifyCode,
          },
        });
        // Jika verifikasi berhasil, arahkan ke halaman login
        this.$router.push('/login');
      } catch (error) {
        if (error.response) {
          this.errorMessage = error.response.data.message || 'Terjadi kesalahan. Silakan coba lagi.';
        } else {
          this.errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
        }
      }
    },

    async resendCode() {
      this.disableResend = true;
      this.timeRemaining = 60;

      try {
        await axios.post('http://localhost:8000/api/resend-otp', null, {
          params: {
            email: this.$route.query.email // Mengirim email sebagai parameter query
          }
        });
        this.errorMessage = "Kode OTP telah dikirim ulang.";
      } catch (error) {
        this.errorMessage = "Gagal mengirim ulang kode OTP.";
      }

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
.verify-register-container {
  height: 100vh;
}

/* Left section image styling */
.building-image {
  object-fit: cover;
  height: 100%;
  width: 100%;
}

/* Form section styling */
.form-section {
  background-color: #fff;
  padding: 20px;
}

/* Form style */
.verify-code-form {
  max-width: 400px;
}

/* Form title */
h2 {
  font-size: 24px;
  font-weight: bold;
}

/* Information paragraph */
p {
  font-size: 14px;
  color: #6c757d;
}

/* Input label style */
.form-label {
  font-weight: 500;
}

/* Verification button style */
.btn-primary {
  background-color: #28a745;
  border: none;
}

.btn-primary:hover {
  background-color: #218838;
}

/* Resend button style */
.btn-secondary {
  background-color: #ffc107;
  border: none;
}

.btn-secondary:hover {
  background-color: #e0a800;
}

/* Error message style */
.text-danger {
  font-size: 14px;
}

/* Resend waiting message style */
.text-muted {
  font-size: 12px;
  margin-top: 10px;
}
</style>
