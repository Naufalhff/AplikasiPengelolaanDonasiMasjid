<template>
  <div class="container-fluid py-4">
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-10 col-md-12">
        <!-- Form Title -->
        <h2 class="mb-5 text-center">Edit Kegiatan</h2>

        <!-- Form -->
        <form @submit.prevent="validateForm" novalidate>
          <!-- Upload Image Section -->
          <div class="mb-4">
            <label for="activityImage" class="form-label">Upload Thumbnail</label>
            <input 
              type="file" 
              class="form-control form-control-lg" 
              id="activityImage" 
              @change="onImageChange"
              :class="{ 'is-invalid': errors.image }"
            >
            <div v-if="form.image" class="my-3">
              <img :src="form.image" alt="Preview" class="img-thumbnail" />
            </div>
            <div v-if="errors.image" class="invalid-feedback">
              {{ errors.image }}
            </div>
          </div>

          <!-- Form Fields -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="activityName" class="form-label">Nama Kegiatan</label>
              <input 
                type="text" 
                class="form-control form-control-lg" 
                id="activityName" 
                v-model="form.name" 
                placeholder="Masukkan Nama Kegiatan"
                :class="{ 'is-invalid': errors.name }"
              >
              <div v-if="errors.name" class="invalid-feedback">
                {{ errors.name }}
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="activityType" class="form-label">Jenis Kegiatan</label>
              <select
                class="form-select form-select-lg custom-select-lg"
                id="activityType"
                v-model="form.type"
                :class="{ 'is-invalid': errors.type }"
              >
                <option value="" disabled selected>Pilih jenis kegiatan</option>
                <option value="sumbangan">Sumbangan</option>
                <option value="zakat">Zakat</option>
                <option value="zakat mal">Zakat Mal</option>
              </select>
              <div v-if="errors.type" class="invalid-feedback">
                {{ errors.type }}
              </div>
            </div>
          </div>

          <!-- Description Section -->
          <div class="mb-3">
            <label for="activityDescription" class="form-label">Deskripsi</label>
            <div id="activityDescription" ref="summernoteEditor"></div>
            <div v-if="errors.description" class="invalid-feedback d-block">
              {{ errors.description }}
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="targetAmount" class="form-label">Target Terkumpul</label>
              <div class="input-group input-group-lg">
                <input 
                  type="number" 
                  class="form-control" 
                  id="targetAmount" 
                  v-model="form.targetAmount" 
                  placeholder="Masukkan Target Terkumpul"
                  :class="{ 'is-invalid': errors.targetAmount }"
                >
              </div>
              <div v-if="errors.targetAmount" class="invalid-feedback d-block">
                {{ errors.targetAmount }}
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label for="timeLimit" class="form-label">Tenggat Waktu</label>
              <input 
                type="date" 
                class="form-control form-control-lg" 
                id="timeLimit" 
                v-model="form.timeLimit" 
                :class="{ 'is-invalid': errors.timeLimit }"
              >
              <div v-if="errors.timeLimit" class="invalid-feedback">
                {{ errors.timeLimit }}
              </div>
            </div>
          </div>

          <!-- Payment Details -->
          <div class="mb-4">
            <label for="accountNumber" class="form-label">Nomor Rekening</label>
            <input 
              type="text" 
              class="form-control form-control-lg" 
              id="accountNumber" 
              v-model="form.accountNumber" 
              placeholder="Masukkan Nomor Rekening"
              :class="{ 'is-invalid': errors.accountNumber }"
            >
            <div v-if="errors.accountNumber" class="invalid-feedback">
              {{ errors.accountNumber }}
            </div>
          </div>

          <div class="mb-4">
            <label for="qrisImage" class="form-label">Upload QR Code</label>
            <input 
              type="file" 
              class="form-control form-control-lg" 
              id="qrisImage" 
              @change="onQRISImageChange"
              :class="{ 'is-invalid': errors.qrisImage }"
            >
            <div v-if="errors.qrisImage" class="invalid-feedback">
              {{ errors.qrisImage }}
            </div>
            <div v-if="form.qrisImage" class="mt-3">
              <img :src="form.qrisImage" alt="QR Code Preview" class="img-thumbnail" />
            </div>
          </div>

          <!-- Submit and Cancel Buttons -->
          <div class="d-flex justify-content-between mt-4">
            <button @click="cancel" class="btn btn-outline-secondary btn-lg">Batalkan</button>
            <button type="submit" class="btn btn-success btn-lg">Buat Kegiatan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery';
