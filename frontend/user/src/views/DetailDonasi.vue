<template>
  <div class="container mt-5 pt-5">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="d-flex justify-content-center mt-3 mx-3">
            <img
              :src="'http://localhost:8000/storage/' + program.foto_kegiatan"
              class="card-img-top img-fluid w-100 rounded"
              alt="Donation Box"
            />
          </div>
          <div class="card-body">
            <h2 class="card-title">
              {{ program.nama_kegiatan }}
            </h2>
            <p class="card-text">
              {{ quote }}<br />
              <strong>{{ hadith }}</strong>
            </p>
          </div>
        </div>
        <div class="mt-3 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Deskripsi</h5>
              <p class="card-text">
                {{ program.deskripsi_kegiatan }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column (Donation Summary) -->
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <h4 class="card-text mb-3 small-title">
              {{ program.nama_kegiatan }}
            </h4>
            <img
              :src="'http://localhost:8000/storage/' + program.foto_kegiatan"
              class="img-fluid mb-3 rounded"
              alt="Donation Campaign"
            />
            <p class="card-text">
              Terkumpul: {{ formatCurrency(program.anggaran_terkumpul) }}
            </p>
            <p class="card-text">
              Target: {{ formatCurrency(program.anggaran_donasi) }}
            </p>
            <div class="progress mb-2">
              <div
                class="progress-bar"
                role="progressbar"
                :style="{ width: progress + '%' }"
                aria-valuenow="30"
                aria-valuemin="0"
                aria-valuemax="100"
              ></div>
            </div>

            <!-- Tombol Donasi Sekarang -->
            <div class="d-flex mt-3 justify-content-center">
              <RouterLink
                :to="{
                  path: '/detaildonasi/nominal',
                  query: { id: program.id_kegiatan },
                }"
              >
                <button class="btn btn-success btn-block">
                  Donasi Sekarang
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
import axios from "axios";

export default {
  data() {
    return {
      selectedCategory: this.$route.query.category || "SUMBANGAN",
      campaign: {
        title: "",
        description: "",
        amount_collected: 0,
        target_amount: 0,
        days_left: 0,
      },
      quote: '"Sedekah dapat menghapus dosa sebagaimana air memadamkan api."',
      hadith: "Hadist Riwayat Tirmidzi",
      program: [],
    };
  },

  computed: {
    isZakatCategory() {
      return (
        this.selectedCategory === "ZAKAT" ||
        this.selectedCategory === "ZAKAT MAL"
      );
    },
    progress() {
      if (this.program.anggaran_donasi > 0) {
        return (
          (this.program.anggaran_terkumpul / this.program.anggaran_donasi) * 100
        );
      }
      return 0;
    },
  },

  methods: {
    formatCurrency(value) {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(value);
    },
    fetchProgram() {
      const id = this.$route.query.id;
      axios
        .get(`http://localhost:8000/api/donasi/${id}`)
        .then((response) => {
          this.program = response.data;
        })
        .catch((error) => {
          console.error("Gagal fetch data", error);
        });
    },
  },

  watch: {
    "$route.query.category": {
      immediate: true,
      handler(newCategory) {
        this.selectedCategory = newCategory || "SUMBANGAN";
      },
    },
  },

  mounted() {
    this.fetchProgram();
  },
};
</script>

<style scoped>
.card-title {
  font-size: 1.75rem;
}

.progress-bar {
  background-color: #28a745;
}

.small-title {
  font-size: 20px; /* Adjust this value as needed */
}
</style>
