  <template>
    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
          <!-- Form Title -->
          <h2 class="mb-5 text-center">Buat Kegiatan Baru</h2>

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
              <div v-if="imagePreview">
                <img :src="imagePreview" alt="Preview Image" style="max-width: 300px; max-height: 300px;">
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
                  <option value="zakat">Zakat Fitrah</option>
                  <option value="zakat mal">Zakat Mal</option>
                  <option value="zakat mal">Jenis Zakat Mal</option>
                </select>
                <div v-if="errors.type" class="invalid-feedback">
                  {{ errors.type }}
                </div>
              </div>
            </div>

            <!-- Description Section -->
            <div class="mb-3">
              <label for="activityDescription" class="form-label">Deskripsi</label>
              <textarea
                  class="form-control form-control-lg"
                  id="activityDescription"
                  v-model="form.description"
                  placeholder="Masukkan Deskripsi"
                  rows="5"
                  :class="{ 'is-invalid': errors.description }"
              ></textarea>
              <div v-if="errors.description" class="invalid-feedback d-block">
                {{ errors.description }}
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="targetAmount" class="form-label">Target Terkumpul</label>
                <div class="input-group input-group-lg">
                  <input
                    type="text"
                    class="form-control"
                    id="targetAmount"
                    :value="formattedTargetAmount"
                    placeholder="Masukkan Target Terkumpul"
                    @input="formatTargetAmount"
                    :class="{ 'is-invalid': errors.targetAmount }"
                  />
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
              <label for="accountNumber" class="form-label">Nomor Rekening BSI</label>
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
              <label for="qrisImage" class="form-label">Upload QR Code Qris</label>
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
              <div v-if="qrisPreview">
                <img :src="qrisPreview" alt="Preview Image" style="max-width: 300px; max-height: 300px;">
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
  import axios from "axios";

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
        formattedTargetAmount: '',
        imagePreview: null,
        qrisPreview: null,
        errors: {},
      };
    },
    methods: {    
      formatCurrency(value) {
      if (!value || isNaN(value)) return "";
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0,
      }).format(value);
    },
    formatTargetAmount(event) {
      const rawValue = event.target.value.replace(/[^0-9]/g, ""); // Hanya angka
      if (rawValue) {
        this.formattedTargetAmount = this.formatCurrency(rawValue);
        this.form.targetAmount = parseInt(rawValue, 10);
      } else {
        this.formattedTargetAmount = "";
        this.form.targetAmount = "";
      }
    },
      onImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        if (!['image/jpg', 'image/jpeg', 'image/png'].includes(file.type)) {
          this.errors.image = 'Thumbnail harus berupa file gambar (jpg, jpeg, png).';
        } else if (file.size > 5120 * 1024) {
          this.errors.image = 'Ukuran file maksimal 5 MB.';
        } else {
          this.form.image = file;
          this.imagePreview = URL.createObjectURL(file);
          delete this.errors.image;
        }
      }
    },
    onQRISImageChange(event) {
      const file = event.target.files[0];
      if (file) {
        if (!['image/jpg', 'image/jpeg', 'image/png'].includes(file.type)) {
          this.errors.qrisImage = 'QR Code harus berupa file gambar (jpg, jpeg, png).';
        } else if (file.size > 5120 * 1024) {
          this.errors.qrisImage = 'Ukuran file maksimal 5 MB.';
        } else {
          this.form.qrisImage = file;
          this.qrisPreview = URL.createObjectURL(file);
          delete this.errors.qrisImage;
        }
      }
    },
      isFutureDate(date) {
        const today = new Date().setHours(0, 0, 0, 0);
        return new Date(date).getTime() >= today;
      },
      validateForm() {
        this.errors = {};

        const imageFile = this.$refs.activityImage?.files?.[0];
        const qrisFile = this.$refs.qrisImage?.files?.[0];

        if (!imageFile) {
          this.errors.image = 'Gambar harus diunggah.';
        } else if (imageFile.size > 5 * 1024 * 1024) {
          this.errors.image = 'Ukuran gambar tidak boleh lebih dari 5 MB.';
        }

        if (!this.form.name) {
          this.errors.name = 'Nama kegiatan harus diisi.';
        } else if (this.form.name.length > 255) {
          this.errors.name = 'Nama kegiatan tidak boleh lebih dari 255 karakter.';
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
          this.errors.targetAmount = 'Target terkumpul harus lebih dari nol.';
        } else if (this.form.targetAmount.toString().length > 15) {
          this.errors.targetAmount = 'Target terkumpul tidak boleh lebih dari 15 digit.';
        }

        if (!this.form.timeLimit) {
          this.errors.timeLimit = 'Tenggat waktu harus diisi.';
        } else if (!this.isFutureDate(this.form.timeLimit)) {
          this.errors.timeLimit = 'Tenggat waktu harus di masa mendatang.';
        }

        if (!this.form.accountNumber) {
          this.errors.accountNumber = 'Nomor rekening harus diisi.';
        }

        if (!qrisFile) {
          this.errors.qrisImage = 'QR Code harus diunggah.';
        } else if (qrisFile.size > 5 * 1024 * 1024) {
          this.errors.qrisImage = 'Ukuran QR Code tidak boleh lebih dari 5 MB.';
        }

        if (Object.keys(this.errors).length === 0) {
          this.submitForm();
        }
      },
      async submitForm() {
        const formData = new FormData();

        formData.append('thumbnail', this.form.image);
        formData.append('name', this.form.name);
        formData.append('type', this.form.type.toUpperCase());
        formData.append('description', this.form.description);
        formData.append('target', this.form.targetAmount);
        formData.append('limit', this.form.timeLimit);
        formData.append('rekening', this.form.accountNumber);
        formData.append('qris', this.form.qrisImage);

        try {
          const response = await axios.post('http://localhost:8000/api/buat-kegiatan', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });

          alert('Kegiatan berhasil ditambahkan!');
          console.log(response.data);

          this.$router.push({ name: "ActivityList" });
        } catch (error) {
          if (error.response && error.response.data) {
            const responseData = error.response.data;

            if (responseData.field === 'name') {
              alert(responseData.message);
              this.errors.name = responseData.message;
            } else {
              this.errors.general = responseData.message || 'Terjadi kesalahan saat menyimpan kegiatan.';
            }
          } else {
            this.errors.general = 'Terjadi kesalahan jaringan.';
          }
        }
      },
      cancel() {
        if (confirm('Apakah Anda yakin ingin membatalkan?')) {
          this.$router.push({ name: 'ActivityList' });
        }
      }
    }
  };
  </script>

  <style scoped>
  /* Styles remain the same as in the original component */
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
    padding: 14px;
    font-size: 1.1rem;
    border-radius: 8px;
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