import 'summernote/dist/summernote-bs4.min.js';

export default {
  data() {
    return {
      form: {
        image: null,
        name: '',
        type: '',
        description: '',
        targetAmount: '',
        timeLimit: '',
        accountNumber: '',
        qrisImage: null,
      },
      errors: {}
    };
  },
  mounted() {
    $(this.$refs.summernoteEditor).summernote({
      placeholder: 'Masukkan Deskripsi',
      tabsize: 2,
      height: 200,
      callbacks: {
        onChange: (contents) => {
          this.form.description = contents;
        }
      }
    });
  },
  methods: {
    onImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.image = URL.createObjectURL(file);
      }
    },
    onQRISImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.qrisImage = URL.createObjectURL(file);
      }
    },
    validateForm() {
      this.errors = {};

      if (!this.form.image) {
        this.errors.image = 'Gambar harus diunggah.';
      }

      if (!this.form.name) {
        this.errors.name = 'Nama kegiatan harus diisi.';
      }

      if (!this.form.type) {
        this.errors.type = 'Jenis kegiatan harus diisi.';
      }

      if (!this.form.description) {
        this.errors.description = 'Deskripsi harus diisi.';
      }

      if (!this.form.targetAmount) {
        this.errors.targetAmount = 'Target terkumpul harus diisi.';
      } else if (isNaN(this.form.targetAmount) || this.form.targetAmount <= 0) {
        this.errors.targetAmount = 'Target harus berupa angka positif.';
      }

      if (!this.form.timeLimit) {
        this.errors.timeLimit = 'Tenggat waktu harus diisi.';
      }

      if (!this.form.accountNumber) {
        this.errors.accountNumber = 'Nomor rekening harus diisi.';
      }

      if (!this.form.qrisImage) {
        this.errors.qrisImage = 'QR Code harus diunggah.';
      }

      if (Object.keys(this.errors).length === 0) {
        this.submitForm();
      }
    },
    submitForm() {
      alert('Form berhasil disubmit!');
    },
    cancel() {
      if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
        this.$router.push({ name: 'ActivityList' });
      }
    }
  }
};
</script>

<style scoped>
.container-fluid {
  max-width: 1200px;
}

h2 {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  color: #343a40;
  font-size: 2rem;
}

.form-label {
  font-family: 'Poppins', sans-serif;
  font-weight: 500;
  color: #495057;
}

.form-control {
  border-radius: 8px;
  border: 1px solid #ced4da;
  padding: 14px;
  font-size: 1.1rem;
}

.form-control:focus {
  box-shadow: 0 0 6px rgba(0, 123, 255, 0.2);
  border-color: #80bdff;
}

.input-group-text {
  border-radius: 8px 0 0 8px;
}

input[type="file"] {
  height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f1f3f5;
  border-radius: 8px;
}
.custom-select-lg {
  padding: 14px; /* Increase padding for a larger, more consistent look */
  font-size: 1.1rem; /* Increase font size for better readability */
  border-radius: 8px; /* Match border-radius with other form controls */
  border: 1px solid #ced4da;
  color: #495057;
  background-color: #fff;
}

.custom-select-lg:focus {
  border-color: #80bdff;
  box-shadow: 0 0 6px rgba(0, 123, 255, 0.2);
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

.btn-outline-secondary {
  color: #6c757d;
}

.btn-lg {
  border-radius: 8px;
  padding: 10px 20px;
}
</style>