<template>
  <head>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <!-- Donation Information Section -->
        <div class="d-flex align-items-center mb-3">
          <img
            src="/mnt/data/image.png"
            alt="Donation Image"
            class="rounded"
            width="100"
            height="100"
          />
          <div class="ml-3 text-left">
            <h5 class="mb-1">
              Donasi Penggalangan Dana korban bencana Gempa Bumi
            </h5>
            <p class="text-muted mb-0">DKM Masjid Luqmanul Hakim</p>
          </div>
        </div>

        <!-- Image Upload Section -->
        <h6 class="font-weight-bold mb-3">Upload Bukti Pembayaran</h6>
        <div
          class="border p-4 rounded"
          @dragover.prevent
          @drop.prevent="handleFileDrop"
          @dragenter="isDragging = true"
          @dragleave="isDragging = false"
          :class="{ 'bg-light': isDragging }"
        >
          <div v-if="selectedFile" class="mb-2">
            <img
              v-if="isImage(selectedFile)"
              :src="imageUrl"
              alt="Selected Image"
              class="mb-2"
              style="max-width: 100px; max-height: 100px"
            />
            <p v-else-if="isPDF(selectedFile)">
              File PDF: {{ selectedFile.name }}
            </p>
            <p v-else>Format tidak didukung: {{ selectedFile.name }}</p>
          </div>
          <img
            v-else
            src="https://via.placeholder.com/60x60"
            alt="Image Icon"
            class="mb-2"
          />
          <p class="mb-1">
            Drag and drop file here, maks 5mb (Dukungan: PDF, JPG, PNG)
          </p>
          <p class="mb-2">OR</p>
          <input
            type="file"
            class="form-control-file"
            @change="handleFileSelect"
            id="fileInput"
            style="display: none"
          />
          <button class="btn btn-outline-primary" @click="browseFile">
            Browse Image
          </button>
        </div>

        <!-- Submit Button -->
        <button class="btn btn-success btn-block mt-4" @click="submitFile">
          Kirim
        </button>
      </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div
      class="modal fade"
      id="confirmationModal"
      tabindex="-1"
      aria-labelledby="confirmationModalLabel"
      aria-hidden="true"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body text-center p-4">
            <i class="fas fa-check-circle fa-5x text-success"></i>
            <h5 class="mb-3 mt-3">Bukti Pembayaran Berhasil Dikirim!</h5>
            <p>Terima kasih, bukti pembayaran Anda telah berhasil dikirim.</p>
            <div class="d-flex justify-content-center mt-4">
              <button
                type="button"
                class="btn btn-success"
                @click="redirectToDonationPage"
              >
                Oke
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Modal } from "bootstrap";

export default {
  data() {
    return {
      isDragging: false,
      selectedFile: null,
      imageUrl: null,
    };
  },
  methods: {
    handleFileDrop(event) {
      this.isDragging = false;
      const files = event.dataTransfer.files;
      if (files.length > 0) {
        this.selectedFile = files[0];
        this.updateImageUrl();
      }
    },
    handleFileSelect(event) {
      const files = event.target.files;
      if (files.length > 0) {
        this.selectedFile = files[0];
        this.updateImageUrl();
      }
    },
    browseFile() {
      document.getElementById("fileInput").click();
    },
    submitFile() {
      if (this.selectedFile) {
        const modal = new Modal(document.getElementById("confirmationModal"));
        modal.show();
      } else {
        alert("Please select a file before submitting.");
      }
    },
    redirectToDonationPage() {
      this.$router.push("/donasi");
    },
    updateImageUrl() {
      if (this.isImage(this.selectedFile)) {
        this.imageUrl = URL.createObjectURL(this.selectedFile);
      } else {
        this.imageUrl = null;
      }
    },
    isImage(file) {
      return file && (file.type === "image/jpeg" || file.type === "image/png");
    },
    isPDF(file) {
      return file && file.type === "application/pdf";
    },
  },
};
</script>
