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
              >
              <span class="file-label">{{ form.imageName || 'Pilih File...' }}</span>
            </div>
            <div v-if="errors.image" class="invalid-feedback">
              {{ errors.image }}
            </div>
          </div>

          <!-- Form Fields -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="activityName" class="form-label">Nama Transaksi</label>
              <input
                  type="text"
                  class="form-control form-control-lg"
                  id="activityName"
                  v-model="form.name"
                  placeholder="Masukkan Nama Transaksi"
                  :class="{ 'is-invalid': errors.name }"
              >
              <div v-if="errors.name" class="invalid-feedback">
                {{ errors.name }}
              </div>
            </div>
          </div>

          <!-- Textarea for Description -->
          <div class="mb-3">
            <label for="activityDescription" class="form-label">Deskripsi</label>
            <textarea
                id="activityDescription"
                class="form-control form-control-lg"
                rows="6"
                v-model="form.description"
                placeholder="Masukkan Deskripsi"
                :class="{ 'is-invalid': errors.description }"
            ></textarea>
            <div v-if="errors.description" class="invalid-feedback">
              {{ errors.description }}
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="targetAmount" class="form-label">Total Pengeluaran</label>
              <div class="input-group input-group-lg">
                <input
                    type="text"
                    class="form-control"
                    id="targetAmount"
                    v-model="form.displayAmount"
                    @input="formatRupiah"
                    placeholder="Masukkan Nominal Pengeluaran"
                    :class="{ 'is-invalid': errors.targetAmount }"
                >
              </div>
              <div v-if="errors.targetAmount" class="invalid-feedback d-block">
                {{ errors.targetAmount }}
              </div>
            </div>
          </div>

          <!-- Submit and Cancel Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button @click="cancel" class="btn btn-outline-secondary btn-lg">Batalkan</button>
            <button type="submit" class="btn btn-success btn-lg">Tambah</button>
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
              <button @click="closeDialog" class="btn btn-orange btn-lg">Kembali</button>
            </div>
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

      if (!this.form.imageName) this.errors.image = 'Gambar harus diunggah.';
      if (!this.form.name) this.errors.name = 'Nama transaksi harus diisi.';
      if (!this.form.description) this.errors.description = 'Deskripsi harus diisi.';
      if (!this.form.targetAmount || this.form.targetAmount <= 0) {
        this.errors.targetAmount = 'Total pengeluaran harus berupa angka positif.';
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

        alert('Pengeluaran berhasil ditambahkan!');
        console.log(response.data);

        this.$router.push({ name: 'RiwayatPengeluaran' });
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
  },
};
</script>

<style scoped>
.container-fluid {
  max-width: 1200px;
}

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
  text-align: center;
}

.upload-input {
  position: absolute;
  opacity: 0;
  height: 100%;
  width: 100%;
  cursor: pointer;
}

.file-label {
  font-size: 1.1rem;
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

button {
  font-family: 'Poppins', sans-serif;
}

.btn-lg {
  border-radius: 8px;
  padding: 10px 20px;
}

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
  background-color: #f6a800;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 1rem;
  border-radius: 5px;
  cursor: pointer;
}

.dialog-actions button:hover {
  background-color: #e58f00;
}

.dialog-actions {
  display: flex;
  justify-content: center;
}
</style>
