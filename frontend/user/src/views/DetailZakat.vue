<template>
  <div class="container mt-5 pt-5">
    <h2 class="text-center mb-4">Program Pilihan Zakat Mal</h2>
    <p class="text-center">
      Pilih dan salurkan donasi untuk program yang berarti bagi Anda dan mereka
    </p>

    <!-- Search -->
    <div class="input-group mb-3">
      <input
        type="text"
        class="form-control"
        placeholder="Cari Program ..."
        v-model="search"
      />
    </div>

    <!-- Program cards -->
    <div class="row">
      <div
        v-for="program in filteredPrograms"
        :key="program.id_kegiatan"
        class="col-md-3 mb-4"
      >
        <div class="card h-100">
          <img
            :src="'http://localhost:8000/storage/' + program.foto_kegiatan"
            class="card-img-top"
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
                  path: '/detaildonasi',
                  query: {
                    id: program.id_kegiatan,
                    category: selectedCategory,
                  },
                }"
              >
                <button class="btn btn-success mt-3">Details Donasi</button>
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
      selectedCategory: "JENIS ZAKAT MAL",
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
          program.nama_kegiatan
            .toLowerCase()
            .includes(this.search.toLowerCase());
        return matchesCategory && matchesSearch;
      });
    },
  },
  methods: {
    fetchPrograms() {
      axios
        .get("http://localhost:8000/api/donasi")
        .then((response) => {
          this.program = response.data;
        })
        .catch((error) => {
          console.error("Error fetching programs:", error);
        });
    },
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
  },
  mounted() {
    this.fetchPrograms();
  },
};
</script>

<style scoped>
.card-title {
  font-size: 1.25rem; /* Ukuran font untuk judul */
}

.card-text {
  flex-grow: 1; /* Membuat teks bisa tumbuh dalam ruang yang tersedia */
}
</style>
