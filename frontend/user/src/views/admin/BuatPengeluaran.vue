<template>
  <div class="container-fluid py-4">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-10 col-md-12">
        <!-- Form Title -->
        <h2 class="mb-5 text-center">Buat Pengeluaran</h2>

        <!-- Form -->
        <form @submit.prevent="validateForm" novalidate>
          <!-- Upload Image Section -->
          <div class="mb-4">
            <label for="activityImage" class="form-label">Upload Bukti</label>
            <div class="upload-container">
              <input
                type="file"
                class="form-control upload-input"
                id="activityImage"
                @change="onImageChange"
                ref="activityImage"
              />
              <span class="file-label">{{ form.imageName || "Pilih File..." }}</span>
            </div>
            <div v-if="errors.image" class="invalid-feedback">
              {{ errors.image }}
            </div>
          </div>

          <!-- Nama Transaksi -->
          <div class="mb-3">
            <label for="activityName" class="form-label">Nama Transaksi</label>
            <input
              type="text"
              class="form-control"
              id="activityName"
              v-model="form.name"
              placeholder="Masukkan Nama Transaksi"
              :class="{ 'is-invalid': errors.name }"
            />
            <div v-if="errors.name" class="invalid-feedback">
              {{ errors.name }}
            </div>
          </div>

          <!-- Deskripsi -->
          <div class="mb-3">
            <label for="activityDescription" class="form-label">Deskripsi</label>
            <textarea
              id="activityDescription"
              class="form-control"
              rows="4"
              v-model="form.description"
              placeholder="Masukkan Deskripsi"
              :class="{ 'is-invalid': errors.description }"
            ></textarea>
            <div v-if="errors.description" class="invalid-feedback">
              {{ errors.description }}
            </div>
          </div>

          <!-- Total Pengeluaran -->
          <div class="mb-3">
            <label for="targetAmount" class="form-label">Total Pengeluaran</label>
            <input
              type="text"
              class="form-control"
              id="targetAmount"
              v-model="form.displayAmount"
              @input="formatRupiah"
              placeholder="Masukkan Nominal Pengeluaran"
              :class="{ 'is-invalid': errors.targetAmount }"
            />
            <div v-if="errors.targetAmount" class="invalid-feedback">
              {{ errors.targetAmount }}
            </div>
          </div>

          <!-- Submit and Cancel Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button type="button" @click="cancel" class="btn btn-outline-secondary">Batalkan</button>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </form>

        <!-- Dialog -->
        <div v-if="showDialog" class="dialog-overlay">
          <div class="dialog-box">
            <h3 class="dialog-title">Anggaran Melebihi Batas</h3>
            <p class="dialog-message">
              Total pengeluaran yang dimasukkan melebihi anggaran terkumpul. Silakan periksa kembali anggaran Anda.
            </p>
            <div class="dialog-actions">
              <button @click="closeDialog" class="btn btn-warning">Kembali</button>
            </div>
          </div>
        </div>

        <!-- Popup Notifikasi -->
        <div v-if="showSuccessPopup" class="success-popup-overlay">
          <div class="success-popup-box">
            <h3 class="success-popup-title">Berhasil!</h3>
            <p class="success-popup-message">Pengeluaran berhasil ditambahkan.</p>
            <button @click="closeSuccessPopup" class="btn btn-success">OK</button>
          </div>
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
      form: {
        imageName: null,
        name: '',
        description: '',
        displayAmount: '',
        targetAmount: '',
      },
      errors: {},
      showDialog: false,
      showSuccessPopup: false,
      eventData: null,
    };
  },
  methods: {
    onImageChange(event) {
      const file = event.target.files[0];
      this.form.imageName = file ? file.name : null;
    },
    formatRupiah() {
      let value = this.form.displayAmount.replace(/\D/g, '');

      const numericValue = parseInt(value);

      if (!isNaN(numericValue)) {
        this.form.targetAmount = numericValue;

        this.form.displayAmount = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0,
          maximumFractionDigits: 0
        }).format(numericValue);
      } else {
        this.form.displayAmount = '';
        this.form.targetAmount = '';
      }
    },
    async validateForm() {
      this.errors = {};

      const file = this.$refs.activityImage.files[0];
      if (!file) {
        this.errors.image = 'Gambar harus diunggah.';
      } else if (file.size > 5 * 1024 * 1024) {
        this.errors.image = 'Ukuran gambar tidak boleh lebih dari 5 MB.';
      }

      if (!this.form.name) {
        this.errors.name = 'Nama transaksi harus diisi.';
      } else if (this.form.name.length > 255) {
        this.errors.name = 'Nama transaksi tidak boleh lebih dari 255 karakter.';
      }

      if (!this.form.description) {
        this.errors.description = 'Deskripsi harus diisi.';
      }

      if (!this.form.targetAmount || this.form.targetAmount <= 0) {
        this.errors.targetAmount = 'Total pengeluaran harus lebih dari nol.';
      } else if (this.form.targetAmount.toString().length > 15) {
        this.errors.targetAmount = 'Total pengeluaran tidak boleh lebih dari 15 digit.';
      }

      if (Object.keys(this.errors).length === 0) {
        await this.checkBudget();
      }
    },
    async checkBudget() {
      try {
        const response = await axios.get(`http://localhost:8000/api/donasi/${this.$route.params.id}`);
        const eventData = response.data;

        const totalPengeluaran = parseFloat(this.form.targetAmount) + parseFloat(eventData.anggaran_pengeluaran);

        if (totalPengeluaran > parseFloat(eventData.anggaran_terkumpul)) {
          this.openDialog();
        } else {
          this.submitForm();
        }
      } catch (error) {
        console.error("Error fetching event data:", error);
        this.errors.general = 'Terjadi kesalahan saat mengambil data kegiatan.';
      }
    },
    openDialog() {
      this.showDialog = true;
    },
    closeDialog() {
      this.showDialog = false;
    },
    async submitForm() {
      const formData = new FormData();

      formData.append('file', this.$refs.activityImage.files[0]);
      formData.append('id', this.$route.params.id);
      formData.append('name', this.form.name);
      formData.append('description', this.form.description);
      formData.append('amount', this.form.targetAmount);

      try {
        const response = await axios.post('http://localhost:8000/api/tambah-pengeluaran', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        this.showSuccessPopup = true;
        console.log(response.data);

      } catch (error) {
        console.error('Error submitting form:', error);
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;
        } else {
          this.errors.general = 'Terjadi kesalahan saat menyimpan pengeluaran.';
        }
      }
    },
    cancel() {
      this.$router.push({name: 'RiwayatPengeluaran'});
    },
    closeSuccessPopup() {
      this.showSuccessPopup = false; 
      this.$router.push({ name: 'RiwayatPengeluaran' }); 
    },
  },
};
</script>

