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
          :class="{
            'border-success':
              selectedCategory === 'ZAKAT' ||
              selectedCategory === 'ZAKAT FITRAH',
          }"
          @click="selectedCategory = 'ZAKAT'"
        >
          <i class="fas fa-balance-scale fa-2x text-success p-3 mb-2"></i>
          <span>Zakat</span>
        </div>
        <div
          class="d-flex flex-column align-items-center p-3 mr-5 me-4 border rounded"
          :class="{ 'border-success': selectedCategory === 'SUMBANGAN' }"
          @click="selectedCategory = 'SUMBANGAN'"
        >
          <i class="fas fa-hand-holding-heart fa-2x text-success p-3 mb-2"></i>
          <span>Sumbangan</span>
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
        :key="program.id_kegiatan"
        class="col-md-3 mb-4"
      >
        <div class="card h-100">
          <img
            :src="'http://localhost:8000/storage/' + program.foto_kegiatan"
            class="card-img-top rounded"
            :alt="program.nama_kegiatan"
            style="height: 180px; object-fit: cover"
          />
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ program.nama_kegiatan }}</h5>
            <p class="card-text">
              Terkumpul: {{ formatCurrency(program.anggaran_terkumpul) }}
            </p>
            <div class="mt-auto text-end">
              <RouterLink
                :to="{
                  path: determineRoute(program.jenis_kegiatan),
                  query: {
                    id: program.id_kegiatan,
                    category: selectedCategory,
                  },
                }"
              >
                <button class="btn btn-success px-3 mt-3">
                  Details Donasi
                </button>
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
      selectedCategory: "SUMBANGAN",
      image: require("../assets/images/infaq.jpeg"),
      program: [],
    };
  },
  computed: {
    filteredPrograms() {
      return this.program.filter((program) => {
        const isZakatCategory =
          this.selectedCategory === "ZAKAT" &&
          (program.jenis_kegiatan === "ZAKAT" ||
            program.jenis_kegiatan === "ZAKAT FITRAH");
        const matchesCategory =
          program.jenis_kegiatan === this.selectedCategory || isZakatCategory;
        const matchesSearch =
          this.search === "" ||
          program.nama_kegiatan
            .toLowerCase()
            .includes(this.search.toLowerCase());
        return matchesCategory && matchesSearch;
      });
    },
  },
  methods: {
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchPrograms() {
      axios
        .get("http://localhost:8000/api/donasi")
        .then((response) => {
          this.program = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.error("Error fetching programs:", error);
        });
    },
    determineRoute(category) {
      // Routing based on the category type
      if (category === "ZAKAT") {
        return "/detailzakat";
      } else if (category === "ZAKAT FITRAH") {
        return "/detaildonasi";
      }
      return "/detaildonasi"; // Default for other categories
    },
  },
  mounted() {
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
