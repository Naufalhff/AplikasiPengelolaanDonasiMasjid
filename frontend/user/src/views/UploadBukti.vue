<template>
  <div class="container mt-5">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <div class="d-flex align-items-center mb-3">
          <img
            src="https://via.placeholder.com/100x100"
            alt="Donation Image"
            class="rounded"
            width="100"
            height="100"
          />
          <div class="ml-3">
            <h5 class="mb-1">
              Donasi Penggalangan Dana korban bencana Gempa Bumi
            </h5>
            <p class="text-muted mb-0">DKM Masjid Luqmanul Hakim</p>
          </div>
        </div>

        <!-- Image Upload Section -->
        <h6 class="font-weight-bold mb-3">ADD FILE</h6>
        <div
          class="border p-4 rounded"
          @dragover.prevent
          @drop.prevent="handleFileDrop"
          @dragenter="isDragging = true"
          @dragleave="isDragging = false"
          :class="{ 'bg-light': isDragging }"
        >
          <img
            src="https://via.placeholder.com/60x60"
            alt="Image Icon"
            class="mb-2"
          />
          <p class="mb-1">Drag and drop file here</p>
          <p class="mb-2">OR</p>
          <input
            type="file"
            class="form-control-file"
            @change="handleFileSelect"
            id="fileInput"
            style="display: none"
          />
          <button class="btn btn-outline-primary" @click="browseFile">
            Browse File
          </button>
        </div>

        <!-- Submit Button -->
        <button class="btn btn-success btn-block mt-4" @click="submitFile">
          Kirim
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isDragging: false,
      selectedFile: null,
    };
  },
  methods: {
    handleFileDrop(event) {
      this.isDragging = false;
      const files = event.dataTransfer.files;
      if (files.length > 0) {
        this.selectedFile = files[0];
        alert(`File ${this.selectedFile.name} selected.`);
      }
    },
    handleFileSelect(event) {
      const files = event.target.files;
      if (files.length > 0) {
        this.selectedFile = files[0];
        alert(`File ${this.selectedFile.name} selected.`);
      }
    },
    browseFile() {
      document.getElementById("fileInput").click();
    },
    submitFile() {
      if (this.selectedFile) {
        alert(`File ${this.selectedFile.name} submitted!`);
      } else {
        alert("Please select a file before submitting.");
      }
    },
  },
};
</script>

<style scoped>
h5,
h6 {
  font-weight: bold;
}

.border {
  border: 2px dashed #ced4da;
}

.bg-light {
  background-color: #f8f9fa;
}
</style>