<style scoped>
/* Container Utama */
.container-fluid {
  max-width: 1200px;
}

/* Judul */
h2 {
  font-size: 1.8rem;
  font-weight: bold;
  color: #333;
}

/* Upload Bukti */
.upload-container {
  height: 200px;
  border: 2px dashed #ced4da;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;
  background-color: #f8f9fa;
  cursor: pointer;
}

.upload-input {
  position: absolute;
  opacity: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
}

.file-label {
  font-size: 1rem;
  font-weight: 500;
  color: #6c757d;
  text-align: center;
}

.is-invalid {
  border-color: #dc3545;
}

.invalid-feedback {
  display: block;
  color: #dc3545;
}

/* Tombol */
button {
  font-family: "Poppins", sans-serif;
}

.btn {
  padding: 10px 20px;
  font-size: 1rem;
  border-radius: 6px;
}

.btn-outline-secondary {
  border-color: #6c757d;
  color: #6c757d;
}

.btn-outline-secondary:hover {
  background-color: #6c757d;
  color: white;
}

.btn-success {
  background-color: #28a745;
  color: white;
}

.btn-success:hover {
  background-color: #218838;
}

/* Dialog */
.dialog-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.dialog-box {
  background-color: white;
  border-radius: 8px;
  padding: 20px;
  max-width: 400px;
  width: 100%;
  text-align: center;
}

.dialog-title {
  font-size: 1.5rem;
  margin-bottom: 15px;
  color: #333;
}

.dialog-message {
  font-size: 1rem;
  margin-bottom: 20px;
  color: #555;
}

.dialog-actions button {
  background-color: #ffc107;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
}

.dialog-actions button:hover {
  background-color: #e0a800;
}

.success-popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.success-popup-box {
  background-color: white;
  border-radius: 8px;
  padding: 20px;
  max-width: 400px;
  width: 100%;
  text-align: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.success-popup-title {
  font-size: 1.5rem;
  margin-bottom: 15px;
  color: #28a745;
}

.success-popup-message {
  font-size: 1rem;
  margin-bottom: 20px;
  color: #555;
}

.success-popup-box .btn-success {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
}

.success-popup-box .btn-success:hover {
  background-color: #218838;
}
</style>