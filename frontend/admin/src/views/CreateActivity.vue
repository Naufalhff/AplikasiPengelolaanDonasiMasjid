<template>
    <div class="container py-4">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <!-- Form Title -->
          <h3 class="mb-4 text-center">Buat Kegiatan Baru</h3>
  
          <!-- Form -->
          <form @submit.prevent="validateForm" novalidate>
            <!-- Upload Image Section -->
            <div class="mb-4">
              <label for="activityImage" class="form-label">Upload Gambar Disini</label>
              <input 
                type="file" 
                class="form-control" 
                id="activityImage" 
                @change="onImageChange"
                :class="{ 'is-invalid': errors.image }"
              >
              <div v-if="errors.image" class="invalid-feedback">
                {{ errors.image }}
              </div>
            </div>
  
            <!-- Form Fields -->
            <div class="mb-3">
              <label for="activityName" class="form-label">Nama Kegiatan</label>
              <input 
                type="text" 
                class="form-control" 
                id="activityName" 
                v-model="form.name" 
                placeholder="Masukkan Nama Kegiatan"
                :class="{ 'is-invalid': errors.name }"
              >
              <div v-if="errors.name" class="invalid-feedback">
                {{ errors.name }}
              </div>
            </div>
  
            <div class="mb-3">
              <label for="activityType" class="form-label">Jenis Kegiatan</label>
              <input 
                type="text" 
                class="form-control" 
                id="activityType" 
                v-model="form.type" 
                placeholder="Masukkan Jenis Kegiatan"
                :class="{ 'is-invalid': errors.type }"
              >
              <div v-if="errors.type" class="invalid-feedback">
                {{ errors.type }}
              </div>
            </div>
  
            <div class="mb-3">
              <label for="activityDescription" class="form-label">Deskripsi</label>
              <textarea 
                class="form-control" 
                id="activityDescription" 
                v-model="form.description" 
                rows="4" 
                placeholder="Masukkan Deskripsi"
                :class="{ 'is-invalid': errors.description }"
              ></textarea>
              <div v-if="errors.description" class="invalid-feedback">
                {{ errors.description }}
              </div>
            </div>
  
            <div class="mb-3">
              <label for="targetAmount" class="form-label">Target Terkumpul</label>
              <div class="input-group">
                <span class="input-group-text">Rp</span>
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
  
            <div class="mb-3">
              <label for="timeLimit" class="form-label">Tenggat Waktu (Hari)</label>
              <input 
                type="number" 
                class="form-control" 
                id="timeLimit" 
                v-model="form.timeLimit" 
                placeholder="Masukkan Tenggat Waktu"
                :class="{ 'is-invalid': errors.timeLimit }"
              >
              <div v-if="errors.timeLimit" class="invalid-feedback">
                {{ errors.timeLimit }}
              </div>
            </div>
  
            <!-- Submit and Cancel Buttons -->
            <div class="d-flex justify-content-between">
              <button @click="cancel" class="btn btn-danger">Batalkan</button>
              <button type="submit" class="btn btn-success">Buat Kegiatan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          image: null,
          name: '',
          type: '',
          description: '',
          targetAmount: '',
          timeLimit: ''
        },
        errors: {}
      };
    },
    methods: {
      onImageChange(event) {
        const file = event.target.files[0];
        if (file) {
          this.form.image = URL.createObjectURL(file);
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
        } else if (isNaN(this.form.timeLimit) || this.form.timeLimit <= 0) {
          this.errors.timeLimit = 'Tenggat waktu harus berupa angka positif.';
        }
  
        // If no errors, submit the form (or perform desired action)
        if (Object.keys(this.errors).length === 0) {
          this.submitForm();
        }
      },
      submitForm() {
        // Handle form submission here (e.g., send data to an API or save locally)
        alert('Form berhasil disubmit!');
        // Reset form after submission
        this.form = {
          image: null,
          name: '',
          type: '',
          description: '',
          targetAmount: '',
          timeLimit: ''
        };
      },
      cancel() {
        this.$router.push({ name: 'ActivityList' });
      }
    }
  };
  </script>
  
  <style scoped>
  .form-label {
    font-weight: bold;
  }
  
  input[type="file"] {
    height: 200px;
    border: 1px dashed #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    position: relative;
  }
  
  input[type="file"]::before {
    content: 'Upload Gambar Disini';
    color: #999;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
  }
  
  .is-invalid {
    border-color: #dc3545;
  }
  
  .invalid-feedback {
    display: block;
  }
  </style>
  