<template>
  <head>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>

  <div class="container mt-5 pt-5">
    <h2 class="text-center mb-4">Program Pilihan</h2>
    <p class="text-center">
      Pilih dan salurkan donasi untuk program yang berarti bagi Anda dan mereka
    </p>

    <!-- menu kategori -->
    <div class="d-flex justify-content-center mb-5 mt-4">
      <div class="btn-group">
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
          :class="{ 'border-success': selectedCategory === 'infaq' }"
          @click="selectedCategory = 'INFAQ'"
        >
          <i class="fas fa-donate fa-2x text-success p-3 mb-2"></i>
          <span>Infaq</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
          :class="{ 'border-success': selectedCategory === 'ZAKAT' }"
          @click="selectedCategory = 'ZAKAT'"
        >
          <i class="fas fa-balance-scale fa-2x text-success p-3 mb-2"></i>
          <span>Zakat</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
          :class="{ 'border-success': selectedCategory === 'SEDEKAH' }"
          @click="selectedCategory = 'SEDEKAH'"
        >
          <i class="fas fa-hand-holding-heart fa-2x text-success p-3 mb-2"></i>
          <span>Sedekah</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 border rounded"
          :class="{ 'border-success': selectedCategory === 'KEGIATAN' }"
          @click="selectedCategory = 'KEGIATAN'"
        >
          <i class="fas fa-mosque fa-2x text-success p-3 mb-2"></i>
          <span>Kegiatan</span>
        </div>
      </div>
    </div>

    <h5 class="text-left">Rekomendasi Program</h5>

    <!-- Search -->
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Cari Program ..."
        v-model="search"
      />
    </div>

    <!-- pilihan program -->
    <div class="row">
      <div
        v-for="program in filteredPrograms"
        :key="program.id"
        class="col-md-3 mb-4"
      >
        <div class="card h-100">
          <img
            :src="image"
            class="card-img-top"
            :alt="program.nama_kegiatan"
            style="height: 180px; object-fit: cover"
          />
          <div class="card-body">
            <h5 class="card-title">{{ program.nama_kegiatan }}</h5>
            <p class="card-text">
              Terkumpul: Rp. {{ program.anggaran_terkumpul }}
            </p>
            <div class="d-flex justify-content-end">
              <RouterLink
                :to="{ name: 'DetailDonasi', params: { id: program.id } }"
              >
                <button class="btn btn-success px-3">Details Donasi</button>
              </RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../axios";

export default {
  data() {
    return {
      search: "",
      selectedCategory: "INFAQ",
      image: require("../assets/images/infaq.jpeg"),
      program: [],
    };
  },
  computed: {
    filteredPrograms() {
      return this.program.filter((program) => {
        const matchesCategory =
          program.jenis_kegiatan === this.selectedCategory;
        const matchesSearch =
          this.search === "" ||
          program.name.toLowerCase().includes(this.search.toLowerCase());
        return matchesCategory && matchesSearch;
      });
    },
  },
  methods: {
    test() {
      console.log("OK");
    },
    fetchPrograms() {
      axios
        .get("/donasi")
        .then((response) => {
          this.program = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.error("Error fetching programs:", error);
        });
    },
  },
  mounted() {
    this.test();
    this.fetchPrograms();
  },
};
</script>

<style scoped>
.container {
  max-width: 1200px;
}

.card {
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease-in-out;
}

.card:hover {
  transform: scale(1.05);
}

input.form-control {
  max-width: 100%;
  margin: 0 auto;
}

.btn-group div {
  cursor: pointer;
}

.border-success {
  border-color: #28a745 !important;
}
</style>
